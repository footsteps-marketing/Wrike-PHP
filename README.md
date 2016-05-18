# PHP API Client Library for Wrike Project Management

This package provides easy access to the Wrike API in your PHP application.

This is a fork with changes and additions:

* More complete -- all API calls documented as of 2016-05-18 are present.
* Request parameters are set using an associative array, rather than function arguments.
    * This permits the wrapper to remain more stable as Wrike's API's parameters change with new API versions
* More modular code
* Docs inline (for phpdoc and IDE use)
* Token negotiation is now handled within the class.
* Mostly PSR-1 and PSR-2

## Installation

To install, use Composer:

```
composer require footsteps-marketing/wrike-php
```

## Usage

### Add your Wrike client app credentials

Wrike uses OAuth2 to authenticate and track API requests. So in order to use the API you will need to register an API client app first. You can do that [here](https://developers.wrike.com/getting-started/).

See the [example](example.php).

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Simon Hamp](https://github.com/simonhamp)
- [Aaron Hipple](https://github.com/aaronhipple)
- [All Contributors](https://github.com/isevltd/Wrike-PHP/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
