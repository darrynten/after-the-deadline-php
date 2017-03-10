<?php

namespace DarrynTen\AfterTheDeadlinePhp\Tests\AfterTheDeadlinePhp;

use PHPUnit_Framework_TestCase;
// use Mockery as m;
// use ReflectionClass;
use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

use DarrynTen\AfterTheDeadlinePhp\Config;
use DarrynTen\AfterTheDeadlinePhp\AfterTheDeadline;

class AfterTheDeadlineTest extends PHPUnit_Framework_TestCase
{
    use HttpMockTrait;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8082', 'localhost');
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function getMockClient($config)
    {

        $instance = new AfterTheDeadline($config);
        $this->assertInstanceOf(AfterTheDeadline::class, $instance);

        $configObject = new Config($config);
        $configObject->url = 'http://localhost:8082';

        $instance->config = $configObject;

        return $instance;
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

        // $instance = $this->injectMock(new AfterTheDeadline($config));
        $instance = $this->getMockClient($config);

        $this->assertInstanceOf(AfterTheDeadline::class, $instance);
    }

    public function testSet()
    {
        $config = [
            'key' => 'xxx',
        ];

        $instance = $this->getMockClient($config);

        $this->assertEquals('', $instance->config->text);
        $instance->setText('hello');
        $this->assertEquals('hello', $instance->config->text);

        $this->assertEquals(true, $instance->config->cache);
        $instance->setCache(false);
        $this->assertEquals(false, $instance->config->cache);
    }

    public function testCheckDocument()
    {
        $this->http->mock
            ->when()
                ->methodIs('POST')
                ->pathIs('/checkDocument')
            ->then()
                ->body('')
            ->end();

        $this->http->setUp();

        $config = [
            'key' => 'unit-test',
            'text' => 'hello i want to use right grammar and speling but i sometimes mistype and enflish isnt my first langusge',
            'cache' => false,
        ];

        $instance = $this->getMockClient($config);

        $results = $instance->checkDocument();
    }

    public function testCheckGrammar()
    {
        $this->http->mock
            ->when()
                ->methodIs('POST')
                ->pathIs('/checkGrammar')
            ->then()
                ->body('')
            ->end();

        $this->http->setUp();

        $config = [
            'key' => time(),
            'text' => 'hello i want to use right grammar and speling but i sometimes mistype and enflish isnt my first langusge',
            'cache' => false,
        ];

        $instance = $this->getMockClient($config);

        $results = $instance->checkGrammar();
    }

    public function testStats()
    {
        $this->http->mock
            ->when()
                ->methodIs('POST')
                ->pathIs('/stats')
            ->then()
                ->body('')
            ->end();

        $this->http->setUp();

        $config = [
            'key' => time(),
            'text' => 'hello i want to use right grammar and speling but i sometimes mistype and enflish isnt my first langusge',
            'cache' => false,
        ];

        $instance = $this->getMockClient($config);

        $results = $instance->stats();
    }

    public function testGetInfo()
    {
        $this->http->mock
            ->when()
                ->methodIs('POST')
                ->pathIs('/getInfo')
            ->then()
                ->body('')
            ->end();

        $this->http->setUp();

        $config = [
            'key' => time(),
            'text' => 'hello i want to use right grammar and speling but i sometimes mistype and enflish isnt my first langusge',
            'cache' => false,
        ];

        $instance = $this->getMockClient($config);

        $results = $instance->getInfo('to be');
    }
}
