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

```php
require __DIR__ . '/vendor/autoload.php';

use Ieu\Base64Url\Base64Url;

// Encoding
Base64Url::encode("Hello, world!");

// Encoding without padding
Base64Url::encode("Hello, world!", false);

// Decode
Base64Url::decode("SGVsbG8sIHdvcmxkIQ==");
```

## Tests

```shell script
./vendor/bin/phpunit
```

## Benchmarks

Encoding benchmarks:
```shell script
./vendor/bin/phpbench run benchmarks/SimpleEncodingBench.php --report=aggregate
```

Decoding benchmarks:
```shell script
./vendor/bin/phpbench run benchmarks/SimpleDecodingBench.php --report=aggregate
```
