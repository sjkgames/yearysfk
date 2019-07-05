<?php
require_once __DIR__.'/../app/init.php';
use YS\app\ysapp;
use YS\app\controller\PayBase;

ysapp::getInstance();

$payDao = new PayBase();

