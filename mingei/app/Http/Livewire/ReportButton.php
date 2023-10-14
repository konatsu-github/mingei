<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

class ReportButton extends Component
{
    public $showModal = false;
    public $reportReason = '';
    public $videoId;

    public function sendReport($recaptchaToken)
    {
        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return Redirect::route('login');
        }

        $secret_key = config('services.recaptcha.secret_key');
        $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response=" . $recaptchaToken);
        $reCAPTCHA = json_decode($verifyResponse);

        if (!$reCAPTCHA->success) {
            // reCAPTCHA 検証エラーが発生した場合の処理
            // 例: エラーメッセージを表示する
            return redirect()->route('watch', ['videoId' => intval($this->videoId)])
                ->with('message', 'ロボットと判定されたため、報告に失敗しました')
                ->with('messageType', 'error');
        }

        // ログインユーザーの名前を取得
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;

        // 現在のURLを取得
        $currentUrl = route('watch', ['videoId' => intval($this->videoId)]);

        // メール送信ロジック
        $reportReason = $this->reportReason;
        Mail::send([], [], function ($message) use ($reportReason, $userId, $userName, $currentUrl) {
            $message->to('konatsu.business@gmail.com')
                ->subject('MINGEIで新しい報告があります')
                ->setBody("報告理由: $reportReason\n\n報告したユーザーID:$userId\n\n報告したユーザー名: $userName\n\nURL: $currentUrl");
        });

        $this->reset(['showModal', 'reportReason']);

        return redirect()->route('watch', ['videoId' => intval($this->videoId)])
            ->with('message', '報告が完了しました')
            ->with('messageType', 'success');
    }

    public function render()
    {
        return view('livewire.report-button');
    }
}
