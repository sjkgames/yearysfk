<?php

error_reporting(0);
ini_set('display_errors','off');

define('YS_ROOT',dirname(__FILE__));
ob_start();header('Content-Type:text/html;charset=utf8');
date_default_timezone_set('Asia/Shanghai');
//自动加载
require YS_ROOT.'/../vendor/autoload.php';
require_once YS_ROOT.'/common.php';
require_once YS_ROOT.'/Config.php';
require_once YS_ROOT.'/ysapp.php';

session_start();
?>