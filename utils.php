<?php
/**
 * Vars kit
 * User: moyo
 * Date: 14/12/2017
 * Time: 3:57 PM
 */

/**
 * @return bool
 */
function debug() : bool
{
    return env('DEBUG', 0) ? true : false;
}

/**
 * @param string $name
 * @param mixed $default
 * @return mixed
 */
function env(string $name, $default = null)
{
    return ($got = getenv($name, true)) === false ? $default : $got;
}
