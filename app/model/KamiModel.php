<?php
namespace YS\app\model;

use YS\app\libs\Model;

class KamiModel
{
    function __construct()
    {
        $this->model = new Model();
    }

    /**库存操作
     * @param $knum
     * @param $num
     * @param string $ck
     * @return bool|mixed
     */
    public function kuc($gid,$knum,$num,$ck = '+')
    {
        if($ck == "+"){
            $kuc = $knum+$num;
        }else{
            $kuc = $knum-$num;
        }
        $data['kuc'] = $kuc;
        $res = $this->model->from('goods')->updateSet($data)->where(array('fields' => 'id=?', 'values' => array($gid)))->update();
        return $res;
    }
}