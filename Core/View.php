<?php

namespace Core;

/**
 * Class to be used to render a view file
 *
 * @author karim
 */
class View {

    /**
     * render main view file
     * @param string $view
     * @param array $args
     */
    public static function render($view, $args = []) {

        extract($args, EXTR_SKIP);

        // going up to views folder
        $file = "../App/Views/$view";

        if (file_exists($file)) {
            require $file;
        } else {
//            echo "$file not found";
            throw new \Exception("$file not found");
        }
    }

    public static function renderTemplate($template, $args = []) {
        static $twig = null;

        if ($twig === NULL) {
            $loader = new \Twig_Loader_Filesystem('../App/Views');
//            $twig = new \Twig_Environment($loader);
            $twig = new \Twig_Environment($loader, array(
                'debug' => true
            ));
            $twig->addExtension(new \Twig_Extension_Debug());
        }
        // make session variable available to template
        $args["session"] = $_SESSION;
        echo $twig->render($template, $args);

        //remove session message like flash messages
        unset($_SESSION["error_message"]);
        unset($_SESSION["success_message"]);
    }

}
