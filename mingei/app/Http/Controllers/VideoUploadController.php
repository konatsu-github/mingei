<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoUploadController extends Controller
{
    public function store(Request $request)
    {
        // フォームから送信された動画を処理するコードを記述します

        // 例えば、動画ファイルを保存する場合は以下のようにします
        if ($request->hasFile('file-upload')) {
            $video = $request->file('file-upload');
            
            $path = $video->store('videos', 's3');

            // 保存したファイルのパスをデータベースなどに保存することもできます
            // 例えば、Videoモデルを使用して保存する場合
            // use App\Models\Video;
            // $videoModel = new Video();
            // $videoModel->path = $path;
            // $videoModel->save();

            // 成功メッセージなどの処理を行い、リダイレクトするなどの操作を行います
            return redirect()->route('upload')->with('message', '動画がアップロードされました！')->with('messageType', 'success');
        }

        // フォームに動画が選択されていない場合はエラーメッセージを表示するなどの処理を行います
        return redirect()->back()->withErrors('動画が選択されていません。')->with('message', '動画が選択されていません。')->with('messageType', 'error');
    }
}
