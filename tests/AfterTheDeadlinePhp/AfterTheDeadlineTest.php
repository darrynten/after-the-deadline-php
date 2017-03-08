<?php

namespace DarrynTen\AfterTheDeadlinePhp\Tests\AfterTheDeadlinePhp;

use PHPUnit_Framework_TestCase;
use Mockery as m;
use ReflectionClass;

use DarrynTen\AfterTheDeadlinePhp\Config;
use DarrynTen\AfterTheDeadlinePhp\AfterTheDeadline;

class AfterTheDeadlineTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function getMockClient()
    {
        $config = [
            'key' => 'xxx',
        ];

        $config = new Config($config);

        $mock = m::mock(TranslateClient::class);

        $mock->shouldReceive('__construct')
          ->with($config)
          ->zeroOrMoreTimes()
          ->andReturn();

        $mock->shouldReceive('languages')
          ->zeroOrMoreTimes()
          ->andReturn(json_decode(file_get_contents(__DIR__ . '/mocks/languages_response.json')));

        $mock->shouldReceive('localizedLanguages')
          ->zeroOrMoreTimes()
          ->andReturn(json_decode(file_get_contents(__DIR__ . '/mocks/source_languages_for_en.json'), true));

        $mock->shouldReceive('localizedLanguages')
          ->zeroOrMoreTimes()
          ->andReturn(json_decode(file_get_contents(__DIR__ . '/mocks/source_languages_for_en.json'), true));

        return $mock;
    }

    public function testMissingKey()
    {
        $this->expectException(\Exception::class);

        $config = [];

        $instance = new AfterTheDeadline($config);
        $this->assertInstanceOf(AfterTheDeadline::class, $instance);
    }


    public function testConstruct()
    {
        $config = [
            'key' => 'xxx',
        ];

        $instance = new AfterTheDeadline($config);
        $this->assertInstanceOf(AfterTheDeadline::class, $instance);
    }

    public function testSet()
    {
        $config = [
            'key' => 'xxx',
        ];

        $instance = new AfterTheDeadline($config);

        $this->assertEquals('', $instance->config->text);
        $instance->setText('hello');
        $this->assertEquals('hello', $instance->config->text);

        $this->assertEquals(true, $instance->config->cache);
        $instance->setCache(false);
        $this->assertEquals(false, $instance->config->cache);
    }

    public function testCheckDocument()
    {
        $config = [
            'key' => 'xxx',
            'text' => 'xxx',
            'cache' => false,
        ];

        $instance = new AfterTheDeadline($config);

        $results = $instance->checkDocument();
    }

    public function testCheckGrammar()
    {
        $config = [
            'key' => 'xxx',
            'text' => 'xxx',
            'cache' => false,
        ];

        $instance = new AfterTheDeadline($config);

        $results = $instance->checkGrammar();
    }

    public function testStats()
    {
        $config = [
            'key' => 'xxx',
            'text' => 'xxx',
            'cache' => false,
        ];

        $instance = new AfterTheDeadline($config);

        $results = $instance->stats();
    }

    public function testGetInfo()
    {
        $config = [
            'key' => 'xxx',
            'text' => 'xxx',
            'cache' => false,
        ];

        $instance = new AfterTheDeadline($config);

        $results = $instance->getInfo('to be');
    }
}
