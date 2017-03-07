<?php

namespace DarrynTen\AfterTheDeadlinePhp;

use Psr\Cache\CacheItemPoolInterface;

/**
 * AfterTheDeadline Config
 *
 * @category Configuration
 * @package  AfterTheDeadlinePhp
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/after-the-deadline-php/LICENSE>
 * @link     https://github.com/darrynten/after-the-deadline-php
 */
class Config
{
    /**
     * The api key
     *
     * @var string $key
     */
    private $key = null;

    public $text;

    /**
     * The format of text.
     *
     * Options are `text` and `html`
     *
     * @var string $format
     */
    public $format = 'text';

    /**
     * Whether or not to use caching.
     *
     * The default is true as this is a good idea.
     *
     * @var boolean $cache
     */
    public $cache = true;

    /**
     * Construct the config object
     *
     * @param array $config An array of configuration options
     */
    public function __construct($config)
    {
        // Throw exceptions on essentials
        if (!isset($config['key']) || empty($config['key'])) {
            throw new \Exception('Missing After The Deadline API Key');
        } else {
            $this->key = (string)$config['key'];
        }

        // optionals
        if (isset($config['text'])) {
            $this->text = $config['text'];
        }

        if (isset($config['format'])) {
            Validation::isValidFormat($config['format']);
            $this->format = $config['format'];
        } else {
            $this->format = 'text';
        }

        if (isset($config['cache'])) {
            $this->cache = (bool)$config['cache'];
        }
    }
}
