<?php
/**
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 3:38
 */


namespace YS\app\controller;

use YS\app\libs\Controller;

class login extends Controller
{

    public function index()
    {
        $this->put('login.php',['title' => '用户登录']);
    }

    public function doLogin()
    {
        $data = $this->getReqdata($_POST);
        if(strlen($data['uname']) < 3) resMsg(0,null,'用户名长度不正确');
        if(strlen($data['upasswd']) <6) resMsg(0,null,'密码长度不正确');
        // 用户是否存在
        $info = $this->model()->select()->from('user')->where(array('fields' => 'uname = ? OR uemail = ? ', 'values' => [$data['uname'],$data['uname']]))->fetchRow();
        if(!$info) resMsg(0,null,'用户不存在');
        if(!$info['is_state']) resMsg(0,null,'用户已被禁用');
        if(sha1($data['upasswd']) != $info['upasswd']) resMsg(0,null,'密码错误');
        $ulevel = $this->model()->select()->from('ulevel')->where(array('fields' => 'id = ? ', 'values' => [$info['lid']]))->fetchRow();
        $this->session->set('login_uname', $info['uname']);
        $this->session->set('login_uemail', $info['uemail']);
        $this->session->set('login_uid', $info['id']);
        $this->session->set('login_ulevel', $ulevel['title']);
        $this->session->set('login_ulid', $info['lid']);
        $this->session->set('login_time', $info['logtime']);
        $this->session->set('login_ip', $info['logip']);
        $user = array('logtime' => time(), 'logip' => getip());
        $this->model()->from('user')->updateSet($user)->where(array('fields' => 'id=?', 'values' => array($info['id'])))->update();
        resMsg(1,null,'登录成功', '/');
    }

    public function logout()
    {
        if ($this->req->session('login_uname')) {
            unset($_SESSION['login_uname']);
            unset($_SESSION['login_ulid']);
            unset($_SESSION['login_uemail']);
            unset($_SESSION['login_ulevel']);
            unset($_SESSION['login_uid']);
            unset($_SESSION['login_time']);
            unset($_SESSION['login_ip']);
        }
        $this->res->redirect('/');
    }


}