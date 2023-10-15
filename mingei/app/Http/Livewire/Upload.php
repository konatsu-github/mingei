<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Video; // Videoモデルを使用するためにインポート
use App\Models\Follower;
use Illuminate\Support\Facades\Auth; // Authファサードを使用するためにインポート
use Illuminate\Support\Facades\Storage;
use App\Models\Usermeta;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Upload extends Component
{

    use WithFileUploads;

    public $title;
    public $description;
    public $thumbnail;
    public $video;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'video' => 'required|max:1073741824|mimetypes:video/mp4,video/webm,video/quicktime,video/x-msvideo,video/x-matroska,video/x-flv,video/3gpp,video/x-ms-wmv', // 1GB
        'thumbnail' => 'required|image|mimes:jpeg,png,gif,bmp,webp|max:104857600', // 100MB画像ファイルのバリデーション
    ];


    public function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->video = null;
        $this->thumbnail = null;

        $this->resetValidation(); // バリデーションメッセージをクリア
    }

    public function render()
    {
        return view('livewire.upload');
    }

    public function save(Request $request)
    {
        $this->validate();
        
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // 動画アップロード
        $videoFilePath = $this->video->store('videos', 's3');

        // 画像アップロードとトリミング
        $imageFilePath = $this->resizeAndStoreImage($this->thumbnail);

        // 保存したファイルのパスをデータベースに保存します
        $videoModel = new Video();
        $videoModel->user_id = $userId;
        $videoModel->title = $this->title;
        $videoModel->description = $this->description;
        $videoModel->video_file_path = $videoFilePath;
        $videoModel->image_file_path = $imageFilePath;
        $videoModel->save();

        // 保存したデータのIDを取得
        $videoId = $videoModel->id;

        // フォロワーのユーザーIDを取得
        $followerIds = Follower::where('following_id', $userId)->pluck('follower_id')->toArray();

        // 通知を作成し、フォロワーに送信
        foreach ($followerIds as $followerId) {
            $profilePageUrl = route('profile.show', ['id' => $userId]);
            $profileName = GetDisplayName();
            $videoUrl = route('watch', ['videoId' => $videoId]);
            $notificationData = "<a href='{$profilePageUrl}' class='text-orange-400 font-bold'>{$profileName}さん</a>が<a href='{$videoUrl}' class='text-orange-400 font-bold'>新しい動画</a>をアップロードしました";

            CreateNotification($notificationData, $followerId);
        }

        // 成功メッセージなどの処理を行い、リダイレクトするなどの操作を行います
        return redirect()->route('upload')->with('message', '動画がアップロードされました！')->with('messageType', 'success');
    }

    // 画像をリサイズしてS3に保存するメソッド
    private function resizeAndStoreImage($image)
    {
        $imagePath = $image->store('temp', 'public'); // 一時的にストレージに保存

        // 画像をリサイズ
        $resizedImage = Image::make(storage_path('app/public/' . $imagePath))
            ->fit(640, 360)
            ->encode();

        $resizedImagePath = 'images/' . uniqid() . '.jpg'; // 一意のファイル名を生成

        // リサイズした画像をS3に保存
        Storage::disk('s3')->put($resizedImagePath, $resizedImage);

        // 一時ファイルを削除
        Storage::disk('public')->delete($imagePath);

        return $resizedImagePath;
    }
}
