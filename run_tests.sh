#!/bin/bash
phpunit
vendor/bin/behat -s command
vendor/bin/codecept run