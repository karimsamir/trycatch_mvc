<?php

namespace Core;
use Core\View;

/**
 * Description of Error
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

    public static function exceptionHandler($exception) {

        $code = $exception->getCode();

        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        $message = "<h1>Fatal error</h1>";
        $message .= "<p>Uncaught exception: " . get_class($exception) . "</p>";
        $message .= "<p>Message: " . $exception->getMessage() . "</p>";
        $message .= "<p>stack trace: " . $exception->getTraceAsString() . "</p>";
        $message .= "<p>Thrown in: " . $exception->getFile() . " on line "
                . $exception->getLine() . "</p>";

        if (\App\Config::SHOW_ERRORS) {
            echo $message;
        } else {
            $log = dirname(__DIR__) . "/logs/" . date("Y-m-d") . ".txt";
            ini_set("error_log", $log);
            error_log($message);

            if ($code == 404) {
                // redirect to show all contacts
                header("Location: /pagenotfound");
            } else {
                // redirect to show all contacts
                header("Location: /servererror");
            }
            return;
//            View::renderTemplate("error/$code.html");
        }
    }

}
