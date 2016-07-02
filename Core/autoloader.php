<?php
/**
 * autoload file for whole application
 * @param string $className path to file to load 
 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }

    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    $fileName = APPLICATION_PATH . DIRECTORY_SEPARATOR . $fileName;
    
    require  $fileName;
}
spl_autoload_register('autoload');
