<?php
/**
 * Simple PSR-4 autoloader. Quite enough for test purposes.
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 21:51
 */

spl_autoload_register(function ($className) {
    $prefix = 'Mechagear\\PF';

    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

    $prefixLength = strlen($prefix);
    if ( strncmp($prefix, $className, $prefixLength) !== 0 ) {
        return;
    }

    $relativeClassName = substr($className, $prefixLength);
    $file = $baseDir . str_replace('\\', '/', $relativeClassName) . '.php';

    if ( file_exists($file) ) {
        require $file;
    }

});