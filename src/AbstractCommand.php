<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Parser;

abstract class AbstractCommand extends Command
{
    protected $defaultPath;

    protected $path;

    protected $config;

    public function __construct($defaultPath)
    {
        parent::__construct();
        $this->configurePathOption($defaultPath);

    }

    protected function configurePathOption($defaultPath)
    {
        $this->addOption(
            'path',
            'p',
            InputOption::VALUE_OPTIONAL,
            'relative path',
            $defaultPath
        );
    }

    /**
     * @return Config
     */
    protected function getConfig()
    {
        return $this->config ?: $this->config = $this->createConfig();
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

        $sourceConfig = $parser->parse(file_get_contents($this->getFileFullName(Config::FILE)));

        return new Config($sourceConfig);
    }
}