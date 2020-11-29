<?php


use Ieu\Base64Url\Base64Url;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class Random1KBDataDecodeBench
{
    private $data;

    public function init()
    {
        $this->data = base64url_encode(random_bytes(0x400));
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        Base64Url::decode($this->data);
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchBase64UrlStrtr()
    {
        base64url_decode($this->data);
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchBase64()
    {
        base64_decode($this->data);
    }
}