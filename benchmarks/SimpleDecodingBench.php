<?php


use Ieu\Base64Url\Base64Url;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

class SimpleDecodingBench
{
    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        Base64Url::decode("SGVsbG8sIHdvcmxkIQ==");
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchSimpleWrapper()
    {
        // https://github.com/firebase/php-jwt/blob/master/src/JWT.php
        base64_decode(strtr("SGVsbG8sIHdvcmxkIQ==", '-_', '+/'));
    }
}