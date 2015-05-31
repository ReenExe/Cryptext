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
        $len = strlen($source);
        $count = count($this->mask);

        $result = '';
        for ($i = 0; $i < $len; ++$i) {
            $result .= $source[$i] xor $this->mask[$i % $count];
        }
        return $result;
    }
}