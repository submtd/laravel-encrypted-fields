<?php

namespace Submtd\LaravelEncryptedFields;

/**
 * Add this trait to Eloquent models in order to encrypt
 * fields that are stored in the database.
 */
trait HasEncryptedFields
{
    /**
    * If the attribute is in the encrypted array
    * then decrypt it.
    * @param $key
    * @return mixed
    */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, (array) $this->encrypted) && !empty($value)) {
            return decrypt($value);
        }
        return $value;
    }

    /**
     * If the attribute is in the encrypted array
     * then encrypt it.
     * @param $key
     * @param mixed $value
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, (array) $this->encrypted) && !empty($value)) {
            $value = encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }

    /**
     * Iterate through all kekys on toArray
     * @return array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        foreach ((array) $this->encrypted as $key) {
            if (isset($attributes[$key]) && !empty($attributes[$key])) {
                $attributes[$key] = decrypt($attributes[$key]);
            }
        }
        return $attributes;
    }
}
