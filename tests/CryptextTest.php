<?php

use ReenExe\Cryptext\CryptXor;

class CryptextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testCreate($key, $string)
    {
        $coder = new CryptXor($key);

        $this->assertSame($string, $coder->execute($coder->execute($string)));
    }

    public function provider()
    {
        return [
            [$this->generateKey(), 'text']
        ];
    }

    private function generateKey()
    {
        return str_split(md5(time()));
    }
}