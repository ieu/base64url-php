<?php


use function Ieu\Base64Url\base64url_encode as my_base64url_encode;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods("init")
 */
class Random512KBDataEncodeBench
{
    private $data;

    public function init()
    {
        $this->data = random_bytes(0x80000);
    }

    /**
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchBase64Url()
    {
        my_base64url_encode($this->data);
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