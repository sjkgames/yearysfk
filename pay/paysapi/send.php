<?php
require_once '../inc.php';


$orderid = $payDao->req->get('orderid');
$paycode = $payDao->req->get('paycode');

//查询订单是否存在
$order = $payDao->checkOrder($orderid);
$payconf = $payDao->checkAcp('paysapi');

//从网页传入price:支付价格， istype:支付渠道：1-支付宝；2-微信支付
$price = $order['cmoney'];
$istype = $paycode;

$orderuid = $order['account'].'-'.$paycode;       //此处传入您网站用户的用户名，方便在paysapi后台查看是谁付的款，强烈建议加上。可忽略。

//校验传入的表单，确保价格为正常价格（整数，1位小数，2位小数都可以），支付渠道只能是1或者2，orderuid长度不要超过33个中英文字。

//此处就在您服务器生成新订单，并把创建的订单号传入到下面的orderid中。
$goodsname = $order['oname'];
$orderid = $order['orderid'];    //每次有任何参数变化，订单号就变一个吧。
$uid = $payconf['userid'];//"此处填写PaysApi的uid";
$token = $payconf['userkey'];//"此处填写PaysApi的Token";
$return_url = $payDao->urlbase.$_SERVER['HTTP_HOST'].'/pay/paysapi/return.php';
$notify_url = $payDao->urlbase.$_SERVER['HTTP_HOST'].'/pay/paysapi/notify.php';

$key = md5($goodsname. $istype . $notify_url . $orderid . $orderuid . $price . $return_url . $token . $uid);
//经常遇到有研发问为啥key值返回错误，大多数原因：1.参数的排列顺序不对；2.上面的参数少传了，但是这里的key值又带进去计算了，导致服务端key算出来和你的不一样。

$returndata['goodsname'] = $goodsname;
$returndata['istype'] = $istype;
$returndata['key'] = $key;
$returndata['notify_url'] = $notify_url;
$returndata['orderid'] = $orderid;
$returndata['orderuid'] =$orderuid;
$returndata['price'] = $price;
$returndata['return_url'] = $return_url;
$returndata['uid'] = $uid;

$html = "
<html><head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
	<title>正在为您跳转到支付页面，请稍候...</title>
    <style type=\"text/css\">
        body {margin:0;padding:0;}
        p {position:absolute;
            left:50%;top:50%;
            width:330px;height:30px;
            margin:-35px 0 0 -160px;
            padding:20px;font:bold 14px/30px \"宋体\", Arial;
            background:#f9fafc url(../images/loading.gif) no-repeat 20px 26px;
            text-indent:22px;border:1px solid #c5d0dc;}
        #waiting {font-family:Arial;}
    </style>
<script>
function open_without_referrer(link){
document.body.appendChild(document.createElement('iframe')).src='javascript:\"<script>top.location.replace(\''+link+'\')<\/script>\"';
}
</script>
</head>
<body style=\"\">
<form id=\"alipaysubmit\" name=\"alipaysubmit\" action=\"https://pay.paysapi.com/\" method=\"post\">
<input type=\"hidden\" name=\"goodsname\" value=\"".$goodsname."\">
<input type=\"hidden\" name=\"istype\" value=\"".$istype."\">
<input type=\"hidden\" name=\"key\" value=\"".$key."\">
<input type=\"hidden\" name=\"notify_url\" value=\"".$notify_url."\">
<input type=\"hidden\" name=\"orderid\" value=\"".$orderid."\">
<input type=\"hidden\" name=\"orderuid\" value=\"".$orderuid."\">
<input type=\"hidden\" name=\"price\" value=\"".$price."\">
<input type=\"hidden\" name=\"return_url\" value=\"".$return_url."\">
<input type=\"hidden\" name=\"uid\" value=\"".$uid."\">
<input type=\"submit\" value=\"正在跳转\">
</form><script>document.forms['alipaysubmit'].submit();</script></body></html>
";
exit($html);
