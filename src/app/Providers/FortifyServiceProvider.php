<?php

namespace App\Providers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Laravel\Fortify\Contracts\LoginResponse;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 登録処理のクラスを指定（CreateNewUser に __invoke() が必要）
        Fortify::createUsersUsing(CreateNewUser::class);

        // 登録ページの表示
        Fortify::registerView(function () {
            return view('auth.register');
        });
        
        // ログイン処理のクラスを指定
        Fortify::loginView(function () {
            return view('auth.login');
            });
            
        // ログインレート制限
        // 1分間に10回までのログインを許可
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            
            });

        // ログイン後のリダイレクト先
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                return redirect('/admin');
            }
        });
    }
}
