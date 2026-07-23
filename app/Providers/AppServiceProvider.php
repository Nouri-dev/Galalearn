<?php

namespace App\Providers;

use App\Models\Category;
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
   /*  public function boot(): void
    {
      // Partager les catégories avec toutes les vues qui incluent la navbar
      view()->composer('partials.navbar', function ($view) {
        $categories = Category::whereNull('parent_category_id')->get();
        $view->with('categories', $categories);
    }); 
    }  */


    public function boot()
    {
        // Partager les catégories uniquement avec la vue 'layouts.app'
        View::composer('layouts.app', function ($view) {
            $categories = Category::whereNull('parent_category_id')->get();
            $view->with('categories', $categories);
        });
    }
}
