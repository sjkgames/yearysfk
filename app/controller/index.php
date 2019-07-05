<?php

namespace YS\app\controller;

use YS\app\libs\Controller;

/**首页控制器
 * Class index
 * @package YS\app\controller
 */
class index extends Controller
{
    public function index()
    {
        $class = $this->model()->select()->from('gdclass')->orderby('ord DESC')->fetchAll();
        $data = [
            'class' => $class,
        ];
        $this->put('index.php', $data);
    }

    public function typegd()
    {
        $data = $this->getReqdata($_POST) ? $this->getReqdata($_POST) : 0;//分类id
        $lists = $this->model()->select()->from('goods')->where(array('fields' => 'cid=? and is_ste = 1', 'values' => array($data['cid'])))->orderby('ord desc')->fetchAll();
        $html = "";
        if ($lists) {
            foreach ($lists as $v) {
                if($v['gpasswd'] != ""){
                    $pyes = 'yes';
                }
                $html .= "<option value=" . $v['id'] . " data-pwd=".$pyes.">" . $v['gname'] . "</option>";
            }
            echo json_encode(array('status' => 1, 'html' => $html));
            exit;
        }
        echo json_encode(array('status' => 0, 'html' => $html));
        exit;
    }

    public function getGoodsInfo()
    {
        $id = $this->req->post('id');
        $pass = $this->req->post('pass');
        $data = $this->model()->select()->from('goods')->where(array('fields' => 'id=? and is_ste = 1', 'values' => array($id)))->fetchRow();
        if (!$data) resMsg(0,null,'商品不存在');
        if($data['gpasswd'] && $data['gpasswd'] != $pass) resMsg(0,null,'商品密码错误');
        //判断是否是自动发卡
        if ($data['type'] == 0) {
            $html = "<div class=\"am-form-group ajaxdiv\">
                                      <label for=\"account\" class=\"am-u-sm-2 am-form-label\">邮箱</label>
                                        <div class=\"am-u-sm-10\">
                                            <input type=\"text\" id=\"account\" class=\"am-form-field am-round\"
                                                 placeholder=\"请仔细输入正确邮箱，接收卡密使用\"   value=\"".$this->session->get('login_uemail')."\">
                                        </div>
                     </div>
                     <div class=\"am-form-group ajaxdiv\">
                                        <label for=\"chapwd\" class=\"am-u-sm-2 am-form-label\">查询密码</label>
                                        <div class=\"am-u-sm-10\">
                                            <input type=\"text\" id=\"chapwd\" class=\"am-form-field am-round\"
                                                placeholder=\"请仔细查询密码，作为查询重要依据\"    value=\"\">
                                        </div>
                                    </div>";

        }else{
            //手工订单
            $html = "<div class=\"am-form-group ajaxdiv\"><label for=\"account\" class=\"am-u-sm-2 am-form-label\">".$data['onetle']."</label>
                                        <div class=\"am-u-sm-10\">
                                            <input type=\"text\" id=\"account\" class=\"am-form-field am-round\"
                                                    value=\"\">
                                        </div>
                     </div>";
            $ripu = explode(',',$data['gdipt']);
            if($ripu[0]){
                $ipu = 1;
                foreach ($ripu as $v){
                    $html.="<div class=\"am-form-group ajaxdiv\"><label for=\"ipu".$ipu."\" class=\"am-u-sm-2 am-form-label\">".$v."</label>
                                        <div class=\"am-u-sm-10\">
                                            <input type=\"text\" id=\"ipu".$ipu."\" class=\"am-form-field am-round\"
                                                    value=\"\">
                                        </div>
                     </div>";
                    $ipu = $ipu+1;
                }

            }
        }
        // 如果用户登录，显示对比差价
        if ($this->session->get('login_uid')) {
            switch ($this->session->get('login_ulid')){
                case 1:
                    $dlsj = $data['onemoney'];
                    break;
                case 2:
                    $dlsj = $data['twomoney'];
                    break;
                case 3:
                    $dlsj = $data['smoney'];
                    break;
            }
            $data['gmoney'] = '原价：'.$data['gmoney'].'￥，进阶：'.$dlsj.'￥';
        }
        // 删除敏感金额
        unset($data['onemoney']);
        unset($data['twomoney']);
        unset($data['smoney']);
        $res = [
            'info' => $data,
            'html' => $html
        ];
        resMsg(1, $res);
    }

