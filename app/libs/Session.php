<?php
namespace YS\app\libs;


class Session
{
    public static function set($name, $val)
    {
        $_SESSION[$name] = $val;
    }
    public static function get($name)
    {
        return isset($_SESSION[$name]) && $_SESSION[$name] ? $_SESSION[$name] : false;
    }
}
?>