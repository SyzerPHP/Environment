<?php
/**
 * Genial Framework.
 *
 * @author    Nicholas English <https://github.com/Nenglish7>
 * @author    Genial Contributors <https://github.com/orgs/Genial-Framework/people>
 *
 * @link      <https://github.com/Genial-Framework/Env> for the canonical source repository.
 *
 * @copyright Copyright (c) 2017-2018 Genial Framework. <https://github.com/Genial-Framework>
 * @license   <https://github.com/Genial-Framework/Env/blob/master/LICENSE> New BSD License.
 */
use Genial\Env\Env;

define('ENV_ADAPTER_ACTIVE', true);

/**
 * Default configuration.
 */
$defaultConfig = [
    'application' => [
        'APP_SECRET_KEY' => null,
        'APP_NAME'       => 'Genial',
        'DEBUG'          => false,
        'LOG'            => true,
    ],
    'server' => [
        'FORCE_HTTPS' => false,
    ],
    'session' => [
        'SESSION_NAME'    => 'Genial',
        'SESSION_ENCRYPT' => true,
        'SESSION_ENCODE'  => true,
    ],
    'cookie' => [
        'COOKIE_LIFETIME'  => 0,
        'COOKIE_PATH'      => '/',
        'COOKIE_DOMAIN'    => ini_get('session.cookie_domain'),
        'COOKIE_HTTP_ONLY' => true,
    ],
    'database' => [
        'DB_HOST' => null,
        'DB_USER' => null,
        'DB_PASS' => null,
        'DB_NAME' => null,
    ],
    'route' => [
        'ROUTING_ENABLED' => false,
    ],
];

/*
 * Check to see if a configuration file exists.
 */
if (file_exists(APP_ROOT.'/.env.ini')) {
    $env = parse_ini_file(APP_ROOT.'/.env.ini', true, INI_SCANNER_RAW);
    Env::setConfig($env);
} else {
    Env::setConfig($defaultConfig);
}

/**
 * Create an easy access function for configuration variables.
 */
function env($section, $variable = null)
{
    return Env::getConfig($section, $variable);
}
