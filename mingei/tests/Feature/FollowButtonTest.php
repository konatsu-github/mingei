<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Http\Livewire\FollowButton;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowButtonTest extends TestCase
{
    use RefreshDatabase;

    public function testFollowButtonTogglesFollowStatus()
    {
        // テストに必要なユーザーとデータを作成
        $user = User::factory()->create();
        $videoUser = User::factory()->create();
        Follower::create([
            'following_id' => $videoUser->id,
            'follower_id' => $user->id,
        ]);

        // テストを実行
        Livewire::actingAs($user) // ユーザーを認証状態にする
            ->test(FollowButton::class, ['videoUserId' => $videoUser->id])
            ->call('toggleFollow');

        // フォローのトグルが正しく動作しているか検証
        $this->assertDatabaseMissing('followers', [
            'following_id' => $videoUser->id,
            'follower_id' => $user->id,
        ]);

        // フォローボタンを再度クリックしてフォローする
        Livewire::actingAs($user)
            ->test(FollowButton::class, ['videoUserId' => $videoUser->id])
            ->call('toggleFollow');

        // フォローのトグルが正しく動作しているか再度検証
        $this->assertDatabaseHas('followers', [
            'following_id' => $videoUser->id,
            'follower_id' => $user->id,
        ]);
    }
}
