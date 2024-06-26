<?php

namespace JWord\Framework;

class Session
{
    /**
     * start session
     *
     * @return void
     * 
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * set the session key/value pair
     *
     * @return void
     * 
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * get the session key/value pair
     *
     * @return mixed
     * 
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * check if session key exists
     *
     * @param string $key
     * 
     * @return bool
     * 
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * clear the session key
     *
     * @param string $key
     * 
     * @return void
     * 
     */
    public static  function clear(string $key): void
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * clear all the session data
     *
     * @return void
     * 
     */
    public static function destroy(): void
    {
        session_unset();
        session_destroy();
    }

    /**
     * Method set_flash_message sets a flash message
     *
     * @param string $key [explicite description]
     * @param string $value [explicite description]
     *
     * @return void
     */
    public static function set_flash_message(string $key, string $value): void
    {
        self::set($key, $value);
    }

    /**
     * Method get_flash_message get a flash message
     *
     * @param string $key [explicite description]
     * @param mixed $default [explicite description]
     *
     * @return mixed
     */
    public static function get_flash_message(string $key, mixed $default = null): mixed
    {
        $message = self::get($key, $default);
        self::clear($key);
        return $message;
    }
}
