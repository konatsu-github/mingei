<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    // 通知一覧を表示
    public function index()
    {
        return view('notifications');
    }

}
