# Pagar.me PHP SDK for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![StyleCI][icon-styleci]][link-styleci]
[![Coverage Status][ico-code-climate]][link-code-climate]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Pagar.me SDK for Laravel applications.

## Install

Via Composer

``` bash
$ composer require flyingluscas/pagarme-laravel
```

## Usage

#### 1. Service Provider and Facade

Set up the **service provider** and the **facade** in your **config/app.php** file.

``` php
'providers' => [
    FlyingLuscas\PagarMeLaravel\PagarMeServiceProvider::class,
],

'aliases' => [
    'PagarMe' => FlyingLuscas\PagarMeLaravel\PagarMeFacade::class,
],
```

#### 2. Configurations

Publish the **config/pagarme.php** file and set [your keys from the Pagar.me API][link-pagarme-dash].

``` bash
$ php artisan vendor:publish --provider="FlyingLuscas\PagarMeLaravel\PagarMeServiceProvider"
```

#### 3. Ready to go

You are ready to start creating your transactions using the PagarMe facade, see a quick example below.

``` php
PagarMe::transaction()
    ->boletoTransaction(
        1000,
        $customer,
        'http://requestb.in/pkt7pgpk',
        ['id_product' => 13933139]
    );
```

For more examples please visit the original [documentation available here][link-pagarme-wiki].

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email lucas.pires.mattos@gmail.com instead of using the issue tracker.

## Credits

- [Lucas Pires][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/flyingluscas/pagarme-laravel.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/flyingluscas/pagarme-laravel/master.svg?style=flat-square
[icon-styleci]: https://styleci.io/repos/91294514/shield?branch=master
[ico-code-climate]: https://img.shields.io/codeclimate/coverage/github/flyingluscas/pagarme-laravel.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/codeclimate/github/flyingluscas/pagarme-laravel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/flyingluscas/pagarme-laravel.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/flyingluscas/pagarme-laravel
[link-travis]: https://travis-ci.org/flyingluscas/pagarme-laravel
[link-styleci]: https://styleci.io/repos/91294514
[link-code-climate]: https://codeclimate.com/github/flyingluscas/pagarme-laravel/coverage
[link-code-quality]: https://codeclimate.com/github/flyingluscas/pagarme-laravel/code
[link-downloads]: https://packagist.org/packages/flyingluscas/pagarme-laravel
[link-author]: https://github.com/flyingluscas
[link-contributors]: ../../contributors
[link-pagarme-wiki]: https://github.com/pagarme/pagarme-php/wiki
[link-pagarme-dash]: https://dashboard.pagar.me/#/myaccount/apikeys
