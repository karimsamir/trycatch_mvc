<?php

//function __autoload($class)
//{
//    $parts = explode('\\', $class);
//    require end($parts) . '.php';
//}

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



class Autoloader {
    static public function loader($className) {
        $filename =  __DIR__ . "/../" . str_replace('\\', '/', $className) . ".php";
        
        if (file_exists($filename)) {
            include($filename);

            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
spl_autoload_register('Autoloader::loader');
