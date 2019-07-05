<?php
namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;

class goods extends CheckAdmin
{
    public function index()
    {
        $cid = $this->req->get('cid') ? $this->req->get('cid') : -1;//分类id
        $is_ste = isset($_GET['is_ste']) ? $this->req->get('is_ste') : -1 ;
        $type = isset($_GET['type']) ? $this->req->get('type') : -1 ;
        $gname = $this->req->get('gname');
        $cons = '';
        $consArr = [];
        if($cid >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'g.cid = ?';
            $consArr[] = $cid;
        }
        if($is_ste >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'g.is_ste = ?';
            $consArr[] = $is_ste;
        }

        if($type >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'g.type = ?';
            $consArr[] = $type;
        }
        if($gname){
            $cons .= $cons ? ' and ' : '';
            $cons.= "g.gname like ?";
            $consArr[] = '%' . $gname . '%';;
        }

        $lists = [];
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $totalsize = $this->model()->from('goods g')->where(array('fields' => $cons, 'values' => $consArr))->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('g.*,c.title')->from('goods g')->limit($pagesize)->left('gdclass c')->on('c.id=g.cid')->join()->offset($offset)->where(array('fields' => $cons, 'values' => $consArr))->orderby('g.ord desc')->fetchAll();
        }
        //查询出已卖
        foreach ($lists as &$li) {

            $li['is_ym'] = $this->model()->from('orders')->where(array('fields' => 'gid = ? and status = 3', 'values' => [$li['id']]))->count();

        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?cid='.$cid.'&is_ste='.$is_ste.'&type='.$type.'&gname='.$gname.'&p='));
        $class = $this->model()->select()->from('gdclass')->fetchAll();
        $ulevel = $this->model()->select()->from('ulevel')->fetchAll();
        $search =[
            'cid' => $cid,
            'is_ste' => $is_ste,
            'type' => $type,
            'gname' => $gname
        ];

        $data = array('title' => '商品列表', 'lists' => $lists, 'ulevel' => $ulevel, 'class' => $class, 'pagelist' => $pagelist, 'search' => $search);
        $this->put('goods.php', $data);
    }

    public function typegd()
    {
        $data = $this->getReqdata($_POST) ? $this->getReqdata($_POST) : 0;//分类id
        $lists = $this->model()->select()->from('goods')->where(array('fields' => 'cid=? and type=0', 'values' => array($data['cid'])))->orderby('ord desc')->fetchAll();
        $html = "";
        if($lists){
            foreach ($lists as $v){
                $html .= "<option value=".$v['id'].">".$v['gname']."</option>";
            }
            echo json_encode(array('status' => 1 ,'html' => $html));
            exit;
        }
        echo json_encode(array('status' => 0 ,'html' => $html));
        exit;

    }

    public function save()
    {
        $data = $this->getReqdata($_POST);
        if ($data) {
            if($data['type'] == 0)unset($data['kuc']);

            if ($this->model()->from('goods')->insertData($data)->insert()) {
                $this->res->redirect($this->dir . 'goods');
            }
        }
        $this->res->redirect($this->dir . 'goods');
    }

    public function del()
    {
        $id = $this->req->get('id');
        if ($id) {
            if ($this->model()->from('goods')->where(array('fields' => 'id=?', 'values' => array($id)))->delete()) {
                //如果是自动发卡删除相关卡密
                $this->model()->from('kami')->where(array('fields' => 'gid=?', 'values' => array($id)))->delete();

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
        $data = $this->model()->select()->from('goods')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
        if(!$data)$this->error('商品不存在');
        $class = $this->model()->select()->from('gdclass')->fetchAll();
        $ulevel = $this->model()->select()->from('ulevel')->fetchAll();
        $this->put('editgoods.php', array('title' => '编辑分类', 'data' => $data, 'ulevel' => $ulevel, 'class' => $class));
    }


    public function editsave()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->getReqdata($_POST);
        if ($id && $data) {
            $this->model()->from('goods')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($id)))->update();
        }
        $this->res->redirect($this->dir . 'goods');
    }


}