<?php


use Ieu\Base64Url\Base64Url;
use PHPUnit\Framework\TestCase;

class SimpleDecodingTest extends TestCase
{
    public function testEncode()
    {
        for($i = 0; $i <= 1000; ++$i) {
            $expectedOutput = random_bytes(mt_rand(1, 1024));
            $input = base64url_encode($expectedOutput);
            $output = Base64Url::decode($input);
            $this->assertEquals($expectedOutput, $output);
        }
    }
}