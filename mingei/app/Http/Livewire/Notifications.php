<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB; // DBファサードをインポート
use App\Models\Notification; // Notificationモデルをインポート

class Notifications extends Component
{
    public function render()
    {
        // 既読および未読の通知を取得して表示
        $notifications = Notification::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('livewire.notifications', compact('notifications'));
    }

    public function notificationRead()
    {
        // 未読の通知をすべて既読にする
        DB::table('notifications')
            ->where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }
}
