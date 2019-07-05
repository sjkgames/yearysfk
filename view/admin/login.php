<!doctype html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo $title ?>
        </title>
        <link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="/static/admin/app.css" type="text/css" rel="stylesheet">
        <link href="/static/common/datetimepicker.min.css" type="text/css" rel="stylesheet">
        <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
        </script>
        <script src="/static/common/bootstrap.min.js" type="text/javascript">
        </script>
        <script src="/static/common/jquery.zclip.min.js" type="text/javascript">
        </script>
        <script src="/static/common/datetimepicker.min.js" type="text/javascript">
        </script>
        <script src="/static/admin/app.js" type="text/javascript">
        </script>
    </head>
    
    <body>
        <div id="login">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="box">
                            <div class="logo">
                                <span class="glyphicon glyphicon-user">
                                </span>
                            </div>

                            <form class="form-ajax form-horizontal" action="<?php echo $this->dir ?>/login/sigin"
                            method="post" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username"
                                    placeholder="管理账号" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password"
                                    placeholder="登录密码" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="chkcode" id="chkcode" placeholder="验证码"
                                    maxlength="5" required>
                                    <div style="background:#fff;border:1px solid #e5e5e5;border-top:0;padding:5px 0;border-radius:3px;text-align:center">
                                        <img src="/chkcode" onclick="javascript:this.src=this.src+'?t=new Date().getTime()'"
                                        class="imgcode" style="cursor:pointer;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                                        立即登录
                                    </button>
                                </div>
                                <div class="woody-prompt">
                                    <span class="prompt-error">
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>