<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\VideoRate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RateVideo extends Component
{
    public $videoId;
    public $goodCount = 0;
    public $badCount = 0;
    public $isActiveGood = false;
    public $isActiveBad = false;

    // public function mount($videoId)
    // {
    //     $this->videoId = $videoId;
    //     $this->goodCount = $this->getGoodCount();
    // }

    public function mount($videoId)
    {
        $this->videoId = $videoId;
        $this->goodCount = $this->getGoodCount();
        $this->badCount = $this->getBadCount();

        if (Auth::check()) {
            $user = Auth::user();
            $rating = VideoRate::where('video_id', $this->videoId)
                ->where('user_id', $user->id)
                ->first();

            if ($rating) {
                if ($rating->rating_type === 'good') {
                    $this->isActiveGood = true;
                } elseif ($rating->rating_type === 'bad') {
                    $this->isActiveBad = true;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.rate-video');
    }

    public function rateGoodVideo()
    {
        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return Redirect::route('login');
        }

        $user = Auth::user();

        // すでに評価が存在するか確認
        $existingRating = VideoRate::where('video_id', $this->videoId)
            ->where('user_id', $user->id)
            ->first();

        if ($existingRating) {
            if ($existingRating->rating_type === 'good') {
                // すでにGood評価が存在する場合は削除
                $existingRating->delete();
            } else {
                // Good評価が存在する場合はUpdate
                $existingRating->update([
                    'rating_type' => 'good',
                ]);
            }
        } else {
            // 評価が存在しない場合はInsert
            VideoRate::create([
                'video_id' => $this->videoId,
                'rating_type' => 'good',
                'user_id' => $user->id,
            ]);
        }

        // Goodとbadの数を更新
        $this->goodCount = $this->getGoodCount();
        $this->badCount = $this->getBadCount();
        // Goodボタンが選択された場合はisActiveGoodをtrueに、isActiveBadをfalseに設定
        $this->isActiveGood = !$this->isActiveGood;
        $this->isActiveBad = false;

        // ページをリフレッシュ
        $this->emit('refreshParent');
    }

    public function rateBadVideo()
    {

        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return Redirect::route('login');
        }

        $user = Auth::user();

        // すでに評価が存在するか確認
        $existingRating = VideoRate::where('video_id', $this->videoId)
            ->where('user_id', $user->id)
            ->first();

        if ($existingRating) {
            if ($existingRating->rating_type === 'bad') {
                // すでにBad評価が存在する場合は削除
                $existingRating->delete();
            } else {
                // Bad評価が存在する場合はUpdate
                $existingRating->update([
                    'rating_type' => 'bad',
                ]);
            }
        } else {
            // 評価が存在しない場合はInsert
            VideoRate::create([
                'video_id' => $this->videoId,
                'rating_type' => 'bad',
                'user_id' => $user->id,
            ]);
        }

        // Goodとbadの数を更新
        $this->goodCount = $this->getGoodCount();
        $this->badCount = $this->getBadCount();
        // Badボタンが選択された場合はisActiveBadをtrueに、isActiveGoodをfalseに設定
        $this->isActiveBad = !$this->isActiveBad;
        $this->isActiveGood = false;

        // ページをリフレッシュ
        $this->emit('refreshParent');
    }

    private function getGoodCount()
    {
        // Goodの数を取得するクエリを実行
        return VideoRate::where('video_id', $this->videoId)
            ->where('rating_type', 'good')
            ->count();
    }

    private function getBadCount()
    {
        // Goodの数を取得するクエリを実行
        return VideoRate::where('video_id', $this->videoId)
            ->where('rating_type', 'bad')
            ->count();
    }
}
