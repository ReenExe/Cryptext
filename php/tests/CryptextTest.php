<?php

class CryptextTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf('\ReenExe\Cryptext\Cryptext', new ReenExe\Cryptext\Cryptext());
    }
}