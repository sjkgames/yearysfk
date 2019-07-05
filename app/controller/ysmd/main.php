<?php

namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;

class main extends CheckAdmin
{
    public function index()
    {
        $data = array('title' => '管理面板');
        $start = date('Y-m-d 00:00:00');
        $end = date('Y-m-d H:i:s');
        //查询今日订单数
        $data['nowDay'] = $this->model()->select()->from('orders')->where(array('fields' => '`status` > 0 AND `ctime` >= unix_timestamp( \''.$start.'\' ) AND `ctime` <= unix_timestamp( \''.$end.'\' )  '))->count();
        //今日营业额
        $cmoney = $this->model()->select(['cmoney' => 'cmoney'])->from('orders')->where(array('fields' => '`status` > 0 AND `ctime` >= unix_timestamp( \''.$start.'\' ) AND `ctime` <= unix_timestamp( \''.$end.'\' )  '))->sum();
        $data['nowMoney'] = $cmoney['cmoney'];
        //待处理订单
        $data['dcOrder'] = $this->model()->select()->from('orders')->where(array('fields' => '`status` = 1'))->count();
        //已完成订单
        $data['okOrder'] = $this->model()->select()->from('orders')->where(array('fields' => '`status` = 3'))->count();
        //总订单
        $data['ctOrder'] = $this->model()->select()->from('orders')->where(array('fields' => '`status` > 0'))->count();
        $cmoney = $this->model()->select(['cmoney' => 'cmoney'])->from('orders')->where(array('fields' => '`status` > 0 '))->sum();
        $data['ctMoney'] = $cmoney['cmoney'];

        $data['ctGoods'] = $this->model()->select()->from('goods')->where(array('fields' => ''))->count();
        $day1 = date('Y-m-d');
        $day2 = $this->config['ctime'];
        $data['ctime'] = diffBetweenTwoDays($day1,$day2);
        $systconf = $this->setConfig;
        $sysdata = $systconf::systemInfo();
        $data['version'] = $sysdata['version'];


        $this->put('index.php',$data);
    }
}