<?php
/**
 * Created by PhpStorm.
 * User: bmix
 * Date: 10/25/17
 * Time: 10:23 AM
 */

namespace McryptHasher;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\AbstractHasher;
use RuntimeException;

/**
 * Class McryptHasher
 * @package McryptHasher
 */
class McryptHasher extends AbstractHasher implements Hasher
{
    /**
     * @var
     */
    protected $key;

    /**
     * McryptHasher constructor.
     * @param $key
     */
    public function __construct($key)
    {
        if(empty($key)) {
            throw new RuntimeException('Unsupported hash key value');
        }

        $this->key = $key;
    }

    /**
     * @param string $value
     * @param array $options
     * @return string
     */
    public function make($value, array $options = []): string
    {
        //make sure the input is valid
        if(empty($value)) {
            throw new RuntimeException('Invalid hash input');
        }

        $td = @mcrypt_module_open (MCRYPT_BLOWFISH, "", MCRYPT_MODE_ECB, "");
        $iv = @mcrypt_create_iv (@mcrypt_enc_get_iv_size ($td), MCRYPT_RAND);
        @mcrypt_generic_init ($td, $this->key, $iv);
        $encrypted_data = base64_encode(@mcrypt_generic ($td, $value));
        @mcrypt_generic_deinit($td);

        //make sure the encrypted data is valid
        if(empty($encrypted_data)) {
            throw new RuntimeException('Hash unsuccessful');
        }

        return $encrypted_data;
    }

    /**
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = []): bool
    {
        if (strlen($hashedValue) === 0 || strlen($value) === 0) {
            return false;
        }

        return ($this->make($value) === $hashedValue);
    }

    /**
     * Implemented to fulfill the contract.
     *
     * @param string $hashedValue
     * @param array $options
     * @return false
     */
    public function needsRehash($hashedValue, array $options = []): bool
    {
        return false;
    }
}

