# Base64Url

This is [Base64Url](https://tools.ietf.org/html/rfc4648#section-5) encoder and decoder written in pure PHP.

## Installation
First add this repo to `composer.json`:
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ieu/base64url-php"
        }
    ]
}
```
Then install it through [composer](https://getcomposer.org/download/):
```shell
composer require ieu/base64url:dev-master
```

## Usage


### `base64url_encode`

```php
use function Ieu\Base64Url\base64url_encode;

// Encoding
base64url_encode("Hello, world!");

// Encoding without padding
base64url_encode("Hello, world!", false);
```

### `base64url_decode`

```php
use function Ieu\Base64Url\base64url_decode;

// Decode
base64url_decode("SGVsbG8sIHdvcmxkIQ==");

// Decode in strict mode
// Invalid char would cause decoding failure
base64url_decode("SGVsbG8sIHdvcmxkIQ==", true);
```

## Tests

```shell script
./vendor/bin/phpunit
```

## Benchmarks

Encoding benchmarks:
```shell script
./vendor/bin/phpbench run benchmarks/encode --report=my_report
```

Decoding benchmarks:
```shell script
./vendor/bin/phpbench run benchmarks/decode --report=my_report
```
