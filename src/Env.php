<?php
/**
 * Genial Framework (https://genial.tech/php/genial-framework/).
 *
 * @link      https://github.com/Genial-Framework/Genial-Framework for the canonical source repository
 *
 * @copyright Copyright (c) 2017-2017 Genial Technologies USA Inc. (https://genial.tech/)
 * @license   https://genial.tech/license/new-bsd New BSD License
 */

namespace Genial\Env;

use Genial\Env\Exception\BadMethodCallException;
use Genial\Env\Exception\UnexpectedValueException;

/**
 * Env.
 */
class Env
{
    private static $config = null;

    /**
     * getConfig().
     *
     * Get the current configuration
     *
     * @param string|null $section  The configuration section to access
     * @param string|null $variable The configuration variable name to access
     *
     * @throws BadMethodCallException   If the $section argument is missing
     * @throws UnexpectedValueException If the $section argument is empty
     *
     * @return array Return the configuration array based on section
     */
    public static function getConfig(string $section = null, string $variable = null)
    {
        if (!$section) {
            throw new BadMethodCallException(sprintf(
                '"%s" expects the "$section" argument.',
                __METHOD__
            ));
        }
        $section = trim($section);
        if (empty($section) || $section == '') {
            throw new UnexpectedValueException(sprintf(
                '"%s" expects "$section" to not be empty.',
                __METHOD__
            ));
        }
        if (!self::$config) {
            $env = parse_ini_file(GENIAL_ROOT.'/.env.ini', true, INI_SCANNER_RAW);
        } else {
            $env = self::$config;
        }
        if (isset($env[$section])) {
            foreach ($env[$section] as $nVariable => $value) {
                if (!is_null($variable) && $nVariable == strtoupper($variable)) {
                    return $value;
                }
                if (!$variable) {
                    goto doReturn;
                }
            }
        }
        doReturn:
        return $env[$section];
    }

    /**
     * setConfig().
     *
     * Set the current configuration
     *
     * @param array|array() $config The configuration array to use
     *
     * @throws InvalidArgumentException If $config is not an array
     *
     * @return bool|true if configuration array was set
     */
    public static function setConfig($config = [])
    {
        if (!is_array($config)) {
            throw new InvalidArgumentException(sprintf(
                '"%s" expects the "$config" to be an array.',
                __METHOD__
            ));
        }
        self::$config = $config;

        return true;
    }
}
