<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

/**
 * Description of Error
 *
 * @author karim
 */
class Error {
    
    public static function errorHandler($level, $message, $file, $line) {
    
        if (error_reporting() !== 0) {
            throw new \Exception($message, 0, $level, $file, $line);
        }
    }
    
    public static function exceptionHandler($exception) {
        
        $message =  "<h1>Fatal error</h1>";
        $message .=  "<p>Uncaught exception: "  . get_class($exception).   "</p>";
        $message .=  "<p>Message: "  . $exception->getMessage() .   "</p>";
        $message .=  "<p>stack trace: "  . $exception->getTraceAsString() .   "</p>";
        $message .=  "<p>Thrown in: "  . $exception->getFile() .   " on line "
            . $exception->getLine() . "</p>";
        
                if (\App\Config::SHOW_ERRORS) {
            echo $message;
        }
        else{
            $log = dirname(__DIR__) . "/logs/" . date("Y-m-d") . ".txt";
            ini_set("error_log", $log);
            error_log($message);
            echo 'An error has occured, Please try again later';
        }
        
        
    }
    
    
}
