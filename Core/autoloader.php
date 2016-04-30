<?php

//class ClassAutoloader {
//
//    public function __construct() {
//        spl_autoload_register(array($this, 'loader'));
//    }
//
//    private function loader($className) {
//        echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n";
////        include $className . '.php';
//        var_dump(__NAMESPACE__ . "/" . $className . '.php');
//        include __NAMESPACE__ . "/" . $className . '.php';
//        
//    }
//
//}



//class Autoloader {
//    static public function loader($className) {
//        $filename = dirname(__DIR__) . "/" . str_replace('\\', '/', $className) . ".php";
//        
//        if (file_exists($filename)) {
//            include($filename);
//
//            if (class_exists($className)) {
//                return TRUE;
//            }
//        }
//        return FALSE;
//    }
//}
//spl_autoload_register('Autoloader::loader');


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
//    die(var_dump($fileName));
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

//    die(var_dump(dirname(__DIR__) .DIRECTORY_SEPARATOR . $fileName));;
    $fileName = APPLICATION_PATH . DIRECTORY_SEPARATOR . $fileName;
    
    require  $fileName;
}
spl_autoload_register('autoload');
