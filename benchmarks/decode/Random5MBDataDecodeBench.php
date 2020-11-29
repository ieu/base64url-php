<?php


use function Ieu\Base64Url\base64url_decode as my_base64url_decode;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class Random5MBDataDecodeBench
{
    private $data;

    public function init()
    {
        $this->data = base64url_encode(random_bytes(0x500000));
    }

    /**
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchBase64Url()
    {
        my_base64url_decode($this->data);
    }

    /**
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchBase64UrlStrtr()
    {
        base64url_decode($this->data);
    }

    /**
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchBase64()
    {
        base64_decode($this->data);
    }
}