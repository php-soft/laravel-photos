# Laravel Photos Module

[![Build Status](https://travis-ci.org/php-soft/laravel-photos.svg)](https://travis-ci.org/php-soft/laravel-photos)

## 1. Installation

Install via composer - edit your `composer.json` to require the package.

```js
"require": {
    // ...
    "php-soft/laravel-photos": "dev-master",
}
```

Then run `composer update` in your terminal to pull it in.
Once this has finished, you will need to add the service provider to the `providers` array in your `app.php` config as follows:

```php
'providers' => [
    // ...
    PhpSoft\ArrayView\Providers\ArrayViewServiceProvider::class,
    JD\Cloudder\CloudderServiceProvider::class, // use for cloudinary driver
    PhpSoft\Photos\Providers\PhotosServiceProvider::class,
]
```

Next, also in the `app.php` config file, under the `aliases` array, you may want to add facades.

```php
'aliases' => [
    // ...
    'Photo' => PhpSoft\Photos\Facades\Photo::class,
]
```

You will want to publish the config using the following command:

```sh
$ php artisan vendor:publish --provider="PhpSoft\Photos\Providers\PhotosServiceProvider"

# if use cloudinary driver, you need publish cloudder config as follows
$ php artisan vendor:publish --provider="JD\Cloudder\CloudderServiceProvider"
```

***You can custom configurations in the config files!***

## 2. Usage

Add routes in `app/Http/routes.php`

```php
Route::post('/photos', '\PhpSoft\Photos\Controllers\PhotosController@upload');
```
