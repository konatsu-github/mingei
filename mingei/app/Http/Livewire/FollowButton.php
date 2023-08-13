<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Usermeta;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class FollowButton extends Component
{
    public $videoUserId;
    public $videoUserfollowers = [];
    public $follows = [];

    public function mount($videoUserId)
    {
        if (Auth::check()) {
            $user = auth()->user();
            $videoUser = User::find($this->videoUserId);
            // ユーザーメタデータの取得または新規作成
            $usermeta = Usermeta::where('user_id', $user->id)->first();
            $videoUsermeta = Usermeta::where('user_id', $videoUser->id)->first();

            $this->videoUserId = $videoUserId;
            $this->videoUserfollowers = $videoUsermeta->followers ? unserialize($videoUsermeta->followers) : [];
            $this->follows = $usermeta->follows ? unserialize($usermeta->follows) : [];
        }
    }

    public function toggleFollow()
    {

        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return Redirect::route('login');
        }

        if (in_array(auth()->user()->id, $this->videoUserfollowers)) {
            $this->videoUserfollowers = array_diff($this->videoUserfollowers, [auth()->user()->id]);
        } else {
            $this->videoUserfollowers[] = auth()->user()->id;
        }

        if (in_array($this->videoUserId, $this->follows)) {
            $this->follows = array_diff($this->follows, [$this->videoUserId]);
        } else {
            $this->follows[] = $this->videoUserId;
        }

        $this->saveFollowData();
    }

    public function saveFollowData()
    {

        $user = auth()->user();
        $videoUser = User::find($this->videoUserId);
        // ユーザーメタデータの取得または新規作成
        $usermeta = Usermeta::where('user_id', $user->id)->first();
        $videoUsermeta = Usermeta::where('user_id', $videoUser->id)->first();
        if (!$usermeta) {
            $usermeta = new Usermeta(['user_id' => $user->id]);
        }
        if (!$videoUsermeta) {
            $videoUsermeta = new Usermeta(['user_id' => $videoUsermeta->id]);
        }

        // usermetaテーブルのカラムをシリアライズして保存
        $videoUsermeta->followers = serialize($this->videoUserfollowers);
        $videoUsermeta->save();
        $usermeta->follows = serialize($this->follows);
        $usermeta->save();
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
