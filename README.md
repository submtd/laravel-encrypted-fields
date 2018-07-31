# laravel-encrypted-fields
Provides a trait that allows for encrypted fields on an Eloquent model

## Installation

```
composer require submtd/laravel-encrypted-fields
```

## Usage

Add the HasEncryptedFields trait to your model class, and add a protected static property called $encrypt containing an array of fields that should be encrypted.

```
<?php

use Illuminate\Database\Eloquent\Model;
use Submtd\LaravelCustomLog\HasEncryptedFields;

class Person extends Model
{
    use HasEncryptedFields;
    
    protected static $encrypt = [
        'social_security_number',
    ];
}
```

## Notes

If you add this trait to a model that already has data, you will need to update the encrypted fields on old data so that they will be encrypted. This trait provides two public static methods to help with this... ```static::encryptString($string)``` and ```static::decryptString($string)```.