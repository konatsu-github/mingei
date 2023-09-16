<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video; // Videoモデルを使用するためにインポート
use Illuminate\Support\Facades\Auth; // Authファサードを使用するためにインポート
use Illuminate\Support\Facades\Storage;
use App\Models\Usermeta;
use Intervention\Image\Facades\Image;

class VideoController extends Controller
{

    public function index(Request $request)
    {

        $searchResultsCount = 0;

        if ($request->has('s')) {
            // 検索キーワード
            $searchQuery = $request->input('s');

            // ユーザーニックネーム、ピンネーム、コンビネームのカラムを検索
            $userIdsFromUsermetas = Usermeta::where('nickname', 'LIKE', "%$searchQuery%")
                ->orWhere('pinname', 'LIKE', "%$searchQuery%")
                ->orWhere('combiname', 'LIKE', "%$searchQuery%")
                ->pluck('user_id');

            // タイトル、説明のカラムを検索
            $videoIdsFromVideos = Video::where('title', 'LIKE', "%$searchQuery%")
                ->orWhere('description', 'LIKE', "%$searchQuery%")
                ->pluck('id');

            // user_idを指定して動画データを取得
            $videos = Video::whereIn('user_id', $userIdsFromUsermetas)
                ->orWhereIn('id', $videoIdsFromVideos)
                ->orderBy('created_at', 'desc')
                ->get();

            // 検索結果数を取得
            $searchResultsCount = count($videos);
        } else {
            // クエリパラメータ "s" が存在しない場合は通常の処理
            $videos = Video::orderBy('created_at', 'desc')->get();
        }



        // 連想配列にサムネイルのURLを追加する
        $videosItems = [];
        foreach ($videos as $video) {
            $usermeta = Usermeta::where('user_id', $video->user_id)->first();
            $avatarUrl = GetS3TemporaryUrl($usermeta->avatar);
            $thumbnailUrl = GetS3TemporaryUrl($video->image_file_path);
            $videosItems[] = [
                'video' => $video,
                'usermeta' => $usermeta,
                'avatarUrl' => $avatarUrl,
                'thumbnailUrl' => $thumbnailUrl,
            ];
        }


        return view('home', compact('videosItems', 'searchResultsCount'));
    }


    public function rankingIndex()
    {
        // View countの多い順に動画データを取得（初めの6件のみ）
        $viewVideos = Video::orderBy('view_count', 'desc')->take(6)->get();

        // "good"の多い順に動画データを取得（初めの6件のみ）
        $rateVideos = $this->getTopRatedVideos()->take(6);

        $viewVideosItems = $this->prepareVideoItems($viewVideos);
        $rateVideosItems = $this->prepareVideoItems($rateVideos);

        return view('ranking', compact('viewVideosItems', 'rateVideosItems'));
    }

    private function getTopRatedVideos()
    {
        return Video::select('videos.*')
            ->join('video_rates', 'videos.id', '=', 'video_rates.video_id')
            ->where('video_rates.rating_type', 'good')
            ->groupBy('videos.id')
            ->orderByRaw('COUNT(video_rates.id) DESC') // "good"の数が多い順に並び替え
            ->get();
    }

    private function prepareVideoItems($videos)
    {
        $videoItems = [];
        foreach ($videos as $video) {
            $usermeta = Usermeta::where('user_id', $video->user_id)->first();
            $avatarUrl = GetS3TemporaryUrl($usermeta->avatar);
            $thumbnailUrl = GetS3TemporaryUrl($video->image_file_path);
            $videoItems[] = [
                'video' => $video,
                'usermeta' => $usermeta,
                'avatarUrl' => $avatarUrl,
                'thumbnailUrl' => $thumbnailUrl,
            ];
        }
        return $videoItems;
    }


    public function show(Request $request, $videoId)
    {
        // VideoモデルからユーザーIDと指定された'id'に紐づく動画データを取得します
        $video = Video::find($videoId);

        if (!$video) {
            // 動画が存在しない場合は適切な処理を行ってください（例：エラーメッセージの表示など）
            abort(404); // 404エラーを返す例
        }

        $videoUrl = GetS3TemporaryUrl($video->video_file_path);
        $usermeta = Usermeta::where('user_id', $video->user_id)->first();
        $videoAvatarUrl = GetS3TemporaryUrl($usermeta->avatar);

        // 関連動画を取得（同じユーザーの動画で最大4件）
        $relatedVideos = Video::where('user_id', $video->user_id)
            ->where('id', '<>', $video->id) // 自分自身の動画を除外
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $relatedVideosItems = $this->prepareVideoItems($relatedVideos);


        // クッキーの名前を定義
        $cookieName = 'video_' . $videoId;

        // クッキーにキーが存在しない場合、視聴回数を増やす
        if (!$request->cookie($cookieName)) {
            $video->view_count++;
            $video->save();

            // クッキーに記録（24時間有効なクッキーを設定）
            return response()
                ->view('watch', compact('video', 'usermeta', 'videoAvatarUrl', 'videoUrl', 'relatedVideosItems'))
                ->cookie($cookieName, true, 14400000000000000); // 1440分 = 24時間
        }

        return view('watch', compact('video', 'usermeta', 'videoAvatarUrl', 'videoUrl', 'relatedVideosItems'));
    }

    public function destroy($videoId)
    {
        // 動画データを取得
        $video = Video::find($videoId);

        if (!$video) {
            // 動画が存在しない場合は適切な処理を行ってください（例：エラーメッセージの表示など）
            abort(404); // 404エラーを返す例
        }

        // 削除が許可されているか確認
        if ($video->user_id === Auth::id()) {
            // 削除処理
            Storage::disk('s3')->delete($video->video_file_path);
            Storage::disk('s3')->delete($video->image_file_path);
            $video->delete();
            // 成功メッセージなどの処理を行い、リダイレクトするなどの操作を行います
            return redirect()->route('profile.show', ['id' => $video->user_id])->with('message', '動画が削除されました！')->with('messageType', 'success');
        } else {
            // ユーザーが動画の所有者でない場合の処理
            return redirect()->back()->withErrors('動画を削除する権限がありません。')->with('messageType', 'error');
        }
    }
}
