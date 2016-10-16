# Aadhaar (Unique identification authority of India) Package on laravel 5.

Authenticating users by Aadhar is a breeze with this package.

## Installation

In order to install Aadhaar, you can do it by composer
```php
composer require qafeen/aadhaar:@dev
```
or add it in your `composer.json` file.
```js
"qafeen/aadhaar": "@dev"
```
then run `composer install` or `composer update`.

Then in your `config/app.php` file add in the `providers` list
```php
Qafeen\Aadhaar\AadhaarServiceProvider::class,
```

And then register `Aadhaar` facade in `aliases` array
```php
'Aadhaar' => Qafeen\Aadhaar\AadhaarFacade::class,
```

## Api Documentation

Notes:
1. All the required parameters will be fetch from `Request`.

####`Aadhaar::isValid()`
isValid(Partial match) will call aadhaar bridge api and submit a request. If user is authenticated then `aadhaar-reference-code` code will be return or `false`
Note: 
1. Parameters required in `Request` facade is `aadhaarId`, `pincode`, `name`.
2. Configuration such as `modality`, `certificate-type` will be loaded from `config/aadhaar.php` file.
3. If not provided in configuration file then default value will be
```php
return [
    'modality'         => 'demo',
    'certificate-type' => 'preprod',
];
```

####`Aadhaar::generateOtp()`
Generate Otp for aadhaar request.
Required parameters is `aadhaarId` in `Request`.

####`Aadhaar::verifyOtp()`
Verify the given OTP from user.
Required parameters is `aadhaarId`, `otp` in `Request`.

## Validation
You can validate aadhaarId by simply passing `valid_aadhaar` to `Validator`

```php
    return Validator::make($data, [
        'aadhaarId' => 'unique:users,aadhaar_id|valid_aadhaar',
    ], [
        'aadhaarId.unique' => 'This Aadhaar id is already been used for registration.',
        'valid_aadhaar'    => 'Please check if your aadhaar id, pincode or name is valid as per your aadhaar card.',
    ]);
```

This will automatically call aadhaar bridge api and get you validated.
