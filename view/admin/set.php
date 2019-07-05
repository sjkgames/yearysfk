<?php require_once 'header.php' ?>
    <style>
        .form-ajax>.form-group>.col-md-6{color:#6B6D6E;font-size:0.9em;line-height:
        30px}.form-ajax>.form-group>.col-md-2{color:#6B6D6E;}
    </style>
    <script charset="utf-8" src="/view/editor/kindeditor-min.js">
    </script>
    <script charset="utf-8" src="/view/editor/lang/zh_CN.js">
    </script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="tips"]', {
                allowFileManager: false,
            });
        });
    </script>
    <h3>
        <span class="current">
            系统设置
        </span>
        &nbsp;/&nbsp;
        <span>
            邮件服务器
        </span>
        &nbsp;/&nbsp;
        <span>
            公告设置
        </span>
        &nbsp;/&nbsp;
        <span>
            库存告警策略
        </span>
        &nbsp;/&nbsp;
        <span>
            注册设置
        </span>

    </h3>
    <br>
    <div class="set set0">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="sitename" class="col-md-2 control-label">
                    站点名称：
                </label>
                <div class="col-md-6">
                    <input type="text" name="sitename" id="sitename" class="form-control"
                    value="<?php echo $this->config['sitename']?>">
                </div>
                <span class="col-md-4">
                    网站title
                </span>
            </div>
            <div class="form-group">
                <label for="siteinfo" class="col-md-2 control-label">
                    站点简介：
                </label>
                <div class="col-md-6">
                    <input type="text" name="siteinfo" id="siteinfo" class="form-control"
                    value="<?php echo $this->config['siteinfo']?>">
                </div>
                <span class="col-md-4">
                    显示在网站title后面
                </span>
            </div>
            <div class="form-group">
                <label for="siteurl" class="col-md-2 control-label">
                    站点网址：
                </label>
                <div class="col-md-6">
                    <input type="text" name="siteurl" id="siteurl" class="form-control" value="<?php echo $this->config['siteurl']?>">
                </div>
            </div>

            <div class="form-group">
                <label for="keyword" class="col-md-2 control-label">
                    网站关键字：
                </label>
                <div class="col-md-6">
                    <input type="text" name="keyword" id="keyword" class="form-control" value="<?php echo $this->config['keyword']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-md-2 control-label">
                    网站介绍：
                </label>
                <div class="col-md-6">
                    <textarea name="description" id="description" class="form-control" rows="5"><?php echo $this->config['description']?></textarea>
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="ctime" class="col-md-2 control-label">
                    建站时间：
                </label>
                <div class="col-md-6">
                    <input type="date" name="ctime" id="ctime" class="form-control" value="<?php echo $this->config['ctime']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-2 control-label">
                    客服邮箱：
                </label>
                <div class="col-md-6">
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $this->config['email']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="tel" class="col-md-2 control-label">
                    客服电话：
                </label>
                <div class="col-md-6">
                    <input type="text" name="tel" id="tel" class="form-control" value="<?php echo $this->config['tel']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="qq" class="col-md-2 control-label">
                    客服QQ：
                </label>
                <div class="col-md-6">
                    <input type="text" name="qq" id="qq" class="form-control" value="<?php echo $this->config['qq']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="links" class="col-md-2 control-label">
                    友情链接：
                </label>
                <div class="col-md-4">
                    <textarea name="links" style="width:100%;height:200px;"><?php echo $this->config['links']?></textarea>
                </div>
                <span class="col-md-6">
                </span>
            </div>

            <div class="form-group">
                <label for="webcopy" class="col-md-2 control-label">
                    版权：
                </label>
                <div class="col-md-4">
                    <textarea name="webcopy" style="width:100%;height:200px;"><?php echo $this->config['webcopy']?></textarea>
                </div>
                <span class="col-md-6">
                </span>
            </div>

            <div class="form-group">
                <label for="icpcode" class="col-md-2 control-label">
                    ICP备案号：
                </label>
                <div class="col-md-6">
                    <input type="text" name="icpcode" id="icpcode" class="form-control" value="<?php echo $this->config['icpcode']?>">
                </div>
                <span class="col-md-4">
                </span>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                    统计代码：
                </label>
                <div class="col-md-6">
                    <textarea name="stacode" id="stacode" class="form-control" rows="5"><?php echo $this->config['stacode']?></textarea>
                </div>
                <span class="col-md-4">
                </span>
            </div>

            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-4">
                </span>
            </div>
        </form>
    </div>

    <div class="set set1 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
        method="post" autocomplete="off">
            <div class="form-group">
                <label for="smtp_server" class="col-md-2 control-label">
                    邮件服务器：
                </label>
                <div class="col-md-4">
                    <input type="text" name="smtp_server" id="smtp_server" class="form-control"
                    value="<?php echo $this->config['smtp_server']?>">
                </div>
                <span class="col-md-6">
                    以smtp开头
                </span>
            </div>
            <div class="form-group">
                <label for="smtp_email" class="col-md-2 control-label">
                    邮箱账号：
                </label>
                <div class="col-md-4">
                    <input type="text" name="smtp_email" id="smtp_email" class="form-control"
                    value="<?php echo $this->config['smtp_email']?>">
                </div>
                <span class="col-md-6">
                </span>
            </div>
            <div class="form-group">
                <label for="smtp_pwd" class="col-md-2 control-label">
                    邮箱密码：
                </label>
                <div class="col-md-4">
                    <input type="password" name="smtp_pwd" id="smtp_pwd" class="form-control"
                    value="<?php echo $this->config['smtp_pwd']?>">
                </div>
                <span class="col-md-6">
                </span>
            </div>
            <div class="form-group">
                <label for="email_state" class="col-md-2 control-label">
                    邮件开关：
                </label>
                <div class="col-md-4">
                    <select name="email_state" class="form-control">
                        <option value="1" <?php echo $this->config['email_state']=='1' ? ' selected' : ''?>>已开启
                        </option>
                        <option value="0" <?php echo $this->config['email_state']=='0' ? ' selected' : ''?>>已关闭
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div>

    <div class="set set2 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
              method="post" autocomplete="off">

            <div class="form-group">
                <label for="tips" class="col-md-2 control-label">
                    公告内容：
                </label>
                <div class="col-md-4">
                    <textarea name="tips" style="width:100%;height:300px;visibility:hidden;">
                    <?php echo $this->config['tips']?>
                </textarea>
                </div>
                <span class="col-md-6">
                </span>
            </div>

            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div>

    <div class="set set3 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
              method="post" autocomplete="off">

            <div class="form-group">
                <label for="ismail_num" class="col-md-2 control-label">
                    告警阈值：
                </label>
                <div class="col-md-4">
                    <input type="text" name="ismail_num" id="ismail_num" class="form-control"
                           value="<?php echo $this->config['ismail_num']?>">
                </div>
                <span class="col-md-6">
                    库存低于多少告警
                </span>
            </div>

            <div class="form-group">
                <label for="serive_token" class="col-md-2 control-label">
                    Token：
                </label>
                <div class="col-md-4">
                    <input type="text" name="serive_token" id="ismail_num" class="form-control"
                           value="<?php echo $this->config['serive_token']?>">
                </div>
                <span class="col-md-6">
                    用于订单清理或库存告警定时任务通讯密钥
                </span>
            </div>

            <div class="form-group">
                <label for="ismail_kuc" class="col-md-2 control-label">
                    库存告警开关：
                </label>
                <div class="col-md-4">
                    <select name="ismail_kuc" class="form-control">
                        <option value="1" <?php echo $this->config['ismail_kuc']=='1' ? ' selected' : ''?>>已开启
                        </option>
                        <option value="0" <?php echo $this->config['ismail_kuc']=='0' ? ' selected' : ''?>>已关闭
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div>

    <div class="set set4 hide">
        <form class="form-ajax form-horizontal" action="<?php echo $this->dir?>set/save"
              method="post" autocomplete="off">
            <div class="form-group">
                <label for="sw_reg" class="col-md-2 control-label">
                    注册开关：
                </label>
                <div class="col-md-4">
                    <select name="sw_reg" class="form-control">
                        <option value="1" <?php echo $this->config['sw_reg']=='1' ? ' selected' : ''?>>已开启
                        </option>
                        <option value="0" <?php echo $this->config['sw_reg']=='0' ? ' selected' : ''?>>已关闭
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="regle" class="col-md-2 control-label">
                    默认用户等级：
                </label>
                <div class="col-md-4">
                    <select name="regle" class="form-control">
                        <?php if ($ulevel): ?>
                            <?php foreach ($ulevel as $key =>
                                           $val): ?>
                                <option value="<?php echo $val['id'] ?>" <?php echo $val['id'] == $this->config['regle'] ? ' selected' : '' ?>>
                                    <?php echo $val['title'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="stacode" class="col-md-2 control-label">
                </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        &nbsp;
                        <span class="glyphicon glyphicon-save">
                        </span>
                        &nbsp;保存设置&nbsp;
                    </button>
                </div>
                <span class="col-md-6">
                </span>
            </div>
        </form>
    </div>
	

    <?php require_once 'footer.php' ?>