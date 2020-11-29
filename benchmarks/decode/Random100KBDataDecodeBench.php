<?php


use function Ieu\Base64Url\base64url_decode as my_base64url_decode;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class Random100KBDataDecodeBench
{
    private $data;

    public function init()
    {
        $this->data = base64url_encode(random_bytes(0x19000));
    }

    /**
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        my_base64url_decode($this->data);
    }

    /**
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchBase64UrlStrtr()
    {
        base64url_decode($this->data);
    }

    /**
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchBase64()
    {
        base64_decode($this->data);
    }
}