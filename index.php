<?php

if (!file_exists(__DIR__ . '/install/install.lock'))
{
    header("location:/install.php");
    exit;
}

require_once 'app/init.php';
use YS\app\ysapp;
$app = ysapp::getInstance();
$app -> run();
?>