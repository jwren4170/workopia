<?php

namespace JWord\Framework;

class Validation
{
    /**
     * Validate a string
     *
     * @param string $value
     * @param int $min
     * @param int $max
     * 
     * @return bool
     * 
     */
    public static function string(string $value, int $min = 1, int $max = PHP_INT_MAX): bool
    {
        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= $max;
        }
        return false;
    }

    /**
     * Validate email
     *
     * @param string $value
     * 
     * @return mixed
     * 
     */
    public static function email(string $value): mixed
    {
        if (is_string($value))
            $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Match one value with another
     *
     * @param string $value1
     * @param string $value2
     * 
     * @return bool
     * 
     */
    public static function match(string $value1, string $value2): bool
    {
        if (is_string($value1) && is_string($value2)) {
            return trim($value1) === trim($value2);
        }
        return false;
    }
}
