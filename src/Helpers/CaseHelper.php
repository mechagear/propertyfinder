<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 02.08.17
 * Time: 23:53
 */

namespace Mechagear\PF\Helpers;

/**
 * Class CaseHelper
 * @package Mechagear\PF\Helpers
 */
class CaseHelper
{

    /**
     * Primitive camelizer.
     * Converts string from snake_case to CamelCase
     * @param string $value
     * @return string
     */
    public static function camelize(string $value): string
    {
        return str_replace('_', '', ucwords(trim($value), '_'));
    }
}