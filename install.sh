#!/usr/bin/env bash
sudo apt-get install phpunit
wget -O php/composer.phar https://getcomposer.org/download/1.0.0-alpha10/composer.phar
php composer.phar install