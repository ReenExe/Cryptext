<?php

namespace ReenExe\Cryptext\Features\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;

class FileSystemContext extends DefaultContext
{

    /**
     * @Given /^I have file "([^"]*)" with:$/
     * @param string       $filename name of the file (relative path)
     * @param PyStringNode $content  PyString string instance
     */
    public function iHaveFileWith($filename, PyStringNode $content)
    {

    }
}
