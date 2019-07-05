<?php
/**
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 9:33
 */

namespace YS\app\controller\user;

use YS\app\controller\user\base;

class sett extends base
{
    public function index()
    {
        // 用户是否存在
        $info = $this->model()->select()->from('user')->where(array('fields' => 'id = ? ', 'values' => [$this->session->get('login_uid')]))->fetchRow();
        $this->put('user_sett.php', $info);

    }

    public function repwd()
    {
        $data = $this->getReqdata($_POST);
        if(strlen($data['pass']) <6) resMsg(0,null,'密码长度不正确');
        $user['upasswd'] = sha1($data['pass']);
        if($this->model()->from('user')->updateSet($user)->where(array('fields' => 'id=?', 'values' => array($this->session->get('login_uid'))))->update()){
            resMsg(1,null,'密码更新成功');
        }
        resMsg(1,null,'密码修改失败！');
    }

    public function import()
    {
        $id = $this->req->get('id') ? $this->req->get('id') : 0;
        $data = $this->model()->select()->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($id)))->fetchRow();
        if (!$data) exit('订单不存在');
        $filename = $data['oname'].'-'.rand(100000,999999).".txt";
        Header( "Content-type:   application/octet-stream ");
        Header( "Accept-Ranges:   bytes ");
        header( "Content-Disposition:   attachment;   filename=".$filename);
        header( "Expires:   0 ");
        header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ");
        header( "Pragma:   public ");
        echo $data['info'];
    }

}