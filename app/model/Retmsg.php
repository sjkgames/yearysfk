<?php
namespace YS\app\model;

use YS\app\Config;

class Retmsg
{
    function __construct()
    {
        $this->setConfig = new Config();
    }
    public function put($code, $data_type = false)
    {
        return $data_type ? json_encode(array('status' => $code, 'msg' => $this->setConfig->retMsg($code))) : $code . ',' . $this->setConfig->retMsg($code);
    }
}