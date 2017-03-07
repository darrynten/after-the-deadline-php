<?php

namespace DarrynTen\AfterTheDeadlinePhp;

use DarrynTen\AnyCache\AnyCache;

/**
 * After The Deadline Client
 *
 * @category Library
 * @package  AfterTheDeadlinePhp
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/after-the-deadline-php/LICENSE>
 * @link     https://github.com/darrynten/after-the-deadline-php
 */
class AfterTheDeadline
{
    /**
     * Hold the config option
     *
     * @var Config $config
     */
    public $config;

    /**
     * Keeps a copy of the translation client
     *
     * @var object $apiClient
     */
    private $apiClient;

    /**
     * The local cache
     *
     * @var AnyCache $cache
     */
    private $cache;

    /**
     * Construct
     *
     * Bootstraps the config and the cache, then loads the client
     *
     * @param array $config Configuration options
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
        $this->cache = new AnyCache();
    }

    /**
     * @return array
     */
    public function checkDocument()
    {
    }

    /**
     * @return array
     */
    public function checkGrammar()
    {
    }

    /**
     * @return array
     */
    public function stats()
    {
    }

    /**
     * @param string
     * @return boolean
     */
    public function getInfo(string $term)
    {
        $cacheKey = '_atd_get_info_' . md5($term);

        if (!$this->config->cache || !$result = unserialize($this->cache->get($cacheKey))) {
            // TODO
            $result = '';
            $this->cache->put($cacheKey, serialize($result), 9999999);
        }

        return $result;
    }

    /**
     * Sets the document format
     *
     * @param string $format Either `html` or `text`
     *
     * @return void
     */
    public function setFormat(string $format)
    {
        Validation::isValidFormat($format);

        $this->config->format = $format;
    }

    /**
     * Sets the text
     *
     * @param string $text
     *
     * @return void
     */
    public function setText(string $text)
    {
        $this->config->text = $text;
    }

    /**
     * Enable and disable internal cache
     *
     * @param boolean $value The state
     *
     * @return void
     */
    public function setCache($value)
    {
        $this->config->cache = (bool)$value;
    }
}
