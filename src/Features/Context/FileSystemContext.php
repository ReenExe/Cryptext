<?php

namespace ReenExe\Cryptext\Features\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\Filesystem\Filesystem;

class FileSystemContext extends DefaultContext
{
    private $fs;

    public function __construct()
    {
        $this->fs = new Filesystem();
    }

    /**
     * @Given /^I make file "([^"]*)" with:$/
     * @param string       $filename name of the file (relative path)
     * @param PyStringNode $content  PyString string instance
     */
    public function iMakeFileWith($filename, PyStringNode $content)
    {
        $this->fs->dumpFile($filename, $content);
    }

    /**
     * @Given /^I have file "([^"]*)" with:$/
     * @param string       $filename name of the file (relative path)
     * @param PyStringNode $content  PyString string instance
     */
    public function iHaveFileWith($filename, PyStringNode $content)
    {

    }
}
