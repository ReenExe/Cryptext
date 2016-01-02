<?php

namespace ReenExe\Cryptext\Features\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\Process\Process;

class ConsoleContext extends DefaultContext
{

    /**
     * @When /^I run command "([^"]*)"$/
     * @param string $command
     */
    public function iRunCommand($command)
    {
        $process = new Process($command);

        $process->run();
    }

    /**
     * @Then /^Command response is:$/
     * @param PyStringNode $string
     */
    public function commandResponseIs(PyStringNode $string)
    {

    }
}
