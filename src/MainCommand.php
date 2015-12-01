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
        $this
            ->setName('cryptext:main')
            ->addOption('recovery')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parser = new Parser();

        $sourceConfig = $parser->parse(file_get_contents(Config::FILE));

        $config = new Config($sourceConfig);

        $crypt = new CryptXor(file_get_contents($this->getFileFullName($config->get('key'))));

        list($from, $to) = $input->getOption('recovery')
            ? [$config->get('result'), $config->get('recovery')]
            : [$config->get('src'), $config->get('result')];

        $this->convert($crypt, $from, $to);

        $output->writeln('<info>Success</info>');
    }

    private function convert(Cryptext $crypt, $from, $to)
    {
        $dirFrom = $this->getFileFullName($from);
        $dirTo = $this->getFileFullName($to);
        $handle = opendir($dirFrom);
        while ($entry = readdir($handle)) {
            if (is_file($file = $dirFrom . '/' . $entry)) {
                file_put_contents(
                    $dirTo . '/' . $entry,
                    $crypt->execute(file_get_contents($file) )
                );
            }
        }
    }

    private function getFileFullName($name)
    {
        return $this->path . DIRECTORY_SEPARATOR . $name;
    }
}