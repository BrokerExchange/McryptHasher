# McryptHasher
Mcrypt Hasher For Laravel Auth

This package will replace Laravel's default hash service provider.

## Installation
1. `composer require brokerexchange/mcrypthasher`

2. (Optional) Publish the config
   - `php artisan vendor:publish --tag=mcrypt`

4. (Optional) Add MCRYPT_KEY to your .env file
    - `MCRYPT_KEY='My awesome hash key'`  

  note: this step is optional because APP_KEY will be used if MCRYPT_KEY is not provided in your project.   

5. If you are using Laravel 5.5+, this package will be auto-discovered. Otherwise, add `McryptHasher\McryptHasherServiceProvider::class,` to config/app.php

```php
<?php
    // ...

     /*
     * Package Service Providers...
      */
      McryptHasher\McryptHasherServiceProvider::class

    // ...
```
 
4. In the `config/hashing.php` file update the `driver` value to 'mcrypt':
   
```php
<?php

   return [
       // ...
       
       'driver' => 'mcrypt',
   
       // ...
   ];
```
    
## Usage
Once installed the mcrypt hasher will automatically be used during authentication and registration. If you wish to use 
the package manually, you may now use the Hash facade.  ex: `Hash::make('12345')`

If you wish to continue using other hash drivers, add a driver function call to the Hash facade chain. ex: `Hash::driver('bcrypt')->make('12345')` 

###### Copyright &copy; 2023 Broker Exchange Network 
