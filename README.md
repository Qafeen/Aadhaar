# Aadhaar Validation Package for laravel 5.

Authenticating users by Aadhar is a breeze with this package.

## Installation

In order to install Aadhaar, just add

    "qafeen/aadhaar": "@dev"

to your composer.json. Then run `composer install` or `composer update`.

or you can run the `composer require` command from your terminal:

    composer require qafeen/aadhaar:@dev

Then in your `config/app.php` add
```php
    Qafeen\Aadhaar\AadhaarProvider::class,
```
in the `providers` array and
```php
    'Aadhaar' => Qafeen\Aadhaar\AadhaarFacade::class,
```
to the `aliases` array.
