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
        echo "<h1>Fatal error</h1>";
        echo "<p>Uncaught exception: "  . get_class($exception).   "</p>";
        echo "<p>Message: "  . $exception->getMessage() .   "</p>";
        echo "<p>stack trace: "  . $exception->getTraceAsString() .   "</p>";
        echo "<p>Thrown in: "  . $exception->getFile() .   " on line "
            . $exception->getLine() . "</p>";
        
        
    }
    
    
}
