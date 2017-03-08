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
        $this->request = new RequestHandler();
    }

    /**
     * @return array
     */
    public function checkDocument()
    {
        $cacheKey = '_atd_check_document_' . md5($this->config->text);

        if (!$this->config->cache || !$result = unserialize($this->cache->get($cacheKey))) {
            $result = $this->request->request($this->config, 'checkDocument');
            $this->cache->put($cacheKey, serialize($result), 9999999);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function checkGrammar()
    {
        $cacheKey = '_atd_check_grammar_' . md5($this->config->text);

        if (!$this->config->cache || !$result = unserialize($this->cache->get($cacheKey))) {
            $result = $this->request->request($this->config, 'checkGrammar');
            $this->cache->put($cacheKey, serialize($result), 9999999);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function stats()
    {
        $cacheKey = '_atd_stats_' . md5($this->config->text);

        if (!$this->config->cache || !$result = unserialize($this->cache->get($cacheKey))) {
            // TODO tags
            $result = $this->request->request($this->config, 'stats');
            $this->cache->put($cacheKey, serialize($result), 9999999);
        }

        return $result;
    }

    /**
     * @param string
     * @return boolean
     */
    public function getInfo(string $term)
    {
        // TODO
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
