<?php

use App\Models\Notification; // Notificationモデルをインポート

// 通知を作成してJSONデータを保存する関数
function CreateNotification(string $notificationData)
{
    // 通知データを保存
    $notification = new Notification();
    $notification->user_id = auth()->id();
    $notification->data = $notificationData;
    $notification->save();
}
