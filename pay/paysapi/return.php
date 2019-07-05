<?php
require_once '../inc.php';


$data = $payDao->getReqdata($_GET);

$payDao->res->redirect($payDao->urlbase . $payDao->req->server('HTTP_HOST') . '/chaka?oid=' .$data['orderid']);