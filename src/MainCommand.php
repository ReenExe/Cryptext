<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class MainCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('cryptext:main')
            ->addOption('recovery');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setProcessPath($input);

        $startTime = microtime(true);
        $config = $this->getConfig();
        $key = $this->getRey();
        $crypt = new CryptXor($key);

        list($from, $to) = $input->getOption('recovery')
            ? [$config->get('result'), $config->get('recovery')]
            : [$config->get('src'), $config->get('result')];

        $this->convert($crypt, $from, $to);

        $output->writeln('<info>Success</info>');
        $keyLength = strlen($key);
        $output->writeln("<info>Key length: $keyLength</info>");
        $time = microtime(true) - $startTime;
        $output->writeln("<info>Time: $time</info>");
    }

    private function convert(Cryptext $crypt, $from, $to)
    {
        $dirFrom = $this->getFileFullName($from);
        $dirTo = $this->getFileFullName($to);
        $fs = new Filesystem();
        $handle = opendir($dirFrom);
        while ($entry = readdir($handle)) {
            if (is_file($file = $dirFrom . '/' . $entry)) {
                $fs->dumpFile($dirTo . '/' . $entry, $crypt->execute(file_get_contents($file)));
            }
        }
    }
}
