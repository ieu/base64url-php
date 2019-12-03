<?php


use Ieu\Base64Url\Base64Url;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class SimpleDecodingBench
{
    private $encodedString;

    public function init()
    {
        $this->encodedString = strtr(base64_encode(openssl_random_pseudo_bytes(mt_rand(0x10, 0x400))), '+/', '-_');
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        Base64Url::decode($this->encodedString);
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchSimpleWrapper()
    {
        // https://github.com/firebase/php-jwt/blob/master/src/JWT.php
        base64_decode(strtr($this->encodedString, '-_', '+/'));
    }
}