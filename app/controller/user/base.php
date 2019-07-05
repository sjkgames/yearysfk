<?php
/**
 * Created by 云尚创想(www.yunscx.com).
 * User: Ashang
 * QQ群: 568679748
 * Time: 下午 9:42
 */

namespace YS\app\controller\user;

use YS\app\libs\Controller;

class base extends Controller
{


    public function __construct()
    {
        parent::__construct();
        //如果未登录
        if(!$this->req->session('login_uname')){
            $this->res->redirect('/');
        }

    }

}