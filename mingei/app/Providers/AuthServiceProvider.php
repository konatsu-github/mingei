<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Usermeta;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        // 共通のアバター画像URLをViewに渡す
        View::composer('*', function ($view) {
            $user = Auth::user();
            $avatarUrl = null; // 初期値としてnullを設定
            if ($user) {
                $usermeta = Usermeta::where('user_id', $user->id)->first();
                if ($usermeta) {
                    $avatarUrl = GetS3TemporaryUrl($usermeta->avatar);
                }
            }
            $view->with('avatarUrl', $avatarUrl);
        });
    }
}
