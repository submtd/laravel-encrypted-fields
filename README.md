# laravel-encrypted-fields
Provides a trait that allows for encrypted fields on an Eloquent model

## Installation

```
composer require submtd/laravel-encrypted-fields
```

## Usage

Add the HasEncryptedFields trait to your model class, and add a protected property called $encrypted containing an array of fields that should be encrypted.

```
<?php

use Illuminate\Database\Eloquent\Model;
use Submtd\LaravelCustomLog\HasEncryptedFields;

class Person extends Model
{
    use HasEncryptedFields;
    
    protected $encrypted = [
        'social_security_number',
    ];
}
```
