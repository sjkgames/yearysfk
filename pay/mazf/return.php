<?php
require_once '../inc.php';
use YS\app\libs\Log;

$data = $payDao->getReqdata($_GET);
$payconf = $payDao->checkAcp('mazf');

ksort($data); //排序post参数
reset($data); //内部指针指向数组中的第一个元素
$codepay_key=$payconf['userkey']; //这是您的密钥
$sign = '';//初始化
foreach ($data AS $key => $val) { //遍历POST参数
    if ($val == '' || $key == 'sign') continue; //跳过这些不签名
    if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
    $sign .= "$key=$val"; //拼接为url参数形式
}
if (!$data['pay_no'] || md5($sign . $codepay_key) != $data['sign']) { //不合法的数据
    exit('fail');  //返回失败 继续补单
} else { //合法的数据
    $payarr=[1=>'支付宝', 2=>'QQ钱包', 3=>'微信'];
    $res = $payDao->updateOrder($data['pay_id'],$payarr[$data['type']],$data['pay_no']);
    $payDao->res->redirect($payDao->urlbase . $payDao->req->server('HTTP_HOST') . '/chaka?oid=' .$data['pay_id']);
}
