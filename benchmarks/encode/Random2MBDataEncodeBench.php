<?php


use function Ieu\Base64Url\base64url_encode as my_base64url_encode;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class Random2MBDataEncodeBench
{
    private $data;

    public function init()
    {
        $this->data = random_bytes(0x200000);
    }

    /**
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchBase64Url()
    {
        my_base64url_encode($this->data);
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