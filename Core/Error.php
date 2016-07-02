<?php

namespace Core;
use Core\View;

/**
 *
 * @author karim
 */
class Error {

    public static function errorHandler($level, $message, $file, $line) {

        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
//            throw new \Exception();
        }
    }

    /**
     * 
     * @param type $exception
     * @return type
     */
    public static function exceptionHandler($exception) {

        $code = $exception->getCode();

        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        $exceptionMsg =  $exception->getMessage();
        $fileThrownError = $exception->getFile();
        
        $message = "<h1>Fatal error</h1>";
        $message .= "<p>Uncaught exception: " . get_class($exception) . "</p>";
        $message .= "<p>Message: $exceptionMsg</p>";
        $message .= "<p>stack trace: " . $exception->getTraceAsString() . "</p>";
        $message .= "<p>Thrown in: $fileThrownError on line "
                . $exception->getLine() . "</p>";

        if (\App\Config::SHOW_ERRORS) {
            echo $message;
        } else {
            $logMsg = "FATAL: $exceptionMsg thrown in: $fileThrownError";
            
            $log = dirname(__DIR__) . "/logs/" . date("Y-m-d") . ".txt";
            ini_set("error_log", $log);
            error_log($logMsg);

            if ($code == 404) {
                // redirect to show 404 page
                header("Location: /pagenotfound");
            } else {
                // redirect to show server error
                header("Location: /servererror");
            }
            return;
        }
    }

}
