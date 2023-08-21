<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ユーザーモデルへの参照を追加
use App\Models\Usermeta;
use App\Models\Video;
use App\Models\VideoRate;
use App\Models\VideoSave;

class ProfileController extends Controller
{
    // ユーザーのビデオ数をカウントするプライベート関数
    private function countUserVideos($userId)
    {
        return Video::where('user_id', $userId)->count();
    }

    // ユーザーの再生回数合計を取得するプライベート関数
    private function getTotalViewCountByUserId($userId)
    {
        return Video::where('user_id', $userId)->sum('view_count');
    }

    // 指定したユーザーと評価タイプ（"good"）の動画評価レコード数を取得するプライベート関数
    private function getGoodRatingCount($userId)
    {
        return Video::where('user_id', $userId)
            ->whereHas('videoRates', function ($query) {
                $query->where('rating_type', 'good');
            })
            ->count();
    }

    // ユーザーの総フォロワー数を取得するプライベート関数
    private function getTotalFollowersCount($userId)
    {
        $userMeta = UserMeta::where('user_id', $userId)->first();

        if ($userMeta) {
            $followers = unserialize($userMeta->followers);
            if (is_array($followers)) {
                return count($followers);
            }
        }

        return 0; // フォロワーが存在しない場合は0を返す
    }

    // フォローしているユーザーの情報を取得
    private function getFollowedUsers($userId)
    {
        $userMeta = UserMeta::where('user_id', $userId)->first();
        $followedUsers = [];

        if ($userMeta) {
            // ユーザーがフォローしているユーザーの情報を取得
            $followedUserIds = unserialize($userMeta->follows);

            if (is_array($followedUserIds)) {
                foreach ($followedUserIds as $followedUserId) {
                    $followedUser = User::find($followedUserId);
                    if ($followedUser) {
                        $followedUsermeta = Usermeta::where('user_id', $followedUserId)->first();
                        $followedUserAvatarUrl = GetS3TemporaryUrl($followedUsermeta->avatar);

                        $followedUsers[] = [
                            'user' => $followedUser,
                            'usermeta' => $followedUsermeta,
                            'avatarUrl' => $followedUserAvatarUrl,
                        ];
                    }
                }
            }
        }

        return $followedUsers; // フォロワーが存在しない場合は0を返す
    }

    // プロフィール表示
    public function show($id)
    {
        $profileUser = User::findOrFail($id);

        $profileUsermeta = null; // 初期値としてnullを設定
        $videoCount = 0;
        $TotalViewCount = 0;
        $goodRatingCount = 0;
        $totalFollowersCount = 0;
        $profileAvatarUrl = '';
        $followedUsers = [];

        if ($profileUser) {
            $profileUsermeta = Usermeta::where('user_id', $profileUser->id)->first();
            $videoCount = $this->countUserVideos($profileUser->id);
            $totalViewCount = $this->getTotalViewCountByUserId($profileUser->id);
            $goodRatingCount = $this->getGoodRatingCount($profileUser->id);
            $totalFollowersCount = $this->getTotalFollowersCount($profileUser->id);
            $followedUsers = $this->getFollowedUsers($profileUser->id);

            // プロフィールのアバター画像取得
            $profileAvatarUrl = GetS3TemporaryUrl($profileUsermeta->avatar);
        }


        $videos = Video::where('user_id', $profileUser->id)
            ->orderBy('created_at', 'desc')
            ->get();

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

        // ログインしているユーザーのIDを取得（仮定：Auth::user() を使用）
        $loggedInUserId = auth()->user()->id;

        // ユーザーが保存した動画のIDを取得
        $savedVideoIds = VideoSave::where('user_id', $loggedInUserId)->pluck('video_id');

        // 保存された動画のデータを取得
        $savedVideos = Video::whereIn('id', $savedVideoIds)->orderBy('created_at', 'desc')->get();

        $saveVideosItems = [];
        foreach ($savedVideos as $savedVideo) {
            $usermeta = Usermeta::where('user_id', $savedVideo->user_id)->first();
            $avatarUrl = GetS3TemporaryUrl($usermeta->avatar);
            $thumbnailUrl = GetS3TemporaryUrl($savedVideo->image_file_path);
            $saveVideosItems[] = [
                'video' => $savedVideo,
                'usermeta' => $usermeta,
                'avatarUrl' => $avatarUrl,
                'thumbnailUrl' => $thumbnailUrl,
            ];
        }


        return view('profile', compact('followedUsers', 'profileUser', 'profileAvatarUrl', 'profileUsermeta', 'videoCount', 'totalViewCount', 'goodRatingCount', 'totalFollowersCount', 'videosItems', 'saveVideosItems'));
    }

    public function edit()
    {
        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        $usermeta = null; // 初期値としてnullを設定

        if ($user) {
            $usermeta = Usermeta::where('user_id', $user->id)->first();
        }


        // 取得したユーザー情報をプロフィール設定ページのビューに渡す
        return view('settings', [
            'user' => $user,
            'userMeta' => $usermeta,
        ]);
    }

    public function update(Request $request)
    {
        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        // // バリデーションを実行
        // $request->validate([
        //     'nickname' => 'string|max:255',
        //     'pin_name' => 'string|max:255',
        //     'combi_name' => 'string|max:255',
        //     // 他の入力項目に必要なバリデーションを追加する場合はここに追加
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        // ]);

        // ユーザーメタデータの取得または新規作成
        $usermeta = Usermeta::where('user_id', $user->id)->first();
        if (!$usermeta) {
            $usermeta = new Usermeta(['user_id' => $user->id]);
        }


        // 他の入力項目があれば、同様に保存する
        $image = $request->file('image-upload');

        // アバター画像の処理
        if ($request->hasFile('image-upload')) {
            $image = $request->file('image-upload');
            $imageFilePath = $image->store('avatar/' . $user->id, 's3');
            $usermeta->avatar = $imageFilePath;
        }

        // 入力された値をユーザーのメタデータに保存
        $usermeta->nickname = $request->nickname;
        $usermeta->pinname = $request->pin_name;
        $usermeta->combiname = $request->combi_name;
        $usermeta->save();

        // 基本情報の更新
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // リダイレクト先など、適切なレスポンスを返す
        return redirect()->back()->with('message', 'プロフィールが更新されました')->with('messageType', 'success');
    }
}
