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