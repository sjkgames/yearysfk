<?php require_once 'header.php' ?>
    <style>
        .bf {
            font-size: 2em
        }

        .main_content .panel {
            text-align: center
        }

        .main_content
        .panel:hover .panel-body {
            background: #f1f1f1
        }

        .main_content .panel .panel-footer {
            color: #fff
        }

        .main_content
        .panel .panel-footer a {
            color: #fff
        }

        .main_content a .bf {
            color: #E43D40
        }

        .main_content
        .panel-info .panel-footer {
            background: #39ABD2;
        }

        .main_content .panel-warning
        .panel-footer {
            background: #FFA600
        }

        .main_content .panel-danger .panel-footer {
            background: #D9534F
        }

        .main_content .panel-success .panel-footer {
            background: #328061
        }
    </style>
    <h3>
        <span class="current">
            管理首页
        </span>
    </h3>
    <br>
    <div class="main_content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir ?>/orders">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $nowDay ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            今日订单数
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a>
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $nowMoney ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            今日营业额
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3  col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir ?>/orders?status=1">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $dcOrder ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            待处理订单
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir ?>/orders?status=3">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $okOrder ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            已完成订单
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir ?>/orders">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $ctOrder ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            总订单
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir ?>/orders">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $ctMoney ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            总营业额
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo $this->dir ?>/goods">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $ctGoods ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            商品数
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a>
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <span class="bf">
                                <?php echo $ctime ?>
                            </span>
                        </div>
                        <div class="panel-footer">
                            运营天数
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <br>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading ">

                <h3 class="panel-title">
                    服务器信息
                </h3>

            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            名称
                        </th>
                        <th>
                            详情
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>系统</td>
                        <td><?php echo PHP_OS ?></td>
                    </tr>
                    <tr>
                        <td>PHP版本</td>
                        <td><?php echo PHP_VERSION ?></td>
                    </tr>
                    <tr>
                        <td>服务器</td>
                        <td><?php echo  $_SERVER["SERVER_SOFTWARE"] ?></td>
                    </tr>

                    <tr>
                        <td>服务端口</td>
                        <td><?php echo  $_SERVER['SERVER_PORT']?></td>
                    </tr>
                    <tr>
                        <td>服务器时间</td>
                        <td><?php echo  date("Y年n月j日 H:i:s")?></td>
                    </tr>
                    <tr>
                        <td>当前ip地址</td>
                        <td><?php echo  $_SERVER['REMOTE_ADDR']?></td>
                    </tr>
                    <tr>
                        <td>php最大运行时间</td>
                        <td><?php echo   ini_get("max_execution_time") ?>秒</td>
                    </tr>
                    <tr>
                        <td>剩余空间</td>
                        <td><?php echo  round((disk_free_space(".")/(1024*1024)),2).'M'?></td>
                    </tr>

                    <tr>
                        <td>交流QQ群</td>
                        <td><a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=d205548c9336cfc7faf4a7cd43af22c53a3c48ea2a6d6a9de0e5d1668359007f"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="云尚软件交流群" title="云尚软件交流群"></a></td>
                    </tr>
                    <tr>
                        <td>当前系统版本</td>
                        <td>周年版</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



<?php require_once 'footer.php' ?>


