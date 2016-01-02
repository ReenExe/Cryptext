<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateKeyCommand extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('generate:key');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->path = $input->getOption('path');

        $key = $this->getRey();
        $length = strlen($key);
        $output->writeln("<info>Key: $key</info>");
        $output->writeln("<info>Length: $length</info>");
    }
}
