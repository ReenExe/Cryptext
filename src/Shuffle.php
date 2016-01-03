<?php

namespace ReenExe\Cryptext;

class Shuffle implements Cryptext
{
    private $intervals;

    public function __construct($mask)
    {
        $this->intervals = array_filter(str_split($mask), 'is_numeric');
    }

    public function execute($source)
    {
        if (empty($this->intervals) || empty($source)) {
            return $source;
        }

        $length = strlen($source);
        $index = 0;
        $result = '';

        foreach ($this->intervals as $interval) {
            $shift = $interval * 2;
            $rest = $length - $index;
            if ($shift <= $rest) {
                $result .= substr($source, $index + $interval, $interval) . substr($source, $index, $interval);
            } else {
                $result .= substr($source, $index, $interval);
            }
            $index += $shift;
        }

        return $result;
    }
}