    /**
     * 提交订单
     */
    public function postOrder()
    {
        $post = $this->getReqdata($_POST);
        $post['number'] = intval($post['number']);
        if($post['gid'] =="" || intval($post['number']) <=0 || $post['account'] == ""){
            resMsg(0,null,'充值账号、数量、商品不能为空，请仔细填写');
        }
        $goods = $this->model()->select()->from('goods')->where(array('fields' => 'id=?', 'values' => array($post['gid'])))->fetchRow();
        if(!$goods || $goods['is_ste'] == 0) resMsg(0,null,'商品不存在或已下架');
        if($goods['kuc'] < $post['number'])resMsg(0,null,'库存不足');
        if($goods['gpasswd'] && $goods['gpasswd'] != $post['gpass']) resMsg(0,null,'商品密码错误');
        /**
         * 自动发卡
         */
        if($goods['type'] == 0){
            if($post['chapwd'] == ""){
                resMsg(0,null,'查询密码不能为空');
            }
            if(!filter_var($post['account'],FILTER_VALIDATE_EMAIL)){
                resMsg(0,null,'邮箱格式错误，未确保能够收到邮件提醒请仔细填写');
            }
            $orderid = $this->zdOrder($post,$goods);
        }else{
            $ripu = explode(',',$goods['gdipt']);
            $ctnum = $ripu[0] != "" ?count($ripu):0;
            if($ctnum >0){
                if(trim($post['ipu1']) == "")resMsg(0,null,$ripu[0].'不能为空');
            }
            if($ctnum >1){
                if(trim($post['ipu2']) == "")resMsg(0,null,$ripu[1].'不能为空');
            }
            if($ctnum >2){
                if(trim($post['ipu3']) == "")resMsg(0,null,$ripu[2].'不能为空');
            }
            if($ctnum >3){
                if(trim($post['ipu4']) == "")resMsg(0,null,$ripu[3].'不能为空');
            }
            $orderid = $this->sgOrder($post,$goods);

        }

        $html = "<div class=\"am-form-group\" id=\"sgoktips\">
                <div class=\"am-alert am-alert-success\"><strong>订单保存成功，请点击以下方式在线付款：</strong></div>
                </div>
                <div class=\"am-form-group\">
                <div class=\"am-u-sm-12 am-u-sm-push-2\">";
        /**
         * 支付方式选择
         */
        $payset = $this->model()->select()->from('acp')->where(array('fields' => ' is_ste > 0', 'values' => array()))->fetchAll();

        if($payset){
            foreach ($payset as $v){
                switch ($v['code']){
                    case 'zcyzf':
                        $html.= " <a  href=\"/pay/index?id=".$orderid."&type=alipay&paycode=".$v['code']."\" class=\"am-btn am-btn-warning am-round am-icon-credit-card-alt\">支付宝</a>
                    <a  href=\"/pay/index?id=".$orderid."&type=wxpay&paycode=".$v['code']."\" class=\"am-btn am-btn-success am-round am-icon-wechat\">微信支付</a>
                    <a  href=\"/pay/index?id=".$orderid."&type=qqpay&paycode=".$v['code']."\" class=\"am-btn am-btn-default am-round am-icon-qq\">QQ支付</a>";
                        break;
                    case 'zfbf2f':
                        $html.= "<a  href=\"/pay/index?id=".$orderid."&type=alipay&paycode=".$v['code']."\" class=\"am-btn am-btn-warning am-round am-icon-credit-card-alt\">支付宝当面付</a>";
                        break;
                    case 'paysapi':
                        $html.= "<a  href=\"/pay/index?id=".$orderid."&type=1&paycode=".$v['code']."\" class=\"am-btn am-btn-warning am-round am-icon-credit-card-alt\">支付宝扫码</a>
                    <a target='_blank' href=\"/pay/index?id=".$orderid."&type=2&paycode=".$v['code']."\" class=\"am-btn am-btn-success am-round am-icon-wechat\">微信扫码</a>";
                        break;
                    case 'mazf':
                        $html.= " <a  href=\"/pay/index?id=".$orderid."&type=1&paycode=".$v['code']."\" class=\"am-btn am-btn-warning am-round am-icon-credit-card-alt\">支付宝</a>
                    <a  href=\"/pay/index?id=".$orderid."&type=3&paycode=".$v['code']."\" class=\"am-btn am-btn-success am-round am-icon-wechat\">微信支付</a>
                    <a  href=\"/pay/index?id=".$orderid."&type=2&paycode=".$v['code']."\" class=\"am-btn am-btn-default am-round am-icon-qq\">QQ支付</a>";
                        break;
                    case 'alipay':
                        $html.= "<a  href=\"/pay/index?id=".$orderid."&type=alipay&paycode=".$v['code']."\" class=\"am-btn am-btn-warning am-round am-icon-credit-card-alt\">支付宝即时到账</a>";
                        break;
                }
            }
        }
        $html.= "</div>         
            </div>";



        resMsg(1,$html,'下单成，请支付！');

    }
    public function sgOrder($data,$goods)
    {
        if($goods['checks'] == 0){
            $check =[$data['account'],$goods['id']];
            //检测重复下单
            $order = $this->model()->select()->from('orders')->where(array('fields' => 'account = ? AND gid = ? AND ( `status` > 0 AND `status` <> 4  )', 'values' => $check))->fetchRow();
            if($order)resMsg(0,null,'本商品限制重复下单，一号一次');
        }
        $info = $goods['onetle'].':'.$data['account'];
        $ripu = explode(',',$goods['gdipt']);
        $index = 1;
        foreach ($ripu as $value){
            if($value!=""){
                $info.="<br/> ".$value.':'.$data['ipu'.$index];
                $index = $index+1;
            }
        }
        // 如果用户登录，则为代理价
        if ($this->session->get('login_uid')) {
            switch ($this->session->get('login_ulid')){
                case 1:
                    $goods['gmoney'] = $goods['onemoney'];
                    break;
                case 2:
                    $goods['gmoney'] = $goods['twomoney'];
                    break;
                case 3:
                    $goods['gmoney'] = $goods['smoney'];
                    break;
            }
        }
        $inadd = [
            'orderid' =>$this->res->getOrderID(),
            'oname' => $goods['gname'].'x'.$data['number'],
            'uid' => $this->session->get('login_uid') ? $this->session->get('login_uid') : '',
            'uname' => $this->session->get('login_uname') ? $this->session->get('login_uname').'('.$this->session->get('login_ulevel').')' : '',
            'gid' => $goods['id'],
            'omoney' => $goods['gmoney'],
            'onum' => $data['number'],
            'cmoney' => $goods['gmoney'] * $data['number'],
            'chapwd' => $data['chapwd'],
            'account' => $data['account'],
            'otype' => 1,
            'ctime' => time(),
            'status' => 0,
            'info' => $info
        ];
        $addres = $this->model()->from('orders')->insertData($inadd)->insert();
        if($addres){
            if($goods['gmoney'] == 0){
                resMsg(2,null,'下单成功！');
            }
            return $inadd['orderid'];
        }
        resMsg(0,null,'下单失败！');

    }

