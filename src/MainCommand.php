<?php

namespace ReenExe\Cryptext;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MainCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('cryptext:main')
            ->addOption('recovery')
            ->addOption(
                'path',
                'p',
                InputOption::VALUE_OPTIONAL
            );;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($path = $input->getOption('path')) {
            $this->path = $path;
        }

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
