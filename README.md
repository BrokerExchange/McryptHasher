# McryptHasher
Mcrypt Hasher For Laravel Auth

This package will replace Laravel's default hash service provider.

## Installation
1. `composer require brokerexchange/mcrypthasher`
2. Add MCRYPT_KEY to your .env file
    - `MCRYPT_KEY='My awesome hash key'`
3. If you are using Laravel 5.5+, this package will be auto-discovered. Otherwise, add `McryptHasher\McryptHasherServiceProvider::class,` to config/app.php
    
## Usage
Once installed the mcrypt hasher will automatically be used during authentication and registration. You may also resolve the hasher out of the service container as you normally would. `app'('hash')->make($string)`

###### Copyright &copy; 2018 Broker Exchange Network
