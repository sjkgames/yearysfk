<?php
namespace YS\app\libs;

use YS\app\ysapp;
use YS\app\libs\Router;
use YS\app\libs\Req;
use YS\app\libs\Res;
use YS\app\libs\Page;
use YS\app\libs\Session;
use YS\app\controller\chkcode;
use YS\app\libs\Model;
use YS\app\Config;
use YS\app\model\Verifyuser;

class Controller
{
    public $data;
    public $tpl = 'view/default/';
    function __construct()
    {
        $this->router = new Router();
        $this->req = new Req();
        $this->res = new Res();
        $this->page = new Page();
        $this->session = new Session();
        $this->chkcode = new chkcode();
        $this->config = $this->model()->select()->from('config')->fetchRow();
        $this->action = $this->router->put();
        $this->setConfig = new Config();
        $this->verifyUser = new Verifyuser();
        $this->urlbase =  strcasecmp($_SERVER['HTTPS'],"ON")==0?"https://":"http://";
    }
    public function model()
    {
        return new Model();
    }
    public function put($file, $data = array())
    {
        if ($data) {
            extract($data);
        }
        if (!file_exists($this->tpl . $file)) {
            $file = 'ysapp.php';
        }
        require_once $this->tpl . $file;
        $content = ob_get_contents();
        ob_get_clean();
        echo $content;
        if (ob_get_level()) {
            ob_end_flush();
        }
    }
    /**获取所有数组
     * @return array
     */
    public function getReqdata($mod)
    {
        $data = array();
        if (isset($mod)) {
            foreach ($mod as $key => $val) {
                $data[$key] = $this->req->request($key);
            }
        }
        return $data;
    }
}
?>