# Aadhaar (Unique identification authority of India) Package on laravel 5.

Authenticating users by Aadhar is a breeze with this package.

## Installation

In order to install Aadhaar, just add

```js
"qafeen/aadhaar": "@dev"
```

to your composer.json. Then run `composer install` or `composer update`.

or you can run the `composer require` command from your terminal:

```php
composer require qafeen/aadhaar:@dev
```

Then in your `config/app.php` add
```php
Qafeen\Aadhaar\AadhaarProvider::class,
```
in the `providers` array and
```php
'Aadhaar' => Qafeen\Aadhaar\AadhaarFacade::class,
```
to the `aliases` array.

### Api Documentation
Note all the required parameters will be fetch from `Request` facade.

####`Aadhaar::isValid()`
Partial match will call aadhaar bridge api and submit a request. If user is authenticated then `aadhaar-reference-code` code will be return or `false`
Note: 
1. Parameters required in `Request` facade are `aadhaarId`, `pincode`, `name`
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
Paramters required is `aadhaarId` in `Request` facade.

####`Aadhaar::verifyOtp()`
Verify OTP.
Parameters required is `aadhaarId`, `otp` in `Request`.

