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
            $expectedOutput = strtr(base64_encode($input), '+/', '-_'); // https://github.com/firebase/php-jwt/blob/master/src/JWT.php
            $this->assertEquals($expectedOutput, $output);
        }
    }
}