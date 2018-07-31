<?php

namespace Submtd\LaravelEncryptedFields;

trait HasEncryptedFields
{
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

    private static function encryptFields($model)
    {
        foreach (self::$encrypt as $field) {
            $model->$field = self::encryptString($model->$field);
        }
    }

    private static function decryptFields($model)
    {
        foreach (self::$encrypt as $field) {
            $model->$field = self::decryptString($model->$field);
        }
    }

    public static function encryptString($string)
    {
        return openssl_encrypt($string, 'AES-128-ECB', env('APP_KEY'));
    }

    public static function decryptString($string)
    {
        return openssl_decrypt($string, 'AES-128-ECB', env('APP_KEY'));
    }
}
