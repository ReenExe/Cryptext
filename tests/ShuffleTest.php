<?php

use ReenExe\Cryptext\Shuffle;

class ShuffleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     * @param $mask
     * @param $source
     * @param $expected
     */
    public function test($mask, $source, $expected)
    {
        $shuffle = new Shuffle($mask);

        $this->assertSame($shuffle->execute($source), $expected);
        $this->assertSame($shuffle->execute($expected), $source);
    }

    public function dataProvider()
    {
       return [
           [
               12, 'text', 'etxt'
           ],

           [
               12, 'abcdef', 'baefcd'
           ],
       ];
    }
}
