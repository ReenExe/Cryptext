<?php

namespace ReenExe\Cryptext;

class CryptXor implements Cryptext
{
    private $mask;

    public function __construct($mask)
    {
        $this->mask = str_split($mask);
    }

    public function execute($source)
    {
        $len = strlen($source);
        $count = count($this->mask);

        $result = '';
        for ($i = 0; $i < $len; ++$i) {
            $result .= chr(
                ord($source[$i]) ^ ord($this->mask[$i % $count])
            );
        }
        return $result;
    }
}