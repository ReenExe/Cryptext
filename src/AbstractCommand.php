<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Yaml\Parser;

abstract class AbstractCommand extends Command
{
    protected $path;

    public function __construct($path)
    {
        parent::__construct();
        $this->path = $path;
    }

    protected function getConfig()
    {
        $parser = new Parser();

        $sourceConfig = $parser->parse(file_get_contents(Config::FILE));

        return new Config($sourceConfig);
    }

    protected function getFileFullName($name)
    {
        return $this->path . DIRECTORY_SEPARATOR . $name;
    }
}