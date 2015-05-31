<?php

namespace ReenExe\Cryptext;

class CryptXor implements Cryptext
{
    private $mask;

    public function __construct(array $mask)
    {
        $this->mask = $mask;
    }

    public function execute($source)
    {
        return $source;
    }
}