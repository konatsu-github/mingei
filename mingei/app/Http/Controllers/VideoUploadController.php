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

        // 期限付きURLを使って何かしらの操作を行う場合
        // 例えば、ビューに表示する場合など
        // return view('video_player', ['temporaryUrl' => $temporaryUrl]);

        return $temporaryUrl;
    }

    public function store(Request $request)
    {
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();


        // 例えば、動画ファイルを保存する場合は以下のようにします
        if ($request->hasFile('file-upload')) {
            $video = $request->file('file-upload');

            $filePath = $video->store('videos', 's3');


            // 保存したファイルのパスをデータベースに保存します
            $videoModel = new Video();
            $videoModel->user_id = $userId;
            $videoModel->title = 'test';
            $videoModel->description = 'test';
            $videoModel->file_path = $filePath;
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
