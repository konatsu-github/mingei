<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ユーザーモデルへの参照を追加
use App\Models\Usermeta;

class ProfileController extends Controller
{
    public function showProfileSettings()
    {
        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        $usermeta = null; // 初期値としてnullを設定

        if ($user) {
            $usermeta = Usermeta::where('user_id', $user->id)->first();
        }


        // 取得したユーザー情報をプロフィール設定ページのビューに渡す
        return view('settings', [
            'user' => $user,
            'userMeta' => $usermeta
        ]);
    }

    public function updateProfileSettings(Request $request)
    {
        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        // // バリデーションを実行
        // $request->validate([
        //     'nickname' => 'string|max:255',
        //     'pin_name' => 'string|max:255',
        //     'combi_name' => 'string|max:255',
        //     // 他の入力項目に必要なバリデーションを追加する場合はここに追加
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        // ]);

        // ユーザーメタデータの取得または新規作成
        $usermeta = Usermeta::where('user_id', $user->id)->first();
        if (!$usermeta) {
            $usermeta = new Usermeta(['user_id' => $user->id]);
        }


        // 他の入力項目があれば、同様に保存する
        $image = $request->file('image-upload');

        // アバター画像の処理
        if ($request->hasFile('image-upload')) {
            $image = $request->file('image-upload');
            $imageFilePath = $image->store('avatar/' . $user->id, 's3');
            $usermeta->avatar = $imageFilePath;
        }

        // 入力された値をユーザーのメタデータに保存
        $usermeta->nickname = $request->nickname;
        $usermeta->pinname = $request->pin_name;
        $usermeta->combiname = $request->combi_name;
        $usermeta->avatar =  $imageFilePath;
        $usermeta->save();

        // 基本情報の更新
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // リダイレクト先など、適切なレスポンスを返す
        return redirect()->back()->with('message', 'プロフィールが更新されました')->with('messageType', 'success');
    }
}
