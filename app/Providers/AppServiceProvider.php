<?php

namespace App\Providers;

use App\Helpers\Configuration;
use Illuminate\Support\ServiceProvider;

use App\Helpers\Nestable;
use Modules\Product\Entities\CategoryProducts;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $categoryProduct = CategoryProducts::get_cat();
        $nest = new Nestable($categoryProduct);
        $cat_product = $nest->make_category();

        View::share('cat_product', $cat_product);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
