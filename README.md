# ARK Laravel

<p align="center">
    <img src="https://github.com/faustbrian/ARK-Laravel/blob/master/banner.png" />
</p>

> An [ARK](https://github.com/ArkEcosystem/ark-node) bridge for Laravel.

[![StyleCI](https://styleci.io/repos/113013419/shield?branch=master)](https://styleci.io/repos/113013419)
[![Build Status](https://img.shields.io/travis/faustbrian/ARK-Laravel/master.svg?style=flat-square)](https://travis-ci.org/faustbrian/ARK-Laravel)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/faustbrian/ark-laravel.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/faustbrian/ARK-Laravel.svg?style=flat-square)](https://github.com/faustbrian/ARK-Laravel/releases)
[![License](https://img.shields.io/packagist/l/faustbrian/ARK-Laravel.svg?style=flat-square)](https://packagist.org/packages/faustbrian/ARK-Laravel)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require faustbrian/ark-laravel
```

## Configuration

ARK Laravel requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="BrianFaust\Lark\LarkServiceProvider"
```

This will create a `config/ark.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Lark Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### LarkManager

This is the class of most interest. It is bound to the ioc container as `lark` and can be accessed using the `Facades\Lark` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Lark\Lark`.

#### Facades\Lark

This facade will dynamically pass static method calls to the `lark` object in the ioc container which by default is the `LarkManager` class.

#### LarkServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use BrianFaust\Lark\Facades\Lark;

Lark::api('Account')->accounts();
// We're done here - how easy was that, it just works!
```

The Lark manager will behave like it is a `BrianFaust\Lark\Client`. If you want to call specific connections, you can do that with the connection method:

```php
use BrianFaust\Lark\Facades\Lark;

// Writing this…
Lark::connection('main')->api('Account')->accounts()->create($params);

// …is identical to writing this
Lark::api('Account')->accounts()->create($params);

// and is also identical to writing this.
Lark::connection()->api('Account')->accounts()->create($params);

// This is because the main connection is configured to be the default.
Lark::getDefaultConnection(); // This will return main.

// We can change the default connection.
Lark::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use BrianFaust\Lark\LarkManager;

class Foo
{
    protected $lark;

    public function __construct(LarkManager $lark)
    {
        $this->lark = $lark;
    }

    public function bar($params)
    {
        $this->lark->api('Account')->accounts();
    }
}

App::make('Foo')->bar($params);
```

## Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the Ark-PHP package](https://github.com/faustbrian/Ark-PHP).

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.me)
