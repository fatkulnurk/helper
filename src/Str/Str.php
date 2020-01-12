<?php
declare(strict_types=1);

namespace Fatkulnurk\Helper\Str;

class Str
{
    /**
     * @param  string $value
     * @param  int    $limit
     * @param  string $end
     * @return string
     */
    public static function limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
    }

    /**
     * @param  string $value
     * @param  string $encoding
     * @return int
     */
    public static function length($value, $encoding = null)
    {
        if ($encoding) {
            return mb_strlen($value, $encoding);
        }
        return mb_strlen($value);
    }

    /**
     * @param int $length
     * @return string
     * @throws \Exception
     */
    public static function random($length = 16)
    {
        $string = '';
        while (($len = mb_strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= mb_substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }
        return $string;
    }

    /**
     * @param  string  $value
     * @return string
     */
    public static function lower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * @param  string  $value
     * @return string
     */
    public static function upper($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * @param  string $value
     * @return string
     */
    public static function title($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * Dapatkan bagian string sebelum kemunculan pertama dari nilai yang diberikan.
     *
     * @param  string  $subject
     * @param  string  $search
     * @return string
     */
    public static function before($subject, $search)
    {
        return $search === '' ? $subject : explode($search, $subject)[0];
    }

    /**
     * Untuk membalik kalimat
     *
     * @param string $string
     * @return string
     */
    public static function reverse(string $string): string
    {
        return strrev($string);
    }

    /**
     * Search For a Text Within a String
     * @param string $string
     * @return int
     */
    public static function pos(string $string): int
    {
        return strpos($string);
    }

    /**
     * Replace Text Within a String
     * @param string $search
     * @param string $replace
     * @param string $text
     * @return string
     */
    public static function replace(string $search , string $replace , string $text): string
    {
        return str_replace($search, $replace, $text);
    }

    /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int  $words
     * @param  string  $end
     * @return string
     */
    public static function words($value, $words = 100, $end = '...')
    {
        preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $value, $matches);
        if (! isset($matches[0]) || static::length($value) === static::length($matches[0])) {
            return $value;
        }
        return rtrim($matches[0]).$end;
    }
}