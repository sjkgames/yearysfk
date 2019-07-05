<?php
require_once '../inc.php';


$orderid = $payDao->req->get('orderid');
$paycode = $payDao->req->get('paycode');

//查询订单是否存在
$order = $payDao->checkOrder($orderid);
$payconf = $payDao->checkAcp('mazf');

$data = array(
    "id" => $payconf['userid'],//你的码支付ID
    "pay_id" => $order['orderid'], //唯一标识 可以是用户ID,用户名,session_id(),订单ID,ip 付款后返回
    "type" => $paycode,//1支付宝支付 3微信支付 2QQ钱包
    "price" => $order['cmoney'],//金额100元
    "param" => "",//自定义参数
    "notify_url"=>$payDao->urlbase.$_SERVER['HTTP_HOST'].'/pay/mazf/notify.php',//通知地址
    "return_url"=> $payDao->urlbase.$_SERVER['HTTP_HOST'].'/pay/mazf/return.php',//跳转地址
); //构造需要传递的参数

ksort($data); //重新排序$data数组
reset($data); //内部指针指向数组中的第一个元素

$sign = ''; //初始化需要签名的字符为空
$urls = ''; //初始化URL参数为空

foreach ($data AS $key => $val) { //遍历需要传递的参数
    if ($val == ''||$key == 'sign') continue; //跳过这些不参数签名
    if ($sign != '') { //后面追加&拼接URL
        $sign .= "&";
        $urls .= "&";
    }
    $sign .= "$key=$val"; //拼接为url参数形式
    $urls .= "$key=" . urlencode($val); //拼接为url参数形式并URL编码参数值

}
$query = $urls . '&sign=' . md5($sign .$payconf['userkey']); //创建订单所需的参数
$url = "http://api2.fateqq.com:52888/creat_order/?{$query}"; //支付页面

header("Location:{$url}"); //跳转到支付页面
