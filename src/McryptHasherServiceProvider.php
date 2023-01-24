<?php
/**
 * Created by PhpStorm.
 * User: bmix
 * Date: 10/25/17
 * Time: 10:22 AM
 */

namespace McryptHasher;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

/**
 * Class McryptHasherServiceProvider
 * @package McryptHasher
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
        $this->mergeConfigFrom(
            __DIR__.'/../config/mcrypt.php', 'app.mcrypt'
        );

        Hash::extend('mcrypt', static function () {
            return new McryptHasher();
        });
    }
}
