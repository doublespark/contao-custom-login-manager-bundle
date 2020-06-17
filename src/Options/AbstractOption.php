<?php

namespace Doublespark\ContaoCustomLoginManagerBundle\Options;

/**
 * Class Option
 *
 * @package Doublespark\ContaoCustomLoginManagerBundle\Options
 */
abstract class AbstractOption implements OptionInterface
{
    /**
     * Returns the label for an option
     * @param $k
     * @return string
     */
    public static function getOptionLabel($k)
    {
        $arrOptions = static::getOptions();

        if(isset($arrOptions[$k]))
        {
            return $arrOptions[$k];
        }

        return '';
    }
}