<?php
/**
 * Vars manager
 * User: moyo
 * Date: 2018/8/22
 * Time: 4:08 PM
 */

namespace Carno\Env;

use Symfony\Component\Dotenv\Dotenv;
use Throwable;

class Vars
{
    /**
     * @var Dotenv
     */
    private static $ins = null;

    /**
     * @return Dotenv
     */
    private static function env() : Dotenv
    {
        return self::$ins ?? self::$ins = new Dotenv;
    }

    /**
     * @param string ...$files
     */
    public static function load(string ...$files) : void
    {
        self::env()->load(...$files);
    }

    /**
     * @param string $text
     */
    public static function populate(string $text) : void
    {
        try {
            self::env()->populate(self::env()->parse($text));
        } catch (Throwable $e) {
            trigger_error('env populate failed -> '.$e->getMessage(), E_USER_WARNING);
        }
    }

    /**
     * @param string $key
     * @param string $val
     */
    public static function export(string $key, string $val) : void
    {
        self::populate(sprintf('%s=%s', trim($key), $val));
    }

    /**
     * @param string $key
     */
    public static function unset(string $key) : void
    {
        strstr($key, '=') || putenv(trim($key));
    }
}
