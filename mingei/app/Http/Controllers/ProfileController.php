<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ユーザーモデルへの参照を追加

class ProfileController extends Controller
{
    public function showProfileSettings()
    {
        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        // 取得したユーザー情報をプロフィール設定ページのビューに渡す
        return view('settings', [
            'user' => $user,
            'userMeta' => $user->userMeta,
        ]);
    }

    public function updateProfileSettings(Request $request)
    {
        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        // バリデーションを実行
        $request->validate([
            'nickname' => 'string|max:255',
            'pin_name' => 'string|max:255',
            'combi_name' => 'string|max:255',
            // 他の入力項目に必要なバリデーションを追加する場合はここに追加
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        
        // 他の入力項目があれば、同様に保存する
        $image = $request->file('image-upload');
        $extension = $image->getClientOriginalExtension(); // 画像の拡張子を取得
        
        // ハッシュ化したファイル名を生成
        $hashedFileName = md5(uniqid()) . '.' . $extension;
        
        // 画像を指定したパスに保存
        $imageFilePath = $image->storeAs('images', $hashedFileName, 'public');

        // 入力された値をユーザーのメタデータに保存
        $user->userMeta->nickname = $request->nickname;
        $user->userMeta->pinname = $request->pin_name;
        $user->userMeta->combiname = $request->combi_name;
        $user->userMeta->avatar = $imageFilePath;

        // ユーザーのメタデータを保存
        $user->userMeta->save();

        // 基本情報の更新
        $user->name = $request->name;
        $user->email = $request->email;

        // ユーザー情報を保存
        $user->save();

        // リダイレクト先など、適切なレスポンスを返す
        return redirect()->back()->with('message', 'プロフィールが更新されました')->with('messageType', 'success');
    }
}
