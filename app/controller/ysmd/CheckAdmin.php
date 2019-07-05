<?php
namespace YS\app\controller\ysmd;

use YS\app\libs\Controller;
use YS\app\Config;

class CheckAdmin extends Controller
{
    public $dir = '/ysmd/';
    public $action;
    function __construct()
    {
        parent::__construct();
        $this->tpl = 'view/admin/';
        if (!isset($this->action[1]) || isset($this->action[1]) && $this->action[1] != 'login' && $this->action[1] != 'sigin') {
            if (!$this->session->get('login_adminname')) {
                $this->res->redirect($this->dir . 'login');
            }
        }
        $this->setConfig = new Config();
        $this->nav = $this->model()->select()->from('navcog')->fetchRow();
        $this->nav = $this->nav ? json_decode($this->nav['content']) : array();
        if ($this->session->get('login_adminname')) {
            $limits = $this->model()->select('limits')->from('admin')->where(array('fields' => 'adminname=?', 'values' => array($this->session->get('login_adminname'))))->fetchRow();
            if (!$limits) {
                $this->res->redirect($this->dir . 'logout');
                exit;
            }
            $limits = json_decode($limits['limits'], true);
            $limits += array('login' => '安全退出');
            if (isset($this->action[1]) && !array_key_exists($this->action[1], $limits)) {
                $this->put('ysapp.php', array('title' => '无权限操作', 'msg' => '当前您没有此权限'));
                exit;
            }
        }
    }
    public function menu()
    {
        return [
            '系统' => [
                'set' => '系统设置',
                'mailtpl' => '邮件模版',
                'admins' => '管理员列表',
                'pwd' => '修改密码',
                'logs' => '登录日志',
                'set' => '系统设置',
                'cog' => '导航设置',
            ],
            '用户管理' => [
                'user' => '用户列表',
                'ulevel' => '用户级别',
            ],
            '订单管理' => [
                'orders' => '订单列表'
            ],
            '商品管理' => [
                'gdclass' => '商品分类',
                'goods' => '商品列表',
                'kami' => '卡密管理'
            ],
            '支付设置' => [
                'acp' => '接入信息',

            ],
        ];

    }

    public function getSubMenu($menu, $cur = '')
    {
        $list = '';
        if (array_key_exists($menu, $this->menu())) {
            foreach ($this->menu()[$menu] as $key => $val) {
                $current = isset($cur) && $cur == $key ? ' class="current"' : '';
                $list .= '<dd' . $current . '><a href="' . $this->dir . $key . '">' . $val . '</a></dd>';
            }
        }
        return $list;
    }



    /**
     * 错误提示
     */
    protected function error($msg,$title = '错误提示')
    {
        $this->put('ysapp.php', array('title' => $title, 'msg' => $msg));
        exit;
    }
}
?>