<?php


use Ieu\Base64Url\Base64Url;
use PHPUnit\Framework\TestCase;

class SimpleDecodingTest extends TestCase
{
    public function testEncode()
    {
        for($i = 0; $i <= 1000; ++$i) {
            $expectedOutput = random_bytes(mt_rand(1, 1024));
            $input = strtr(base64_encode($expectedOutput), '+/', '-_'); // https://github.com/firebase/php-jwt/blob/master/src/JWT.php
            $output = Base64Url::decode($input);
            $this->assertEquals($expectedOutput, $output);
        }
    }
}