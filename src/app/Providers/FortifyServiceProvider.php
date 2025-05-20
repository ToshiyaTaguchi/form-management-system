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
        // 新規ユーザの登録処理
        Fortify::createUsersUsing(CreateNewUser::class);

            // GETメソッドで/registerにアクセスしたときに表示するviewファイル
            Fortify::registerView(function () {
                return view('auth.register');
            });
        
            // GETメソッドで/loginにアクセスしたときに表示するviewファイル
            Fortify::loginView(function () {
                return view('auth.login');
                });
            
            // ログインレート制限
            // 1分間に10回までのログインを許可
            RateLimiter::for('login', function (Request $request) {
                $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());

            });
        
            // ログイン後のリダイレクト先
            app()->singleton(
                \Laravel\Fortify\Contracts\LoginResponse::class,
                function () {
                    return new class implements \Laravel\Fortify\Contracts\LoginResponse {
                        public function toResponse($request)
                        {
                            return redirect()->route('admin.index'); // 👈 リダイレクト先をここで設定
                        }
                    };
                }
            );
    }
}
