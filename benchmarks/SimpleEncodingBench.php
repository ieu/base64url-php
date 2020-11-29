<?php


use Ieu\Base64Url\Base64Url;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class SimpleEncodingBench
{
    private $rawString;

    public function init()
    {
        $this->rawString = openssl_random_pseudo_bytes(mt_rand(0x0, 0x400));
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        Base64Url::encode($this->rawString);
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchSimpleWrapper()
    {
        base64url_encode($this->rawString);
    }
}