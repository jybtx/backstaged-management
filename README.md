<h1> backstaged-management </h1>
這是一個後臺管理系統的基礎框架，可在此基礎上進行二次開發，後臺的權限部分已經完成了。如需要其他的部分，請自行擴展

## Installing

### Composer
Execute the following command to get the latest version of the package:

```shell
$ composer require jybtx/backstaged-management
```
### Laravel

- PHP >= 7.2.*
 - Laravel >= 6.0
 - Fileinfo PHP Extension

ServiceProvider will be attached automatically

Run the following command to publish assets and configure:
```php
php artisan jybtx:install
```
Open http://localhost/admin/login in browser,use username admin and password 123456 to login.

## Configurations
The file config/backstaged.php contains an array of configurations, you can find the default configurations in there.

## Usage

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/jybtx/backstaged-management/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/jybtx/backstaged-management/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT