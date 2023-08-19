<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Usermeta;
use App\Models\Video;

class UnsubscribeController extends Controller
{
    public function unsubscribe(Request $request)
    {
        $user = auth()->user();
        $usermeta = UserMeta::where('user_id', $user->id)->first();

        // アバター画像の削除
        if ($usermeta) {
            $avatarPath = $usermeta->avatar;
            if ($avatarPath !== "avatar/default_avatar.png") {
                Storage::disk('s3')->delete($avatarPath);
            }
        }

        // 動画の削除と関連する素材の削除
        $videos = Video::where('user_id', $user->id)->get();
        foreach ($videos as $video) {
            // サムネイル画像の削除
            if ($video->image_file_path) {
                $thumbnailPath = $video->image_file_path;
                Storage::disk('s3')->delete($thumbnailPath);
            }

            // 動画ファイルの削除
            if ($video->video_file_path) {
                $videoPath = $video->video_file_path;
                Storage::disk('s3')->delete($videoPath);
            }

            $video->delete();
        }

        // ユーザーの削除
        $user->delete();

        // 退会後のリダイレクト先などを指定
        return redirect()->route('home')->with('success', '退会が完了しました。');
    }
}
