<?php
namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;
use YS\app\model\KamiModel;

class kami extends CheckAdmin
{
    public function index()
    {
        $gid = $this->req->get('gid')?$this->req->get('gid'):-1;//商品id
        $is_ste = isset($_GET['is_ste']) ? $this->req->get('is_ste') : -1 ;
        $kano = $this->req->get('kano') ;
        $cons = '';
        $consArr = [];
        if($gid > 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'k.gid = ?';
            $consArr[] = $gid;
        }
        if($kano != ""){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'k.kano = ?';
            $consArr[] = $kano;
        }
        if($is_ste >= 0){
            $cons .= $cons ? ' and ' : '';
            $cons.= 'k.is_ste = ?';
            $consArr[] = $is_ste;
        }
        $lists = [];
        $page = $this->req->get('p');
        $page = $page ? $page : 1;
        $pagesize = 20;
        $totalsize = $this->model()->from('kami k')->where(array('fields' => $cons, 'values' => $consArr))->count();
        if ($totalsize) {
            $totalpage = ceil($totalsize / $pagesize);
            $page = $page > $totalpage ? $totalpage : $page;
            $offset = ($page - 1) * $pagesize;
            $lists = $this->model()->select('k.*,g.gname')->from('kami k')->limit($pagesize)->left('goods g')->on('k.gid=g.id')->join()->offset($offset)->where(array('fields' => $cons, 'values' => $consArr))->orderby('k.ctime desc')->fetchAll();
        }
        $pagelist = $this->page->put(array('page' => $page, 'pagesize' => $pagesize, 'totalsize' => $totalsize, 'url' => '?gid='.$gid.'&is_ste='.$is_ste.'&kano='.$kano.'&p='));
        $class = $this->model()->select()->from('goods')->where(array('fields' => 'type = 0'))->fetchAll();
        $search =[
            'gid' => $gid,
            'kano' => $kano,
            'is_ste' => $is_ste
        ];
        $gclass = $this->model()->select()->from('gdclass')->fetchAll();

        $data = array('title' => '卡密列表', 'lists' => $lists, 'class' => $class,'gclass'=>$gclass, 'pagelist' => $pagelist, 'search' => $search);
        $this->put('kami.php', $data);

    }

    /**
     * 导出卡密
     */
    public function import()
    {
        $gid = $this->req->get('gid');
        $lists = $this->model()->select()->from('kami k')->where(array('fields' => 'gid = ? AND is_ste = 0', 'values' => [$gid]))->orderby('k.ctime desc')->fetchAll();
        if(!$lists) exit('库存卡密数量为0');
        $word = "";
        $filename = date('Ymd').rand(100000,999999).".txt";
        Header( "Content-type:   application/octet-stream ");
        Header( "Accept-Ranges:   bytes ");
        header( "Content-Disposition:   attachment;   filename=".$filename);
        header( "Expires:   0 ");
        header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ");
        header( "Pragma:   public ");
        foreach ($lists as $li) {
            echo $li['kano']."\r\n";
        }
        //file_put_contents('./upload/kamitxt/'.$filename, $word);

    }

    /**
     * 导入卡密
     */
    public function impka()
    {
        $data = $this->getReqdata($_POST);
        $goods = $this->model()->select()->from('goods')->where(array('fields' => 'id=?', 'values' => array($data['gid'])))->fetchRow();
        if (!$goods)$this->error('商品不存在');
        $kami = trim($data['kamicont']);
        $kamiList = [];
        if(!empty($_FILES['file']['tmp_name'])) {
            $upload = new \Dj\Upload();
            $upload->mime = [
                'text/plain',
            ];
            $filelist = $upload->save('./upload/kamitxt');
            if(is_array($filelist)){
                $filedata = file_get_contents($filelist['url']);
                // 删除文件
                unlink($filelist['url']);
            }else{
                # 如果返回负整数(int)就是发生错误了
                $error_msg = [-1=>'上传失败',-2=>'文件存储路径不合法',-3=>'上传非法格式文件',-4=>'文件大小不合符规定',-5=>'token验证错误'];
                echo $error_msg[$filelist];
            }
            if($filedata){
                $kami = $filedata;
            }
        }
        if (!$kami) $this->error('请填写或上传卡密');
        $ka_arr = explode("\r\n", $kami);
        //新版算法
        foreach ($ka_arr as $key => $v) {
            if($v != ""){
                $kamiList[$key]['kano'] = $v;
                $kamiList[$key]['gid'] = $goods['id'];
                $kamiList[$key]['ctime'] = time();
            }
        }
            //老版算法
        /*foreach ($ka_arr as $key => $v) {
            $kamiList[$key]['gid'] = $goods['id'];
            $kamiList[$key]['ctime'] = time();
            if (strstr($v, '----')) {
                $cstr = explode('----', $v);
                $kamiList[$key]['kano'] = $cstr[0];
                $kamiList[$key]['kapwd'] = $cstr[1];
            } else {
                $kamiList[$key]['kano'] = $v;
            }
        }*/
        //去重
        if($data['checkm'] == 1){
            $kamiList = array_unique($kamiList, SORT_REGULAR);
        }
        if(!$kamiList)$this->error('导入失败，请检查卡密格式');
        $config = $this->setConfig;
        //拼接sql
        $sql = "INSERT INTO ".$config::db()['prefix']."kami(`gid`,`kano`,`ctime`) VALUES";
        foreach ($kamiList as $v){
            $sql.="('".$v['gid']."','".$v['kano']."',".$v['ctime']."),";
        }
        echo $sql;
        $sql = trim($sql,',');
        $res = $this->model()->query($sql);
        if ($res) {
            //更新库存
            $kamdl = new KamiModel();
            $kamdl->kuc($goods['id'],$goods['kuc'],count($kamiList));
            $this->res->redirect($this->dir . 'kami');
        } else {
            $this->error('导入失败');

        }
    }

    public function delall()
    {
        $ids = $this->req->post('ids');
        $idsarr = explode(',',$ids);
        foreach ($idsarr as $id)
        {
            $this->del($id);
        }
        echo json_encode(array('status' => 1));exit;

    }

    public function del($cid = "")
    {
        $id = $cid? $cid : $this->req->get('id');
        if ($id) {
            $kami = $this->model()->select()->from('kami')->where(array('fields' => 'id=?', 'values' => array($id)))->fetchRow();
            if ($this->model()->from('kami')->where(array('fields' => 'id = ?', 'values' => array($id)))->delete()) {
                if($kami && $kami['is_ste'] == 0){
                    //减去库存
                    $goods = $this->model()->select()->from('goods')->where(array('fields' => 'id=?', 'values' => array($kami['gid'])))->fetchRow();
                    $gdata['kuc'] = $goods['kuc'] - 1;
                    $this->model()->from('goods')->updateSet($gdata)->where(array('fields' => 'id = ?', 'values' => array($goods['id'])))->update();
                }
                if(!$cid){
                    echo json_encode(array('status' => 1));
                    exit;
                }
            }
        }
        if(!$cid) {
            echo json_encode(array('status' => 0));
            exit;
        }
    }

}