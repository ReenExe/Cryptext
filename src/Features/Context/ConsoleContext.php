<?php

namespace ReenExe\Cryptext\Features\Context;

use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\Process\Process;

class ConsoleContext extends DefaultContext
{
    /**
     * @var Process
     */
    private $process;

    /**
     * @When /^I run command "([^"]*)"$/
     * @param string $command
     */
    public function iRunCommand($command)
    {
        $this->process = new Process($command);

        $this->process->run();
    }

    /**
     * @Then /^Command response is:$/
     * @param PyStringNode $expect
     */
    public function commandResponseIs(PyStringNode $expect)
    {
        $expect = str_replace(PHP_EOL, '', $expect);
        $actual = str_replace(PHP_EOL, '', $this->process->getOutput());
        \PHPUnit_Framework_Assert::assertSame($expect, $actual);
    }

    /**
     * @Then /^Print command response$/
     */
    public function printCommandResponse()
    {
        if ($this->process->getOutput()) {
            echo $this->process->getOutput();
        }

        if ($this->process->getErrorOutput()) {
            echo $this->process->getErrorOutput();
        }
    }
}
