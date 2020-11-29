<?php


use Ieu\Base64Url\Base64Url;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class Random100KBDataEncodeBench
{
    private $data;

    public function init()
    {
        $this->data = random_bytes(0x19000);
    }

    /**
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        Base64Url::encode($this->data);
    }

    /**
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchBase64UrlStrtr()
    {
        base64url_encode($this->data);
    }

    /**
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchBase64()
    {
        base64_encode($this->data);
    }
}