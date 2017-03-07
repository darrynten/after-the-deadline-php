<?php
/**
 * AfterTheDeadline Validation
 *
 * @category Validation
 * @package  AfterTheDeadlinePhp
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/after-the-deadline-php/LICENSE>
 * @link     https://github.com/darrynten/after-the-deadline-php
 */

namespace DarrynTen\AfterTheDeadlinePhp;

class Validation
{
    /**
     * The valid text types
     *
     * @var array $validTypes
     */
    private static $validTypes = [
        'text',
        'html',
    ];

    /**
     * Check if a type is valid
     *
     * @param string $type The type to check
     *
     * @return boolean
     */
    public static function isValidFormat(string $type)
    {
        if (!in_array($type, self::$validTypes)) {
            throw new \Exception('Invalid format. Only `text` and `html` are valid choices.');
        }
    }
}
