<?php

namespace ReenExe\Cryptext;

class Shuffle implements Cryptext
{
    private $interval;

    public function __construct($mask)
    {
        $this->interval = array_filter(str_split($mask), 'is_numeric');
    }

    public function execute($source)
    {

    }
}
