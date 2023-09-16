<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Video; // Videoモデルを使用するためにインポート
use Illuminate\Support\Facades\Auth; // Authファサードを使用するためにインポート
use Illuminate\Support\Facades\Storage;
use App\Models\Usermeta;
use Image; // Intervention Imageをインポート

class Upload extends Component
{

    use WithFileUploads;

    public $title;
    public $description;
    public $thumbnail;
    public $video;

    public function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->video = null;
        $this->thumbnail = null;
    }

    public function render()
    {
        return view('livewire.upload');
    }

    public function save()
    {
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // 動画アップロード
        $videoFilePath = $this->video->store('videos', 's3');

        // 画像アップロードとトリミング
        $image = Image::make($this->thumbnail)->fit(640, 360)->stream();
        $imageFilePath = 'images/' . uniqid() . '.jpg'; // 一意のファイル名を生成

        // S3にトリミングされた画像を保存
        Storage::disk('s3')->put($imageFilePath, $image->__toString());

        // 保存したファイルのパスをデータベースに保存します
        $videoModel = new Video();
        $videoModel->user_id = $userId;
        $videoModel->title = $this->title;
        $videoModel->description = $this->description;
        $videoModel->video_file_path = $videoFilePath;
        $videoModel->image_file_path = $imageFilePath;
        $videoModel->save();

        // 成功メッセージなどの処理を行い、リダイレクトするなどの操作を行います
        return redirect()->route('upload')->with('message', '動画がアップロードされました！')->with('messageType', 'success');

        // // フォームに動画が選択されていない場合はエラーメッセージを表示するなどの処理を行います
        // return redirect()->back()->withErrors('動画が選択されていません。')->with('message', '動画が選択されていません。')->with('messageType', 'error');
    }
}
