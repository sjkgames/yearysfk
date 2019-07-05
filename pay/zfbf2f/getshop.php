<?php
require_once '../inc.php';
$orderid = $payDao->req->get('oid');
//查询订单是否存在
$order = $payDao->checkOrder($orderid,2);

if($order['status'] > 0){
    resMsg(1,$payDao->urlbase . $payDao->req->server('HTTP_HOST') . '/chaka?oid=' .$order['orderid']);
}else{
    resMsg(0,null);
}