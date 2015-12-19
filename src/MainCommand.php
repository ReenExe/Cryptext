<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MainCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('cryptext:main')
            ->addOption('recovery')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getConfig();

        $crypt = new CryptXor($this->getRey());

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

}