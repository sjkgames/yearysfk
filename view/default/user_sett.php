<?php require_once 'header.php' ?>


<div class="tpl-page-container tpl-page-header-fixed">


    <?php require_once 'left.php' ?>


    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            设置
        </div>
        <ol class="am-breadcrumb">
            <li><a href="" class="am-icon-home">个人设置</a></li>

        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 个人设置
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">


                    <div class="am-u-sm-12 am-u-md-9">
                        <form class="am-form am-form-horizontal">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">用户名</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="user-name" value="<?php echo $uname ?>" disabled >
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">当前等级</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="user-name" value="<?php echo $this->session->get('login_ulevel') ?>" disabled >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">累计消费</label>
                                <div class="am-u-sm-9">
                                    <input type="email" id="user-email" value="<?php echo $ctmoney ?>" disabled>
                                    <small>累计到一定数额可以升级等级</small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">邮箱</label>
                                <div class="am-u-sm-9">
                                    <input type="tel" id="user-phone" value="<?php echo $uemail ?>" disabled>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">上次登录时间</label>
                                <div class="am-u-sm-9">
                                    <input type="tel" id="user-phone" value="<?php echo date('Y-m-d H:i', $this->session->get('login_time')) ?>" disabled>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">上次登录ip</label>
                                <div class="am-u-sm-9">
                                    <input type="tel" id="user-phone" value="<?php echo $this->session->get('login_ip') ?>" disabled>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>


</div>


<?php require_once 'footer.php' ?>

