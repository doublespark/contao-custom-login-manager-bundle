<?php

namespace Doublespark\ContaoCustomLoginManagerBundle\Options;

/**
 * Class CategoryOptions
 *
 * @package Doublespark\ContaoCustomLoginManagerBundle\Options
 */
class CategoryOptions extends AbstractOption
{
    // Option constants
    const SEO     = 1;
    const OFFLINE = 2;

    /**
     * Returns an array of option key / value pairs
     * @return array
     */
    public static function getOptions()
    {
        return [
            static::SEO     => 'SEO',
            static::OFFLINE => 'Offline'
        ];
    }
}