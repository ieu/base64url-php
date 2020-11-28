<?php


use Ieu\Base64Url\Base64Url;
use PHPUnit\Framework\TestCase;

class SimpleEncodingTest extends TestCase
{
    public function testEncode()
    {
        for($i = 0; $i <= 1000; ++$i) {
            $input = random_bytes(mt_rand(1, 1024));
            $output = Base64Url::encode($input);
            $expectedOutput = base64url_encode($input);
            $this->assertEquals($expectedOutput, $output);
        }
    }
}