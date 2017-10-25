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
    public function register()
    {
        $this->app->singleton('hash', function () {
            return new McryptHasher;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hash'];
    }
}
