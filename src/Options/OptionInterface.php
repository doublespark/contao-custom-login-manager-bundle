<?php

namespace Doublespark\ContaoCustomLoginManagerBundle\Options;

/**
 * Interface OptionInterface
 * Defines an interface for option classes
 */
interface OptionInterface {

    /**
     * Returns an array of option key / value pairs
     * @return array
     */
    public static function getOptions();

    /**
     * Returns the label for an option
     * @param $k
     * @return string
     */
    public static function getOptionLabel($k);
}