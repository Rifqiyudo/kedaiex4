<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
        $user = session('user');
        $cartCount = 0;

        if ($user) {
            $cartCount = Cart::where('user_id', $user->id)
                ->where('status', 'Belum Checkout')
                ->count();
        }

        $view->with('cartCount', $cartCount);
    });
    }
}
