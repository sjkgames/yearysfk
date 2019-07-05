<?php

namespace YS\app\controller;

use YS\app\libs\Controller;

class chaka extends Controller
{
    public function index()
    {
        $oid = $this->req->get('oid');
        $order = $this->model()->select()->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($oid)))->fetchRow();

        $this->put('chaka.php',$order);
    }

    /**
     * 查询订单
     */
    public function orderList()
    {
        $data = $this->getReqdata($_POST);
        $cons = '';
        $consArr = [];
        $cons .= $cons ? ' and ' : '';
        $cons .= 'otype = ?';
        $consArr[] = $data['otype'];
        if ($data['otype'] == 0) {
            if (trim($data['otype']) == "") resMsg(0, null, '查询密码不能为空');
            $cons .= ' and chapwd = ?';
            $consArr[] = $data['chapwd'];
        }
        $cons .= ' and account = ?';
        $consArr[] = $data['account'];
        $cons .= ' and status <> 0 ';
        $orders = $this->model()->select()->from('orders')->where(array('fields' => $cons, 'values' => $consArr))->orderby('ctime desc')->fetchAll();
        if (!$orders) resMsg(0, null, '没有查询到订单记录，请检查密码是否正确或是否支付成功！');
        $html = '';
        $orderType = ['自动发卡', '手工订单'];
        $orderStatus = [
            1 => "<span class=\"am-badge am-badge-warning am-radius\">待处理</span>",
            2 => " <span class=\"am-badge am-badge-primary am-radius\">已处理</span>",
            3 => " <span class=\"am-badge am-badge-success am-radius\">已完成</span>",
            4 => " <span class=\"am-badge am-badge-danger am-radius\">处理失败</span>",
            5 => " <span class=\"am-badge am-badge-danger am-radius\">发卡失败</span>",
        ];


        foreach ($orders as $v) {
            $html .= "<tr>
                                <td>" . $v['orderid'] . "</td>
                                <td>" . $v['oname'] . "</td>
                                <td>
                                    <span class=\"am-badge am-badge-success am-radius\">" . $orderType[$v['otype']] . "</span>
                                </td>
                                <td>" . $v['onum'] . "</td>
                                <td>" . $v['omoney'] . "</td>
                                <td>" . $v['cmoney'] . "</td>
                                <td>" . $v['account'] . "</td>
                                <td>

                                    <span class=\"am-badge am-badge-success am-radius\">" . $v['paytype'] . "</span>
                                </td>
                                <td>" . $orderStatus[$v['status']] . "</td>
                                <td class=\"am-hide-sm-only\">" . date('Y-m-d H:i', $v['ctime']) . "</td>
                                <td>
                                    <div class=\"am-btn-toolbar\">
                                        <div class=\"am-btn-group am-btn-group-xs\">
                                            <button onclick=\"orderInfo('" . $v['orderid'] . "')\"
                                                    class=\"am-btn am-btn-default \"><span class=\"am-icon-eye\"></span>订单详情
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
        }
        resMsg(1, $html);

    }

    /**
     * 订单详情
     */
    public function orderInfo()
    {

        $id = $this->req->post('id') ? $this->req->post('id') : 0;
        $data = $this->model()->select()->from('orders')->where(array('fields' => 'orderid=?', 'values' => array($id)))->fetchRow();
        if (!$data) resMsg(0, null, '订单不存在');
        resMsg(1, $data, 'ok');


    }
}