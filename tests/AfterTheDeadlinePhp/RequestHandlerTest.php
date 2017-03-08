<?php

namespace DarrynTen\AfterTheDeadlinePhp\Tests\AfterTheDeadlinePhp;

use DarrynTen\AfterTheDeadlinePhp\AfterTheDeadline;
use DarrynTen\AfterTheDeadlinePhp\ContentItem;
use DarrynTen\AfterTheDeadlinePhp\Config;
use DarrynTen\AfterTheDeadlinePhp\RequestHandler;
use DarrynTen\AfterTheDeadlinePhp\CustomException;
use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use ReflectionClass;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class RequestHandlerTest extends \PHPUnit_Framework_TestCase
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

    public function testInstanceOf()
    {
        $request = new RequestHandler([]);
        $this->assertInstanceOf(RequestHandler::class, $request);
    }

    public function testRequest()
    {
        $data = '{\'key\':\'data\'}';

        $this->http->mock
            ->when()
                ->methodIs('POST')
                ->pathIs('/foo')
            ->then()
                ->body($data)
            ->end();
        $this->http->setUp();

        $config = [
            'key' => 'xx',
            'text' => 'xx',
            'cache' => true,
        ];

        $instance = new AfterTheDeadline($config);
        $this->assertInstanceOf(AfterTheDeadline::class, $instance);

        $configObject = new Config($config);

        $request = new RequestHandler($configObject);

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'key' => $configObject->key,
                'data' => $configObject->text,
            ]
        ];

        $mockClient = \Mockery::mock(
            'Client'
        );

        $localClient = new Client();

        $localResult = $localClient->request(
            'POST',
            'http://localhost:8082/foo',
            []
        );

        $mockClient->shouldReceive('request')
            ->once()
            ->andReturn($localResult);

        // Need to inject mock to a private property
        $reflection = new ReflectionClass($request);
        $reflectedClient = $reflection->getProperty('client');
        $reflectedClient->setAccessible(true);
        $reflectedClient->setValue($request, $mockClient);

        $request->request($configObject, 'stats');
    }
}
