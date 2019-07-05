<?php

namespace YS\app\controller;

use YS\app\libs\Controller;
use YS\app\Config;

class clean extends Controller
{

    public function index()
    {
        $token = $this->req->get('token');
        if($token != $this->config['serive_token'])exit('非法请求，已记录ip');

        //清理过期订单
        $ctime = (time() - 3600);
        $this->model()->from('orders')->where(array('fields' => 'ctime < ? AND status = 0', 'values' => array($ctime)))->delete();
        if($this->config['ismail_kuc'] = 0) return;
        //查询有误库存告警，查询出所有上架商品信息
        $goodList = $this->model()->select()->from('goods')->where(array('fields' => 'is_ste = 1', 'values' => []))->orderby('id desc')->fetchAll();
        $mailtpl = $this->model()->select()->from('mailtpl')->where(array('fields' => 'is_state=? and cname=?', 'values' => array(0, '库存告警')))->fetchRow();
        $goodNames = "";
        foreach ($goodList as $v){
            if($v['kuc'] < $this->config['ismail_num']){
               $goodNames .= $v['gname']."--";
            }
        }
        if($goodNames != ""){
            $goodNames = trim($goodNames,'--');
            $info = [
                'sitename' => $this->config['sitename'],
                'gname' => $goodNames,
                'ornum' => $this->config['ismail_num'],
                'siteurl' => $this->config['siteurl'],
            ];
            $newData = $this->res->replaceMailTpl($mailtpl, $info);
            $subject = array('title' => $newData['title'], 'email' => $this->config['email'], 'content' => $newData['content']);

            $this->res->sendMail($subject, $this->config);
        }


    }



}