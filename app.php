<?php

require_once 'vendor/autoload.php';
use ReenExe\Cryptext\MainCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new MainCommand(__DIR__));
$application->run();