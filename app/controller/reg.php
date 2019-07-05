<?php
/**
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 2:19
 */

namespace YS\app\controller;

use YS\app\libs\Controller;

/**
 * 注册控制器
 * @package YS\app\controller
 */
class reg extends Controller
{
    public function index()
    {
        $this->put('reg.php',['title' => '用户注册']);

    }

    public function save()
    {
        $data = $this->getReqdata($_POST);
        if(!$this->config['sw_reg']) resMsg(0,null,'已关闭注册');
        if(!filter_var($data['uemail'],FILTER_VALIDATE_EMAIL))resMsg(0,null,'邮箱格式不正确');
        if(strlen($data['uname']) < 3) resMsg(0,null,'用户名长度不正确');
        if(strlen($data['upasswd']) <6) resMsg(0,null,'密码长度不正确');
        if($data['upasswd'] != $data['rpasswd']) resMsg(0,null,'两次密码输入不一致');
        if($data['ckmember'] != 'on') resMsg(0,null,'请勾选用户协议');
        //判断邮箱或用户名是否已经注册
        $info = $this->model()->select()->from('user')->where(array('fields' => 'uname = ? OR uemail = ?', 'values' => [$data['uname'],$data['uemail']]))->fetchRow();
        if($info) resMsg(0,null,'用户名或邮箱已存在');
        // 添加用户
        $data['lid'] = $this->config['regle'];
        $data['upasswd'] = sha1($data['upasswd']);
        $data['ctime'] = time();
        unset($data['ckmember']);
        unset($data['rpasswd']);
        if ($this->model()->from('user')->insertData($data)->insert()) {
            resMsg(1,null,'注册成功', '/login');
        }
        resMsg(0,null,'注册失败');
    }

    public function repass()
    {
        $this->put('repass.php',['title' => '找回密码']);
    }

    public function dorepass()
    {
        $data = $this->getReqdata($_POST);
        if(strlen($data['uname']) < 3) resMsg(0,null,'用户名长度不正确');
        if(!filter_var($data['uemail'],FILTER_VALIDATE_EMAIL))resMsg(0,null,'邮箱格式不正确');
        $info = $this->model()->select()->from('user')->where(array('fields' => 'uname = ? and uemail = ? ', 'values' => [$data['uname'],$data['uemail']]))->fetchRow();
        if(!$info) resMsg(0,null,'用户不存在');
        if(!$info['is_state']) resMsg(0,null,'用户已被禁用');
        // 判断找回时间是否合理
        $nowtime = time();
        $token = $this->model()->select()->from('mailtoken')->where(array('fields' => 'ctime > ? and uid = ?', 'values' => [$nowtime,$info['id']]))->fetchRow();
        if($token) resMsg(0,null,'找回操作过于频繁，请休息几分钟再试');
        $addinfo = [
            'uid' => $info['id'],
            'token' => sha1($nowtime.rand(100000,9999999)),
            'ctime' => $nowtime+300 // 5分钟
        ];
        if (!$this->model()->from('mailtoken')->insertData($addinfo)->insert()) {
            resMsg(0,null,'系统异常，请稍后再试~');
        }
        // 发送邮件
        $mailtpl = $this->model()->select()->from('mailtpl')->where(array('fields' => 'is_state=? and cname=?', 'values' => array(0, '找回密码')))->fetchRow();
        $this->config['token'] = $addinfo['token'];
        $newData = $this->res->replaceMailTpl($mailtpl, $this->config);
        $subject = array('title' => $newData['title'], 'email' => $data['uemail'], 'content' => $newData['content']);
        $this->res->sendMail($subject, $this->config);
        resMsg(1,null,'找回密码邮件发送成功，请注意查收');
    }

    public function repwd()
    {
        $token = $this->req->get('token');
        if($token == "")  $this->res->redirect('/');
        $info = $this->model()->select()->from('mailtoken')->where(array('fields' => 'token = ? ', 'values' => [$token]))->fetchRow();
        if(!$info) $this->res->redirect('/');
        $nowtime = time();
        if($info['ctime'] < $nowtime){
            $xctime = $nowtime - $info['ctime'];
            if($xctime > 7200) exit('链接已过期，请重新找回密码！');
        }
        $this->put('repwd.php',['title' => '重置密码','token' => $token]);
    }

    public function doRepwd()
    {
        $data = $this->getReqdata($_POST);
        $token = $data['token'];
        if($token == "")  resMsg(0,null,'非法操作~');
        $info = $this->model()->select()->from('mailtoken')->where(array('fields' => 'token = ? ', 'values' => [$token]))->fetchRow();
        if(!$info) resMsg(0,null,'非法操作~');
        $nowtime = time();
        if($info['ctime'] < $nowtime){
            $xctime = $nowtime - $info['ctime'];
            if($xctime > 7200) resMsg(0,null,'操作已过期，请重新找回~');
        }
        if(strlen($data['upasswd']) <6) resMsg(0,null,'密码长度不正确');
        if($data['upasswd'] != $data['rpasswd']) resMsg(0,null,'两次密码输入不一致');
        $user['upasswd'] = sha1($data['upasswd']);
        if($this->model()->from('user')->updateSet($user)->where(array('fields' => 'id=?', 'values' => array($info['uid'])))->update()){
            // 删除记录
            $this->model()->from('mailtoken')->where(array( 'uid' => $info['uid']))->in()->delete();
            resMsg(1,null,'成功','/login');
        }
        resMsg(1,null,'重置失败！');
    }
}