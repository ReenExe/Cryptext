<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Yaml\Parser;

abstract class AbstractCommand extends Command
{
    protected $path;

    protected $config;

    public function __construct($path)
    {
        parent::__construct();
        $this->config = $this->createConfig();
        $this->path = $path;
    }

    /**
     * @return Config
     */
    protected function getConfig()
    {
        return $this->config;
    }

    protected function getFileFullName($name)
    {
        return $this->path . DIRECTORY_SEPARATOR . $name;
    }

    protected function getRey()
    {
        $key = $this->getConfigStringKey();

        return strpos($key, '//') === false ? $key : eval($key);
    }

    protected function getConfigStringKey()
    {
        return file_get_contents($this->getFileFullName($this->getConfig()->get('key')));
    }

    /**
     * @return Config
     */
    private function createConfig()
    {
        $parser = new Parser();

        $sourceConfig = $parser->parse(file_get_contents(Config::FILE));

        return new Config($sourceConfig);
    }
}