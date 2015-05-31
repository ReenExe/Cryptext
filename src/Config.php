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
        $resolver->setRequired(['src', 'result', 'key']);

        $resolver->setAllowedTypes('src', 'string');
        $resolver->setAllowedTypes('result', 'string');
        $resolver->setAllowedTypes('key', 'string');

        $this->data = $resolver->resolve($options);
    }

    public function get($name)
    {
        return $this->data[$name];
    }
}