<?php require_once 'head.php' ?>
<link rel="stylesheet" href="/static/default/assets/css/admin.css">
<link rel="stylesheet" href="/static/default/assets/css/app.css">
</head>
<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">

        <div class="tpl-logo">
            <?php echo $this->config['sitename'] ?> <i class="am-icon-skyatlas"></i>

        </div>

    </div>
    <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right" onclick="navHover()">

    </div>


    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">

            <?php if ($this->req->session('login_uname')):?>
                <li class="am-dropdown" data-am-dropdown="" data-am-dropdown-toggle="">
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-user"></span>等级：<?php echo $this->req->session('login_ulevel').'('.$this->req->session('login_uname').')' ?>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="/user/sett"><span class="am-icon-bell-o"></span> 资料</a></li>
                        <li><a href="javascript:;" onclick="repwd()"><span class="am-icon-cog"></span> 修改密码</a></li>
                        <li><a href="/login/logout"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
            <?php else: ?>

                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="tpl-header-list-link" href="/login">
                        <span class="am-icon-user"></span> 登录
                    </a>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="tpl-header-list-link" href="/reg">
                        <span class="am-icon-cog"></span> 注册
                    </a>
                </li>

            <?php endif;?>

            <li class="am-hide-sm-only">
                <a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link">
                    <span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span>
                </a>
            </li>

        </ul>
    </div>
</header>