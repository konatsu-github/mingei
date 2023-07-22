<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Video; // Videoモデルを使用するためにインポート
use Illuminate\Support\Facades\Auth; // Authファサードを使用するためにインポート

class VideoUploadController extends Controller
{

    public function getTemporaryUrl($filePath)
    {
        // S3のファイルに期限付きURLを取得する
        $expires = now()->addMinutes(env('AWS_S3_TMP_TIME'));

        $temporaryUrl = Storage::disk('s3')->temporaryUrl($filePath, $expires);

        return $temporaryUrl;
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