    /**自动发卡
     * @param $data
     * @param $goods
     */
    private function zdOrder($data,$goods)
    {
        // 如果用户登录，则为代理价
        if ($this->session->get('login_uid')) {
            switch ($this->session->get('login_ulid')){
                case 1:
                    $goods['gmoney'] = $goods['onemoney'];
                    break;
                case 2:
                    $goods['gmoney'] = $goods['twomoney'];
                    break;
                case 3:
                    $goods['gmoney'] = $goods['smoney'];
                    break;
            }
        }
        $inadd = [
            'orderid' =>$this->res->getOrderID(),
            'oname' => $goods['gname'].'x'.$data['number'],
            'uid' => $this->session->get('login_uid') ? $this->session->get('login_uid') : 0,
            'uname' => $this->session->get('login_uname') ? $this->session->get('login_uname').'('.$this->session->get('login_ulevel').')' : '',
            'gid' => $goods['id'],
            'omoney' => $goods['gmoney'],
            'onum' => $data['number'],
            'cmoney' => $goods['gmoney'] * $data['number'],
            'chapwd' => $data['chapwd'],
            'account' => $data['account'],
            'otype' => 0,
            'ctime' => time(),
            'status' => 0
        ];
        $addres = $this->model()->from('orders')->insertData($inadd)->insert();
        if($addres){
            if($goods['gmoney'] == 0){
                resMsg(2,null,'下单成功！');
            }
            return $inadd['orderid'];
        }
        resMsg(0,null,'下单失败！');

    }

}