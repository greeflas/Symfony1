<?php

/**
 * Class Jobeet.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Jobeet
{
    /**
     * Generates slug from text string.
     *
     * @param string $text
     * @return string
     */
    public static function slugify($text)
    {
        $text = preg_replace('/\W+/', '-', $text);
        return strtolower(trim($text, '-'));
    }
}