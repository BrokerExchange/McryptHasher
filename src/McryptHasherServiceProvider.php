<?php
/**
 * Created by PhpStorm.
 * User: bmix
 * Date: 10/25/17
 * Time: 10:22 AM
 */

namespace McryptHasher;

use Illuminate\Support\ServiceProvider;

/**
 * Class ElasticScoutServiceProvider
 * @package ElasticScout
 */
class McryptHasherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('hash', function () {
            return new McryptHasher;
        });
    }
}
