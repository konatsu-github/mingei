<?php

use App\Models\Notification; // Notificationモデルをインポート

function GetUnreadNotificationCount()
{
    // 未読の通知の数を取得
    $unreadCount = Notification::where('user_id', auth()->id())
        ->whereNull('read_at')
        ->count();

    if ($unreadCount > 99) {
        $unreadCount = '99+';
    }

    return $unreadCount;
}
