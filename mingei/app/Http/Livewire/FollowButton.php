<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Usermeta;
use App\Models\User;
use App\Models\Follower;
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
            $this->videoUserId = $videoUserId;
            $this->videoUserfollowers = Follower::where('following_id', $videoUserId)->pluck('follower_id')->toArray();
            $this->follows = Follower::where('follower_id', auth()->user()->id)->pluck('following_id')->toArray();
        }
    }

    public function toggleFollow()
    {
        $user = auth()->user();
        
        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return Redirect::route('login');
        }

        if (in_array($this->videoUserId, $this->follows)) {
            // データが存在する場合は削除
            Follower::where('following_id', $this->videoUserId)
                ->where('follower_id', $user->id)
                ->delete();
            
        } else {
            // データが存在しない場合は追加
            Follower::create([
                'following_id' => $this->videoUserId,
                'follower_id' => $user->id,
            ]);
            
        }

        // フォロー情報更新
        $this->follows = Follower::where('follower_id', auth()->user()->id)->pluck('following_id')->toArray();
    }


    public function render()
    {
        return view('livewire.follow-button');
    }
}
