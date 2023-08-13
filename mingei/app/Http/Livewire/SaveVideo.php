<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Usermeta;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use App\Models\VideoSave;

class SaveVideo extends Component
{

    public $videoId;
    public $isSaved = false;

    public function mount()
    {
        if (Auth::check()) {
            // ログインしているユーザーのIDを取得
            $userId = Auth::id();

            // ビデオを保存しているかどうかをチェック
            $this->isSaved = VideoSave::where('user_id', $userId)
                ->where('video_id', $this->videoId)
                ->exists();
        }
    }

    public function toggleSave()
    {

        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return Redirect::route('login');
        }

        // ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // ビデオを保存しているかどうかをチェック
        $savedVideo = VideoSave::where('user_id', $userId)
            ->where('video_id', $this->videoId)
            ->first();

        if ($savedVideo) {
            // ビデオを保存中の場合は削除
            $savedVideo->delete();
            $this->isSaved = false;
        } else {
            // ビデオを保存していない場合は追加
            VideoSave::create([
                'user_id' => $userId,
                'video_id' => $this->videoId,
            ]);
            $this->isSaved = true;
        }
    }


    public function render()
    {
        return view('livewire.save-video');
    }
}
