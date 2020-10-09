<?php
define('ROOT_DIR', __DIR__);

require_once "app/Config.php";
require_once "system/Database.php";
require_once "system/System.php";
require_once "system/Helpers.php";
require_once "app/Helpers.php";
require_once "app/Routes.php";

if (uri_segment(1)) {
    $key = uri_segment(2) ? uri_segment(1) . "/" . uri_segment(2) : uri_segment(1);
    if (isset($route[$key])) {
        $params = array_filter(explode("/", $route[$key]));
        $className  = $params[0];
        $method = isset($params[1]) ? $params[1] : false;
        $file   = ROOT_DIR . "/app/Classes/" . $className . ".php";

        if (file_exists($file)) {
            require_once $file;
            $class = new $className();
            if ($method) {
                if (method_exists($className, $method)) {
                    $class->$method();
                }
            } else {
                if (method_exists($class, "index")) {
                    $class->index();
                }
            }
        }
    } else {
        $className  = $route["home"];
        $file   = ROOT_DIR . "/app/Classes/" . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
            $class = new $className();
            if (method_exists($class, "notfound")) {
                $class->notfound();
            }
        }
    }
} else {
    $className  = $route["home"];
    $file   = ROOT_DIR . "/app/Classes/" . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
        $class = new $className();
        if (method_exists($class, "index")) {
            $class->index();
        }
    }
}
