<?php
require_once '../inc.php';

use Payment\Client\Charge;
use Payment\Common\PayException;
use Payment\Config;

$orderid = $payDao->req->get('orderid');

//查询订单是否存在
$order = $payDao->checkOrder($orderid);
$payconf = $payDao->checkAcp('alipay');

$config = [
    'use_sandbox' => false,
    'app_id' => $payconf['email'],    //应用appid
    'sign_type' => 'RSA2',
    'ali_public_key' => $payconf['userid'],
    'rsa_private_key' => $payconf['userkey'],
    'notify_url' => $payDao->urlbase . $_SERVER['HTTP_HOST'] . '/pay/zfbf2f/notify.php',                      //异步通知地址
    'return_url' =>  $payDao->urlbase . $_SERVER['HTTP_HOST'] . '/chaka?oid='.$order['orderid'],
    'return_raw' => true
];

$data = [
    'order_no' => $order['orderid'],     //商户订单号，需要保证唯一
    'amount' => $order['cmoney'],           //订单金额，单位 元
    'subject' => $order['oname'],      //订单标题
    'body' => 'alipay',      //订单标题
];
try {
    $str = Charge::run(Config::ALI_CHANNEL_WEB, $config, $data);
    $payDao->res->redirect($str);
} catch (PayException $e) {
    echo $e->errorMessage();
    exit;
}