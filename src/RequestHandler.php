<?php
/**
 * After The Deadline Library
 *
 * @category Library
 * @package  AfterTheDeadlinePhp
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/after-the-deadline-php/LICENSE>
 * @link     https://github.com/darrynten/after-the-deadline-php
 */

namespace DarrynTen\AfterTheDeadlinePhp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

/**
 * Request Handler Class
 *
 * @category Library
 * @package  AfterTheDeadline
 * @author   Darryn Ten <darrynten@github.com>
 */
class RequestHandler
{
    /**
     * GuzzleHttp Client
     *
     * @var Client $client
     */
    private $client;

    /**
     * Request Handler constructor
     *
     * @param string $username The username
     * @param string $password The password
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Makes a request to AtD
     *
     * @param \Config $config The client config
     * @param string $method The method to call
     *
     * @return object
     *
     * @throws AfterTheDeadlineApiException
     */
    public function request(Config $config, string $method)
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'key' => $config->key,
                'data' => $config->text,
            ]
        ];

        $response = $this->client->request(
            'POST',
            sprintf('%s/%s', $config->url, $method),
            $options
        );

        return json_decode($response->getBody());
    }
}
