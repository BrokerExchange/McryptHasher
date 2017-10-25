<?php
/**
 * Created by PhpStorm.
 * User: bmix
 * Date: 10/25/17
 * Time: 10:23 AM
 */

namespace McryptHasher;

use Illuminate\Contracts\Hashing\Hasher;

/**
 * Class McryptHasher
 * @package App\Mcrypt
 */
class McryptHasher implements Hasher
{
    /**
     * @param string $value
     * @param array $options
     * @return string
     */
    public function make($value, array $options = [])
    {
        return $this->encrypt($value);
    }


    private function key()
    {
        return config('app.key');
    }

    /**
     * encrypt the input
     * @param $input
     * @return string
     */
    private function encrypt($input)
    {
        if($input<>''){
            $td = @mcrypt_module_open (MCRYPT_BLOWFISH, "", MCRYPT_MODE_ECB, "");
            $iv = @mcrypt_create_iv (@mcrypt_enc_get_iv_size ($td), MCRYPT_RAND);
            @mcrypt_generic_init ($td, $this->key(), $iv);
            $encrypted_data = base64_encode(@mcrypt_generic ($td, $input));
            @mcrypt_generic_deinit($td);
            return $encrypted_data;
        }
        return '';
    }

    /**
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0 || strlen($value) === 0) {
            return false;
        }

        return ($this->encrypt($value) === $hashedValue);
    }

    /**
     * stub
     * @param string $hashedValue
     * @param array $options
     * @return void
     */
    public function needsRehash($hashedValue, array $options = []) {}
}

