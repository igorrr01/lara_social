<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Список количества пользователей онлайн
        view()->composer('*', function ($user){
            $users_online = User::orderBy('last_move', 'desc')->limit(10)->get();
            $user->with(['users_online' => $users_online]);
        });

    }
}
