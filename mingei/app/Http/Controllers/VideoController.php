<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video; // Videoモデルを使用するためにインポート
use Illuminate\Support\Facades\Auth; // Authファサードを使用するためにインポート
use Illuminate\Support\Facades\Storage;
use App\Models\Usermeta;

class VideoController extends Controller
{

    public function index()
    {
        // Videoモデルからすべての動画データを取得します
        $videos = Video::orderBy('created_at', 'desc')->get();

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


        return view('home', compact('videosItems'));
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

        return view('watch', compact('video', 'usermeta', 'videoAvatarUrl', 'videoUrl'));
    }

    public function store(Request $request)
    {
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();


        // 例えば、動画ファイルを保存する場合は以下のようにします
        if ($request->hasFile('video-upload')) {

            // 動画アップロード
            $video = $request->file('video-upload');
            $image = $request->file('image-upload');

            $videoFilePath = $video->store('videos', 's3');
            $imageFilePath = $image->store('images', 's3');

            // フォームの値取得
            $inputTitle = $request->input('title');
            $textareaDescription = $request->input('description');


            // 保存したファイルのパスをデータベースに保存します
            $videoModel = new Video();
            $videoModel->user_id = $userId;
            $videoModel->title = $inputTitle;
            $videoModel->description = $textareaDescription;
            $videoModel->video_file_path = $videoFilePath;
            $videoModel->image_file_path = $imageFilePath;
            $videoModel->save();

            // $temporaryUrl = $this->getTemporaryUrl($path);

            // dd($temporaryUrl);

            // 成功メッセージなどの処理を行い、リダイレクトするなどの操作を行います
            return redirect()->route('upload')->with('message', '動画がアップロードされました！')->with('messageType', 'success');
        }

        // フォームに動画が選択されていない場合はエラーメッセージを表示するなどの処理を行います
        return redirect()->back()->withErrors('動画が選択されていません。')->with('message', '動画が選択されていません。')->with('messageType', 'error');
    }
}
