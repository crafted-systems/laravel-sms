# Laravel SMS

[![Latest Stable Version](https://poser.pugx.org/crafted-systems/laravel-sms/v/stable)](https://packagist.org/packages/vmosoti/bongatech-sms)
[![Latest Unstable Version](https://poser.pugx.org/crafted-systems/laravel-sms/v/unstable)](https://packagist.org/packages/vmosoti/bongatech-sms)
[![StyleCI](https://github.styleci.io/repos/107381762/shield?branch=master)](https://github.styleci.io/repos/107381762)
[![Build Status](https://travis-ci.org/crafted-systems/laravel-sms.svg?branch=master)](https://travis-ci.org/crafted-systems/laravel-sms)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/crafted-systems/laravel-sms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/crafted-systems/laravel-sms/?branch=master)
[![Total Downloads](https://poser.pugx.org/crafted-systems/laravel-sms/downloads)](https://packagist.org/packages/vmosoti/bongatech-sms)
[![License](https://poser.pugx.org/crafted-systems/laravel-sms/license)](https://packagist.org/packages/vmosoti/bongatech-sms)


This is a Laravel library meant to make it easier to send SMS and switch between multiple SMS Gateways.

## Installation

You can install the package via composer:

``` bash
composer require crafted-systems/laravel-sms
```
The package will register itself automatically.

Then publish the package configuration file

```bash
php artisan vendor:publish --provider=CraftedSystems\\LaravelSMS\\SMSServiceProvider
```

## Usage

The default gateway is [AfricasTalking](https://africastalking.com/)

Check the config file of all variables required, an then

```php
(new SMS())->send('254712345678','Test SMS');
```
or using Facade

```php
SMS::send('254712345678','Test SMS');
```

or using helper

```php
sms()->send('254712345678','Test SMS');
```

## Adding new Gateway

use command 
```bash
php artisan make:gateway MyGateway
```

A class `MyGateway.php` will be generated under `App/Gateways` folder.

The class extends the [SMSContract](https://github.com/crafted-systems/laravel-sms/blob/master/src/Contracts/SMSContract.php)

Remember to `map` your gateway in the sms config file.

### Changing Gateway

Apart from declaring your default gateway on the sms config or env files, you can also change the gateway you want to use on the fly. e.g: 

```php
SMS::gateway('mygateway')->send('254712345678','Test SMS');
```

### Checking SMS balance

```php
SMS::getBalance();

//or

SMS::gateway('mygateway')->getBalance();

```
### Delivery Reports
```php
sms()->getDeliveryReports(Request $request);

//or

sms()->gateway('mygateway')->getDeliveryReports(Request $request);
```

## Contributing

Suggestions, pull requests , bug reporting and code improvements are all welcome. Feel free.

## TODO

Write Tests :-(

## Credits

- [Vincent Mosoti](https://github.com/vmosoti)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
