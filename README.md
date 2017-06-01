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

#### Set up

Set up the **service provider** and the **facade** in your **config/app.php** file.

``` php
'providers' => [
    FlyingLuscas\PagarMeLaravel\PagarMeServiceProvider::class,
],

'aliases' => [
    'PagarMe' => FlyingLuscas\PagarMeLaravel\PagarMeFacade::class,
],
```

#### Configurations

Publish the **config/pagarme.php** file and set [your keys from the Pagar.me API][link-pagarme-dash].

``` bash
$ php artisan vendor:publish --provider="FlyingLuscas\PagarMeLaravel\PagarMeServiceProvider"
```

#### Checkout Directive

Use the blade directive `@checkout` to easily set up the checkout form.

``` blade
<form action="/payment" method="post">
    @checkout([
        'button-text' => 'Pay',
        'amount' => '1000',
        'customer-data' => 'true',
        'payment-methods' => 'boleto,credit_card',
        'ui-color' => '#bababa',
        'postback-url' => 'requestb.in/1234',
        'create-token' => 'true',
        'interest-rate' => '12',
        'free-installments' => '3',
        'default-installment' => '5',
        'header-text' => 'Title',
    ])
</form>
```

More examples on how to use the checkout form please visit the [official documentation][link-pagarme-checkout-form].

#### Facade

You can easily interact with the SDK using the `PagarMeFacade` class, see an quick example.

``` php
PagarMe::transaction()
    ->boletoTransaction(
        1000,
        $customer,
        'http://requestb.in/pkt7pgpk',
        ['id_product' => 13933139]
    );
```

More examples on how to use the SDK please visit the official [documentation available here][link-pagarme-wiki].

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
[link-pagarme-checkout-form]: https://docs-beta.pagar.me/docs/inserindo-o-formulario
