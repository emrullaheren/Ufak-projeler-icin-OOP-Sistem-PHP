<?php

function dangerChars($str)
{
    $str = str_replace("`", "", $str);
    $str = str_replace("=", "", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace("%", "", $str);
    $str = str_replace("!", "", $str);
    $str = str_replace("#", "", $str);
    $str = str_replace("<", "", $str);
    $str = str_replace(">", "", $str);
    $str = str_replace("*", "", $str);
    $str = str_replace("And", "", $str);
    $str = str_replace("'", "", $str);
    $str = str_replace("chr(34)", "", $str);
    $str = str_replace("chr(39)", "", $str);
    return $str;
}

function filterUrl($str, $strip_tags = true)
{
    if ($strip_tags) {

        return dangerChars(strip_tags(htmlspecialchars(trim($str))));
    }

    return htmlspecialchars(trim($str));
}

function get($name)
{
    if (isset($_GET[$name])) {

        if (is_array($_GET[$name])) {

            return array_map(function ($item) {
                return filterUrl($item);
            }, $_GET[$name]);
        }

        return filterUrl($_GET[$name]);
    }

    return false;
}

function post($name)
{
    if (isset($_POST[$name])) {

        if (is_array($_POST[$name])) {

            return array_map(function ($item) {
                return filterUrl($item);
            }, $_POST[$name]);
        }

        return filterUrl($_POST[$name]);
    }

    return false;
}

function uri_segment($param = false)
{
    $url    = filterUrl($_SERVER['REQUEST_URI']);
    $params = array_filter(explode("/", $url));
    array_unshift($params);
    if ($param) {
        if (isset($params[$param])) {
            return $params[$param];
        } else {
            return false;
        }
    }
    return $url;
}

function base_url($param = false)
{
    return CONFIG["baseUrl"] . $param;
}

function lang($words = "")
{
    if (rsession("lang") && file_exists(ROOT_DIR . "/app/Languages/" . rsession("lang") . ".php")) {
        require_once ROOT_DIR . "/app/Languages/" . rsession("lang") . ".php";
    } else {
        require_once ROOT_DIR . "/app/Languages/" . CONFIG["language"] . ".php";
    }

    return isset($lang[$words]) ? $lang[$words] : "";
}

function rsession($name)
{
    return isset($_SESSION[$name]) ? $_SESSION[$name] : "";
}

function wsession($name, $value)
{
    $_SESSION[$name] = $value;
}

function dsession($name)
{
    unset($_SESSION[$name]);
}

function redirect($url = false)
{
    header('Location: ' . base_url($url));
}
