<?php
require_once '../inc.php';

$orderid = $payDao->req->get('orderid');
$paycode = $payDao->req->get('paycode');

//查询订单是否存在
$order = $payDao->checkOrder($orderid);

$payconf = $payDao->checkAcp('zcyzf');
//组装支付参数
$paydata = [
    'pid' => $payconf['userid'],
    'type' => $paycode,
    'out_trade_no' => $order['orderid'],
    'notify_url'   => $payDao->urlbase.$_SERVER['HTTP_HOST'].'/pay/zcyzf/notify.php',
    'return_url'   => $payDao->urlbase.$_SERVER['HTTP_HOST'].'/pay/zcyzf/return.php',
    'name'   => $order['oname'],
    'money'  => $order['cmoney'],
    //'money'  => 0.01,
    'sign' =>$payconf['userkey'],
    'sign_type' =>'MD5'
];
$para_filter = createLinkstring(argSort(paraFilter($paydata)));//除去待签名参数数组中的空值和签名参数
$sgin = md5Sign($para_filter,$payconf['userkey']);
$paydata['sign'] = $sgin;
$canshu =createLinkstring($paydata);
$payDao->res->redirect('http://zf.210c.cn/submit.php?'.$canshu);