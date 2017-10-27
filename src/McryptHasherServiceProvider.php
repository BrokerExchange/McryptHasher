<?php
/**
 * Created by PhpStorm.
 * User: bmix
 * Date: 10/25/17
 * Time: 10:22 AM
 */

namespace McryptHasher;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

/**
 * Class McryptHasherServiceProvider
 * @package McryptHasher
 */
class McryptHasherServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/mcrypt.php', 'app.mcrypt'
        );

        $this->app->singleton('hash', function () {

            if (Str::startsWith($key = config('app.mcrypt.key'), 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }

            return new McryptHasher($key);
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
