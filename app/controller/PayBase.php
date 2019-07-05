<?php
namespace YS\app\controller;


use YS\app\libs\Controller;

class PayBase extends Controller
{
    public $order;
    public $acp;

    /**检查订单并返回订单信息
     * @param $id
     * @return bool|mixed
     */
    public function checkOrder($id,$ismsg = 1)
    {
        $this->order = $this->model()->select()->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($id)))->fetchRow();
        if((!$this->order || $this->order['status'] > 0) && $ismsg == 1)exit('订单不存在或已支付！');
        return $this->order;
    }

    /**获取支付参数
     * @param $code
     * @return bool|mixed
     */
    public function checkAcp($code)
    {
        $this->acp = $this->model()->select()->from('acp')->where(array('fields' => 'code=?', 'values' => array($code)))->fetchRow();
        if(!$this->acp || $this->acp['userid']== "" || $this->acp['userkey']== "")exit('平台未配置支付参数，请联系管理员');
        return $this->acp;
    }


    public function updateOrder($orderid,$type,$paysid)
    {
        $order = $this->checkOrder($orderid,2);
        if($order['status'] > 0) return true;
        $data['status'] = 1;
        $data['payid'] = $paysid;
        $data['paytype'] = $type;
        /**
         * 自动发卡 获取卡密到订单信息 然后去掉库存 改变卡密状态
         */
        if($order['otype'] == 0){
            $kami = $this->model()->select()->from('kami')->limit($order['onum'])->where(array('fields' => ' `gid` = '.$order['gid'].' AND `is_ste` = 0', 'values' => ''))->fetchAll();
            $info = '';
            $ids = '';
            if(!$kami){
                $data['status'] = 5;
            }else{
                $data['status'] = 3;
                foreach ($kami as $v){
                    $ids.= $v['id'].',';
                    $info .= $v['kano']."<br/>";
                }
                $data['info'] = $info;
                //设置卡密过期
                $config = $this->setConfig;
                //拼接sql
                $sql = "UPDATE ".$config::db()['prefix']."kami SET `is_ste` = 1 WHERE `id` IN (".trim($ids,',').")";
                $res = $this->model()->query($sql);
                //减去库存
                $goods = $this->model()->select()->from('goods')->where(array('fields' => 'id = ?', 'values' => array($order['gid'])))->fetchRow();
                $gdata['kuc'] = ($goods['kuc'] - $order['onum']);
                $this->model()->from('goods')->updateSet($gdata)->where(array('fields' => 'id = ?', 'values' => array($goods['id'])))->update();

            }
        }
        $status = $this->model()->from('orders')->updateSet($data)->where(array('fields' => 'orderid = ?', 'values' => array($orderid)))->update();
        if($status)
        {
            // 累计消费
            if($order['uid']){
                $user = $this->model()->select()->from('user')->where(array('fields' => 'id = ? ', 'values' => [$order['uid']]))->fetchRow();
                $ctMoney['ctmoney'] = $user['ctmoney'] + $order['cmoney'];
                $this->model()->from('user')->updateSet($ctMoney)->where(array('fields' => 'id = ?', 'values' => array($order['uid'])))->update();
            }

            if($this->config['email_state'] == 1){
                $this->sendEmail($order['account'],$order,$data['info']);
            }
            return true;
        }else{
            return false;
        }

    }


    /**邮件发送
     * @param $email
     * @param $order
     */
    private function sendEmail($email,$order,$info = '')
    {
        //自动发卡通知
        if($order['otype'] == 0){
            $mailtpl = $this->model()->select()->from('mailtpl')->where(array('fields' => 'is_state=? and cname=?', 'values' => array(0, '卡密发送')))->fetchRow();
            $mdata = [
                'sitename' => $this->config['sitename'],
                'gname' => $order['oname'],
                'orid' => $order['orderid'],
                'ornum' => $order['onum'],
                'cmoney' => $order['cmoney'],
                'ctime' => date('Y-m-d H:i',$order['ctime']),
                'orderinfo' => $info,
                'siteurl' => $this->config['siteurl']
            ];
            $newData = $this->res->replaceMailTpl($mailtpl, $mdata);
            $subject = array('title' => $newData['title'], 'email' => $email, 'content' => $newData['content']);
            $this->res->sendMail($subject, $this->config);
        }else{
            $mailtpl = $this->model()->select()->from('mailtpl')->where(array('fields' => 'is_state=? and cname=?', 'values' => array(0, '管理员通知')))->fetchRow();
            $mdata = [
                'sitename' => $this->config['sitename'],
                'gname' => $order['oname'],
                'orid' => $order['orderid'],
                'ornum' => $order['onum'],
                'cmoney' => $order['cmoney'],
                'ctime' => date('Y-m-d H:i',$order['ctime']),
                'siteurl' => $this->config['siteurl']
            ];
            $newData = $this->res->replaceMailTpl($mailtpl, $mdata);
            $subject = array('title' => $newData['title'], 'email' => $this->config['email'], 'content' => $newData['content']);
            $this->res->sendMail($subject, $this->config);
        }


    }


}