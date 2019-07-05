<?php
/**短连接
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 8:51
 */

namespace YS\app\controller;

use YS\app\libs\Controller;

class t extends Controller
{

    public function index()
    {
        $aciton = $this->action;
        $gurl = $aciton[1];
        $class = $this->model()->select()->from('gdclass')->orderby('ord DESC')->fetchAll();
        // 查询有无此商品
        $data = $this->model()->select()->from('goods')->where(array('fields' => 'gurl = ? and is_ste = 1', 'values' => array($gurl)))->fetchRow();
        $data = [
            'class' => $class,
            'gdata' => $data
        ];
        $this->put('index.php', $data);


    }


}