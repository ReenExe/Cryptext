<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

class MainCommand extends Command
{
    private $path;

    public function __construct($path)
    {
        parent::__construct();
        $this->path = $path;
    }

    protected function configure()
    {
        $this->setName('cryptext:main');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parser = new Parser();

        $sourceConfig = $parser->parse(file_get_contents(Config::FILE));

        $config = new Config($sourceConfig);

        $crypt = new CryptXor(file_get_contents($this->getFileFullName($config->get('key'))));

        file_put_contents(
            $this->getFileFullName($config->get('result')),
            $crypt->execute(
                file_get_contents($this->getFileFullName($config->get('src')))
            )
        );

        $output->writeln('<info>Begin</info>');
    }
    private function getFileFullName($name)
    {
        return $this->path . DIRECTORY_SEPARATOR . $name;
    }
}