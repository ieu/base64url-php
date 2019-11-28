<?php


use Ieu\Base64Url\Base64Url;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

class SimpleEncodingBench
{
    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        Base64Url::encode("Hello, world!");
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchSimpleWrapper()
    {
        // https://github.com/firebase/php-jwt/blob/master/src/JWT.php
        strtr(base64_encode("Hello, world!"), '+/', '-_');
    }
}