<?php

namespace Corp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Blade;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('set', function($exp) {
            list($name, $val) = explode(',', $exp);

            return "<?php $name = $val ?>";
        });

        // vizualizarea tuturor interogarilor SQL
        DB::listen(function($query) {
            //echo '<h1>' . $query->sql . '</h1>';
        });
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
