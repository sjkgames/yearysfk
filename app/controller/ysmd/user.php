<?php
/**
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 7:29
 */

namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;

class user extends CheckAdmin
{
    public function index()
    {
        $uid = $this->req->get('id');
        $lid = $this->req->get('lid');
        $is_ste = isset($_GET['is_ste']) ? $this->req->get('is_ste') : -1 ;
        $uname = $this->req->get('uname');
        $cons = '';
        $consArr = [];
        if($uid > 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'u.id = ?';
            $consArr[] = $uid;
        }
        if($lid > 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'u.lid = ?';
            $consArr[] = $lid;
        }

        if($uname){
            $cons .= $cons ? ' and ' : '';
            $cons.= "u.uname like ?";
            $consArr[] = '%' . $uname . '%';;
        }
        if($is_ste >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'u.is_state = ?';
            $consArr[] = $is_ste;
        }
        $lists = [];
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $totalsize = $this->model()->from('user u')->where(array('fields' => $cons, 'values' => $consArr))->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('u.*,ul.title')->from('user u')->limit($pagesize)->left('ulevel ul')->on('ul.id=u.lid')->join()->offset($offset)->where(array('fields' => $cons, 'values' => $consArr))->orderby('u.ctime desc')->fetchAll();
        }

        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?uid='.$uid.'&lid='.$lid.'&uname='.$uname.'&is_ste='.$is_ste.'&p='));
        $search =[
            'uid' => $uid,
            'lid' => $lid,
            'uname' => $uname,
            'is_ste' => $is_ste,
        ];
        //加载所有级别
        $ulevel = $this->model()->select()->from('ulevel')->fetchAll();
        $data = array('title' => '用户列表', 'lists' => $lists, 'pagelist' => $pagelist, 'ulevel' => $ulevel, 'search' => $search);
        $this->put('user.php', $data);
    }


    public function checkUser()
    {
        $ids = $this->req->post('ids');
        $status = $this->req->post('status');
        $idsarr = explode(',',$ids);
        if($status == 9){
            $res = $this->model()->from('user')->where(array( 'id' => $idsarr))->in()->delete();
            if($res)echo json_encode(array('status' => 1));exit;
            echo json_encode(array('status' => 0,'msg'=>'删除失败'));exit;
        }
        $config = $this->setConfig;
        //拼接sql
        $sql = "UPDATE ".$config::db()['prefix']."user SET `is_state` = ".$status." WHERE `id` IN (".$ids.")";
        $res = $this->model()->query($sql);
        if($res)echo json_encode(array('status' => 1));exit;
        echo json_encode(array('status' => 0,'msg'=>'处理失败'));exit;
    }

    public function save()
    {
        $data = $this->getReqdata($_POST);
        if ($data) {
            $data['upasswd'] = sha1($data['upasswd']);
            if ($this->model()->from('user')->insertData($data)->insert()) {
                $this->res->redirect($this->dir . 'user');
            }
        }
        $this->res->redirect($this->dir . 'user');
    }

    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('user')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        if(!$data)$this->error('用户不存在');
        $ulevel = $this->model()->select()->from('ulevel')->fetchAll();
        $this->put('edituser.php', array('title' => '编辑用户', 'data' => $data, 'ulevel' => $ulevel));
    }

    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->getReqdata($_POST);
        if ($id && $data) {
            if($data['upasswd'] != ""){
                $data['upasswd'] = sha1($data['upasswd']);
            }else{
                unset($data['upasswd']);
            }
            $this->model()->from('user')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update();
        }
        $this->res->redirect($this->dir . 'user');
    }
}