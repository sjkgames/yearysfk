<?php

namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;

class gdclass extends CheckAdmin
{

    public function index()
    {
        $data = array('title' => '商品分类');
        $lists = $this->model()->select()->from('gdclass')->fetchAll();
        $data += array('lists' => $lists);
        $this->put('gdclass.php', $data);
    }

    public function save()
    {
        $data = $this->getReqdata($_POST);
        if ($data) {
            if ($this->model()->from('gdclass')->insertData($data)->insert()) {
                $this->res->redirect($this->dir . 'gdclass');
            }
        }
        $this->res->redirect($this->dir . 'gdclass');
    }

    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('gdclass')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                echo json_encode(array('status' => 1));
                exit;
            }
        }
        echo json_encode(array('status' => 0));
        exit;
    }

    public function edit()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('gdclass')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        if(!$data)$this->error('分类不存在');
        $this->put('editgdclass.php', array('title' => '编辑分类', 'data' => $data));
    }

    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->getReqdata($_POST);
        if ($id && $data) {
            $this->model()->from('gdclass')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update();
        }
        $this->res->redirect($this->dir . 'gdclass');
    }

}