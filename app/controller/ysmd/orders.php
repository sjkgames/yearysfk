<?php
namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;

class orders extends CheckAdmin
{
    public function index()
    {
        $type=$this->req->get('type');
        if($type=='mp3'){
            //$totalsize = $this->model()->select()->from('payments')->where(array('is_state' => 0))->count();
            $totalsize = $this->model()->select()->from('orders')->where(array('fields' => 'status=?', 'values' => array(1)))->count();
            if((int)$totalsize>0){
                echo 'success';
            }else{
                echo 'error';
            }
            die;
        }
        $oid = $this->req->get('oid') ;
        $uname = $this->req->get('uname') ;
        $account = $this->req->get('account') ;
        $gid = $this->req->get('gid') ;
        $uid = $this->req->get('uid') ;
        $otype = isset($_GET['otype']) ? $this->req->get('otype') : -1 ;
        $status = isset($_GET['status']) ? $this->req->get('status') : -1 ;
        $cons = '';
        $consArr = [];
        $cons.= 'o.status > 0';
        if($otype >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.otype = ?';
            $consArr[] = $otype;
        }
        if($uid > 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.uid = ?';
            $consArr[] = $uid;
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
        if($uname != ""){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.uname = ?';
            $consArr[] = $uname;
        }
        if($account != ""){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.account = ?';
            $consArr[] = $account;
        }
        if($gid != ""){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'o.gid = ?';
            $consArr[] = $gid;
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
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?oid='.$oid.'&otype='.$otype.'&status='.$status.'&uid='.$uid.'&gid='.$gid.'&account='.$account.'&uname='.$uname.'&p='));

        $search =[
            'oid' => $oid,
            'otype' => $otype,
            'uname' => $uname,
            'account' => $account,
            'status' => $status
        ];
        $data = array('title' => '订单列表', 'lists' => $lists,  'pagelist' => $pagelist, 'search' => $search);
        $this->put('orders.php', $data);

    }

    /**
     * 处理订单
     */
    public function checkOrder()
    {
        $ids = $this->req->post('ids');
        $status = $this->req->post('status');
        $idsarr = explode(',',$ids);
        if($status == 9){
            $res = $this->model()->from('orders')->where(array( 'id' => $idsarr))->in()->delete();
            if($res)echo json_encode(array('status' => 1));exit;
            echo json_encode(array('status' => 0,'msg'=>'删除失败'));exit;
        }
        $config = $this->setConfig;
        //拼接sql
        $sql = "UPDATE ".$config::db()['prefix']."orders SET `status` = ".$status." WHERE `id` IN (".$ids.")";
        $res = $this->model()->query($sql);
        if($res)echo json_encode(array('status' => 1));exit;
        echo json_encode(array('status' => 0,'msg'=>'处理失败'));exit;


    }

    public function getinfo()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('orders')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        if(!$data)$this->error('订单不存在');
        $this->put('getinfo.php', array('title' => '编辑分类', 'data' => $data));
    }


}