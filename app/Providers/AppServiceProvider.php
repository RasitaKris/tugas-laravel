<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

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
        // Membuat variabel global cartCount utk semua Blade
        view()->composer('*', function ($view) {
            $count = 0;

            // User login, hitung keranjang
            if (Auth::check()) {
                $count = CartItem::where('user_id', Auth::id())->sum('quantity');
            }

            // Share ke semua view
            $view->with('cartCount', $count);
        });
    }
}
