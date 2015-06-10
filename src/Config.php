<?php

namespace ReenExe\Cryptext;

use Symfony\Component\OptionsResolver\OptionsResolver;

class Config
{
    CONST FILE = 'cryptext.yml';
    /**
     * @var array
     */
    private $data;

    public function __construct(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setRequired(['src', 'result', 'key'])
            ->setDefined('recovery')
            ->setAllowedTypes('src', 'string')
            ->setAllowedTypes('result', 'string')
            ->setAllowedTypes('key', 'string')
            ->setAllowedTypes('recovery', 'string');

        $this->data = $resolver->resolve($options);
    }

    public function get($name)
    {
        return $this->data[$name];
    }
}