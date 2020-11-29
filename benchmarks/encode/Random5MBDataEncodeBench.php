<?php


use Ieu\Base64Url\Base64Url;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class Random5MBDataEncodeBench
{
    private $data;

    public function init()
    {
        $this->data = random_bytes(0x500000);
    }

    /**
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchBase64Url()
    {
        Base64Url::encode($this->data);
    }

    /**
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchBase64UrlStrtr()
    {
        base64url_encode($this->data);
    }

    /**
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchBase64()
    {
        base64_encode($this->data);
    }
}