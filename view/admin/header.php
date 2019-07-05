
    <!doctype html>
    <html>
        
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <title>
                <?php echo isset($title) ? $title. ' - ' : '' ?>
                    <?php echo $this->config['sitename']?>
            </title>
            <link rel="shortcut icon" href="/static/default/favico.ico" />
            <link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
            <link href="/static/admin/app.css" type="text/css" rel="stylesheet">
            <link href="/static/common/datetimepicker.min.css" type="text/css" rel="stylesheet">
            <script src="/static/admin/jquery.min.js"></script>
            <script src="/static/common/bootstrap.min.js" type="text/javascript">
            </script>
            <script src="/static/common/jquery.zclip.min.js" type="text/javascript">
            </script>
            <script src="/static/common/datetimepicker.min.js" type="text/javascript">
            </script>
            <script src="/static/common/layer/layer.js" type="text/javascript">
            </script>
            <script src="/static/admin/app.js" type="text/javascript">
            </script>

        </head>
        
        <body>
            <div style="position:fixed;left:40%;z-index:999">
                <div class="woody-prompt">
                    <div class="prompt-error alert alert-danger">
                    </div>
                </div>
            </div>
            <div id="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-8">
                            <div class="logo">
                                <a href="<?php echo $this->dir?>">
                                    <img src="/static/default/images/logo.png">
                                    &nbsp;
                                    <span class="label label-danger">
                                        管理面板
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-4">
                            <a href="<?php echo $this->dir ?>login/logout" class="hidden-md hidden-lg hidden-xs"
                            style="font-size:2em;float:right;margin-top:15px;margin-left:20px">
                                <span class="glyphicon glyphicon-off">
                                </span>
                            </a>
                            <a href="<?php echo $this->dir ?>set" class="hidden-md hidden-lg" style="font-size:2em;float:right;margin-top:15px;margin-left:20px">
                                <span class="glyphicon glyphicon-cog">
                                </span>
                            </a>
                            <a href="javascript:;" class="hidden-md hidden-lg" id="dropdownMenu" style="font-size:2em;float:right;margin-top:15px">
                                <span class="glyphicon glyphicon-th-large">
                                </span>
                            </a>
                            <div class="nav hidden-xs hidden-sm">
                                <ul>
                                    <li>
                                        <a href="<?php echo $this->dir ?>login/logout">
                                            <span class="glyphicon glyphicon-off">
                                            </span>
                                            &nbsp;登出
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->dir ?>set">
                                            <span class="glyphicon glyphicon-cog">
                                            </span>
                                            &nbsp;系统设置
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="/" target="_blank">
                                            <span class="glyphicon glyphicon-home">
                                            </span>
                                            &nbsp;返回网站
                                        </a>
                                        <span class="v-line">
                                            |
                                        </span>
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false">
                                            账号
                                            <?php echo $this->
                                                session->get('login_adminname')?>&nbsp;
                                                <span class="caret">
                                                </span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="<?php echo $this->dir ?>admins">
                                                    <span class="glyphicon glyphicon-user">
                                                    </span>
                                                    &nbsp;账号列表
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $this->dir ?>pwd">
                                                    <span class="glyphicon glyphicon-lock">
                                                    </span>
                                                    &nbsp;修改密码
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $this->dir ?>logs">
                                                    <span class="glyphicon glyphicon-time">
                                                    </span>
                                                    &nbsp;登陆日志
                                                </a>
                                            </li>
                                            <li role="separator" class="divider">
                                            </li>
                                            <li>
                                                <a href="<?php echo $this->dir ?>mailtpl">
                                                    <span class="glyphicon glyphicon-bookmark">
                                                    </span>
                                                    &nbsp;邮件模板
                                                </a>
                                            </li>
                                            <li role="separator" class="divider">
                                            </li>
                                            <li>
                                                <a href="<?php echo $this->dir ?>login/logout">
                                                    <span class="glyphicon glyphicon-off">
                                                    </span>
                                                    &nbsp;安全退出
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="top-nav" class="hidden-xs hidden-sm">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-2 col-sm-11">
                            <ul>
                                <li<?php echo !isset($this->action[1]) ? ' class="current"' : ''?>>
                                    <a href="<?php echo $this->dir ?>">
                                        管理首页
                                    </a>
                                    </li>
                                    <?php if($this->nav):?>
                                        <?php foreach($this->nav as $key=>$val):?>
                                            <li<?php echo isset($this->action[1]) && $this->action[1]==$key ? ' class="current"' : ''?>>
                                                <a href="<?php echo $this->dir ?><?php echo $key ?>">
                                                    <?php echo $val?>
                                                </a>
                                                </li>
                                                <?php endforeach;?>
                                                    <?php endif;?>
                            </ul>
                        </div>
                        <div class="col-md-1 col-sm-1 text-right btn-config">
                            <a href="<?php echo $this->dir ?>cog">
                                <span class="glyphicon glyphicon-cog">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $('#dropdownMenu').click(function() {
                    if ($('.left-nav').is(':visible')) {
                        $('.left-nav').addClass('hidden-sm hidden-xs').hide();
                    } else {
                        $('.left-nav').removeClass('hidden-sm hidden-xs').show();
                    }
                });
            </script>
            <?php $current=isset($this->
                action[1]) ? $this->action[1] : '';?>
                <div id="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="left-nav hidden-xs hidden-sm">
                                    <dl>
                                        <dt>
                                            <span class="glyphicon glyphicon-cog">
                                            </span>
                                            &nbsp;系统
                                        </dt>
                                        <?php echo $this->
                                            getSubMenu('系统', $current) ?>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <span class="glyphicon glyphicon-th-list">
                                            </span>
                                            &nbsp;订单管理
                                        </dt>
                                        <?php echo $this->
                                            getSubMenu('订单管理',$current) ?>

                                    </dl>
                                    <dl>
                                        <dt>
                                            <span class="glyphicon glyphicon-user">
                                            </span>
                                            &nbsp;用户管理
                                        </dt>
                                        <?php echo $this->
                                        getSubMenu('用户管理',$current) ?>

                                    </dl>
                                    <dl>
                                        <dt>
                                            <span class="glyphicon glyphicon-shopping-cart">
                                            </span>
                                            &nbsp;商品管理
                                        </dt>
                                        <?php echo $this->
                                        getSubMenu('商品管理',$current) ?>

                                    </dl>

                                    <dl>
                                        <dt>
                                            <span class="glyphicon glyphicon-credit-card">
                                            </span>
                                            &nbsp;支付设置
                                        </dt>
                                        <?php echo $this->
                                        getSubMenu('支付设置',$current) ?>

                                    </dl>



                                    <dl class="hidden-md hidden-lg">
                                        <dt>
                                            <span class="glyphicon glyphicon-cog">
                                            </span>
                                            &nbsp;管理员
                                        </dt>
                                        <dd>
                                            <a href="<?php echo $this->dir ?>admins">
                                                <span class="glyphicon glyphicon-user">
                                                </span>
                                                &nbsp;账号列表
                                            </a>
                                        </dd>
                                        <dd>
                                            <a href="<?php echo $this->dir ?>pwd">
                                                <span class="glyphicon glyphicon-lock">
                                                </span>
                                                &nbsp;修改密码
                                            </a>
                                        </dd>
                                        <dd>
                                            <a href="<?php echo $this->dir ?>logs">
                                                <span class="glyphicon glyphicon-time">
                                                </span>
                                                &nbsp;登陆日志
                                            </a>
                                        </dd>
                                        <dd role="separator" class="divider">
                                        </dd>
                                        <dd>
                                            <a href="<?php echo $this->dir ?>mailtpl">
                                                <span class="glyphicon glyphicon-bookmark">
                                                </span>
                                                &nbsp;邮件模板
                                            </a>
                                        </dd>

                                        <dd role="separator" class="divider">
                                        </dd>
                                        <dd>
                                            <a href="<?php echo $this->dir ?>login/logout">
                                                <span class="glyphicon glyphicon-off">
                                                </span>
                                                &nbsp;安全退出
                                            </a>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
	<audio id="musicClick" src="/click.mp3" preload="auto"></audio>
	<script>
		$(function(){
			order_notice();
		})
		function order_notice() {
			$.post("./orders?type=mp3", function(data){
				if(data == 'success') {
					$("#musicClick")[0].play();
				}
				setTimeout(order_notice, 5000);
			});
		}

	</script>
                            <div class="col-md-10">
                                <div class="right-content">