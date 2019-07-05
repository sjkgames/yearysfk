<?php
require_once '../inc.php';


$data = $payDao->getReqdata($_GET);
$payconf = $payDao->checkAcp('zcyzf');
//除去待签名参数数组中的空值和签名参数
$para_filter = paraFilter($data);
//对待签名参数数组排序
$para_sort = argSort($para_filter);
//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
$prestr = createLinkstring($para_sort);
$isSgin = md5Verify($prestr, $data['sign'],$payconf['userkey']);

$payarr = [
    'alipay' => '支付宝扫码',
    'wxpay' => '微信扫码',
    'qqpay' => '手Q扫码',
];

if($isSgin){
    if($data['trade_status'] == 'TRADE_SUCCESS') {
        $res = $payDao->updateOrder($data['out_trade_no'],$payarr[$data['type']],$data['trade_no']);
        if(!$res)exit('success');
        exit('success');
    }
    exit('success');
}else{
    exit('error');
}