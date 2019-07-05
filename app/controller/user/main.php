<?php
/**
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 9:56
 */

namespace YS\app\controller\user;

use YS\app\controller\user\base;

class main extends base
{

    public function index()
    {
        // 获取消费详情
        // 总订单
        $data['ctOrder'] = $this->model()->select()->from('orders')->where(array('fields' => '`status` > 0 and uid = '. $this->session->get('login_uid')))->count();
        $data['ctMoney'] = $this->model()->select('ctmoney')->from('user')->where(array('fields' => 'id=?', 'values' => array($this->session->get('login_uid'))))->fetchRow();

        $oid = $this->req->get('oid') ;
        $account = $this->req->get('account') ;
        $otype = isset($_GET['otype']) ? $this->req->get('otype') : -1 ;
        $status = isset($_GET['status']) ? $this->req->get('status') : -1 ;
        $cons = '';
        $consArr = [];
        $cons.= 'o.status > 0';
        $cons .= $cons ? ' and ' : '';
        $cons.= 'o.uid = ?';
        $consArr[] =  $this->session->get('login_uid');
        if($otype >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.otype = ?';
            $consArr[] = $otype;
        }
        if($status >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.status = ?';
            $consArr[] = $status;
        }
        if($oid != ""){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.orderid = ?';
            $consArr[] = $oid;
        }
        if($account != ""){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.account = ?';
            $consArr[] = $account;
        }
        $lists = [];
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $totalsize = $this->model()->from('orders o')->where(array('fields' => $cons, 'values' => $consArr))->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('o.*,g.gname')->from('orders o')->limit($pagesize)->left('goods g')->on('o.gid=g.id')->join()->offset($offset)->where(array('fields' => $cons, 'values' => $consArr))->orderby('o.ctime desc')->fetchAll();
        }
        $pagelist = $this->page->putamz(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?oid='.$oid.'&otype='.$otype.'&status='.$status.'&uid='.$uid.'&gid='.$gid.'&account='.$account.'&uname='.$uname.'&p='));

        $search =[
            'oid' => $oid,
            'account' => $account,
            'otype' => $otype,
            'status' => $status
        ];
        $data = array('title' => '个人中心', 'lists' => $lists, 'user' => $data,  'pagelist' => $pagelist, 'search' => $search);

        $this->put('user_index.php', $data);

    }


}