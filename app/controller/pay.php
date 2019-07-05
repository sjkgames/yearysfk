<?php
namespace YS\app\controller;

use YS\app\libs\Controller;

class pay extends Controller
{
    /**
     * 支付方法
     */
    public function index()
    {
        $id = $this->req->get('id');
        $type = $this->req->get('type');
        $paycode = $this->req->get('paycode');
        //查询订单是否存在
        $order = $this->model()->select()->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($id)))->fetchRow();
        if(!$order)exit('非法请求，已记录ip');
        $payconf = $this->model()->select()->from('acp')->where(array('fields' => 'code=?', 'values' => array($paycode)))->fetchRow();
        if(!$payconf)exit('平台未配置支付参数，请联系管理员');
        $url = $this->urlbase . $this->req->server('HTTP_HOST') . '/pay/' . $payconf['code']. '/send.php';
        $url .= '?orderid=' . $id . '&paycode=' . $type;
        $this->res->redirect($url);
    }



}