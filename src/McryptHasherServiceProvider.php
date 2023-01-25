<?php
/**
 * Created by PhpStorm.
 * User: bmix
 * Date: 10/25/17
 * Time: 10:22 AM
 *
 */

namespace McryptHasher;

use Illuminate\Support\Facades\Hash;
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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../config/mcrypt.php' => config_path('mcrypt.php')
        ], 'mcrypt');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/mcrypt.php', 'mcrypt.key'
        );

        Hash::extend('mcrypt', static function(){

            if (Str::startsWith($key = config('mcrypt.key'), 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }

            return new McryptHasher($key);

        });

    }

}
