<?php
/**
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 8:26
 */

namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;

class ulevel extends CheckAdmin
{
    public function index()
    {
        $ulevel = $this->model()->select()->from('ulevel')->fetchAll();
        $data = array('title' => '等级列表', 'ulevel' => $ulevel);
        $this->put('ulevel.php', $data);
    }

    public function save()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = isset($_POST) ? $_POST : false;
        if ($data) {
            foreach ($data as $key => $val) {
                $data[$key] = $this->req->post($key);
            }
            if ($this->model()->from('ulevel')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update()) {
                echo json_encode(array('status' => 1, 'msg' => '设置保存成功'));
                exit;
            }
        }
        echo json_encode(array('status' => 0, 'msg' => '设置保存失败'));
        exit;
    }


}