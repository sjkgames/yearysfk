<?php require_once 'head.php' ?>

<link rel="stylesheet" href="/static/default/reg/css/app.css">
<link rel="stylesheet" href="/static/default/reg/css/amazeui.datatables.min.css">
</head>
<body data-type="login" class="theme-white">

<div class="am-g tpl-g">

    <div class="tpl-login">
        <div class="tpl-login-content">
            <div class="tpl-login-title"><?php echo $this->config['sitename'] ?>-用户登录</div>
            <span class="tpl-login-content-info">
                  欢迎光临
            </span>


            <form class="am-form tpl-form-line-form form-ajax" action="/login/doLogin" method="post">

                <div class="am-form-group">
                    <input type="text" name="uname" class="tpl-form-input"  placeholder="用户名/邮箱" required>
                </div>

                <div class="am-form-group">
                    <input type="password" name="upasswd" class="tpl-form-input"  placeholder="请输入密码" required>
                </div>

                <div class="am-form-group tpl-login-remember-me">
                    <label for="remember-me">

                         还没有账号：<a href="/reg">点我注册</a>
                    </label>
                    &nbsp;&nbsp;
                    <label for="remember-me">

                        或者忘了密码：<a href="/reg/repass">点我找回</a>
                    </label>
                </div>






                <div class="am-form-group">

                    <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success tpl-login-btn">登录</button>

                </div>
            </form>
        </div>
    </div>
</div>


</body>

</html>
<?php require_once 'foot.php' ?>
<script>

    function userCheck() {
        layer.open({
            title:'用户注册协议',
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['700px', '500px'], //宽高
            content: $('.userCheckTxt').html()
        });
    }

</script>