<?php

namespace Submtd\LaravelEncryptedFields;

/**
 * Add this trait to Eloquent models in order to encrypt
 * fields that are stored in the database.
 */
trait HasEncryptedFields
{
    /**
     * boot method for this trait
     * encrypts fields on creating and updating
     * decrypts fields on retrieved
     */
    public static function bootHasEncryptedFields()
    {
        self::creating(function ($model) {
            self::encryptFields($model);
        });
        self::updating(function ($model) {
            self::encryptFields($model);
        });
        self::retrieved(function ($model) {
            self::decryptFields($model);
        });
    }

    /**
     * loop through the public static $encrypt array on the model
     * and encrypt any fields defined there
     */
    private static function encryptFields($model)
    {
        foreach (self::$encrypt as $field) {
            $model->$field = self::encryptString($model->$field);
        }
    }

    /**
     * loop through the public static $encrypt array on the model
     * and decrypt any fields defined there
     */
    private static function decryptFields($model)
    {
        foreach (self::$encrypt as $field) {
            $model->$field = self::decryptString($model->$field);
        }
    }

    /**
     * encrypt a string
     */
    public static function encryptString($string)
    {
        return openssl_encrypt($string, 'AES-128-ECB', env('APP_KEY'));
    }

    /**
     * decrypt a string
     */
    public static function decryptString($string)
    {
        return openssl_decrypt($string, 'AES-128-ECB', env('APP_KEY'));
    }
}
