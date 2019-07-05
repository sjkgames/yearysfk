<?php
namespace YS\app\libs;


class Req
{
    static function redirect()
    {
        header('location:/404.php');
        exit;
    }
    static function get($val)
    {
        if (isset($_GET[$val])) {
            $value = $_GET[$val];
            return self::safe($value);
        }
        return false;
    }
    static function post($val)
    {
        if (isset($_POST[$val])) {
            $value = $_POST[$val];
            return self::safe($value);
        }
        return false;
    }
    static function server($val)
    {
        if (isset($_SERVER[$val])) {
            $value = $_SERVER[$val];
            return self::safe($value);
        }
        return false;
    }
    static function cookie($val)
    {
        if (isset($_COOKIE[$val])) {
            $value = $_SERVER[$val];
            return self::safe($value);
        }
        return false;
    }
    static function request($val)
    {
        if (isset($_REQUEST[$val])) {
            $value = $_REQUEST[$val];
            return self::safe($value);
        }
        return false;
    }
    static function session($val)
    {
        if (isset($_SESSION[$val])) {
            $value = $_SESSION[$val];
            return self::safe($value);
        }
        return false;
    }
    static function safe($val)
    {
        $val = trim($val);
        if ($val === '') {
            return '';
        }
        if (is_int($val)) {
            return intval($val);
        }
        if (is_float($val)) {
            if (preg_match('/^[+-]?(\\d*\\.\\d+([eE]?[+-]?\\d+)?|\\d+[eE][+-]?\\d+)$/', $val)) {
                return $val;
            }
            return false;
        }
        if (is_string($val)) {
            if (preg_match('/<script>(.*)<\\/script>/iS', $val, $match)) {
                $val = $match[1];
            }
            if (preg_match('/<iframe>(.*)<\\/iframe>/iS', $val, $match)) {
                $val = $match[1];
            }
            return $val;
        }
        // 增强xss防御
        $val = remove_xss($val);
        return $val;
    }
}