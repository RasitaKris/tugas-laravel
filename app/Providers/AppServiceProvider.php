<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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
       // LOCALE (MULTI LANGUAGE)
        
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        
        // GLOBAL CART COUNT
       
        view()->composer('*', function ($view) {
            $count = 0;
          
            if (Auth::check()) {
                $count = CartItem::where('user_id', Auth::id())->sum('quantity');
            }

            $view->with('cartCount', $count);
        });
    }
}
