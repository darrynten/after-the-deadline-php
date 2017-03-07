<?php

namespace DarrynTen\AfterTheDeadlinePhp\Tests;

use PHPUnit_Framework_TestCase;
use DarrynTen\AfterTheDeadlinePhp\Validation;

class ValidationTest extends PHPUnit_Framework_TestCase
{
    public function testValidType()
    {
        Validation::isValidFormat('html');
    }

    public function testInvalidType()
    {
        $this->expectException(\Exception::class);
        Validation::isValidFormat('xxx');
    }
}
