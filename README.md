## after-the-deadline-php

![Travis Build Status](https://travis-ci.org/darrynten/after-the-deadline-php.svg?branch=master)
![StyleCI Status](https://styleci.io/repos/81687310/shield?branch=master)
[![codecov](https://codecov.io/gh/darrynten/after-the-deadline-php/branch/master/graph/badge.svg)](https://codecov.io/gh/darrynten/after-the-deadline-php)
![Packagist Version](https://img.shields.io/packagist/v/darrynten/after-the-deadline-php.svg)
![MIT License](https://img.shields.io/github/license/darrynten/after-the-deadline-php.svg)

An unofficial, fully unit tested After The Deadline PHP client.

PHP 7.0+

## Usage

### Keys

From http://www.afterthedeadline.com/api.slp

> We used to require users to register for an API key. We no longer do this but
applications are still required to submit an API key. The API key is used as
both a synchronous locking point (e.g., only one request/key is processed at a
time) and to enable server-side caching of results and session information.
This makes subsequent requests for the same key much faster.

To generate an API key, consider using a short string to identify your
application followed by a hash of something unique to the user or installation
of AtD, like the site URL.

## Examples

Include

```
composer require darrynten/after-the-deadline-php
```

Use

```php
use DarrynTen\AfterTheDeadlinePhp\AfterTheDeadline;

// Config options
$config = [
  'key' => 'my-generated-key',  // At the very least
  'text' => $text,              // You can pass text in
  'format' => 'html'            // You can also specify (plain is default)
];

// Make a translator
$checker = new AfterTheDeadline($config);

// Set text and type (html or plain)
$checker->setText($text);
$language->setFormat('plain');

// Enable / disable caching
$language->setCache(false);

// Get suggestions
$checker->checkDocument(); // does both spelling and grammar
$checker->checkGrammar();  // only does grammar

// Get stats on the text
$checker->stats();

// Get an explanation on the grammar of an incorrect type
$checker->getInfo($term);  // e.g. 'to be' should be re-written in active
```

See [The AtD API Docs](http://www.afterthedeadline.com/api.slp)
for more on these options and their usage.

## Acknowledgements

* Open a PR and put yourself here :)
