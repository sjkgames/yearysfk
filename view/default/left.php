<div class="tpl-left-nav tpl-left-nav-hover">
    <div class="tpl-left-nav-title">
        菜单
    </div>
    <div class="tpl-left-nav-list">
        <ul class="tpl-left-nav-menu">
            <?php if ($this->req->session('login_uname')):?>
                <li class="tpl-left-nav-item">
                    <a href="/user" class="nav-link <?php if ($this->action[0] == 'user' && $this->action[1] == ""): ?> active <?php endif;?>">
                        <i class="am-icon-user"></i>
                        <span>用户中心</span>
                    </a>
                </li>


                <li class="tpl-left-nav-item">
                    <a href="/user/sett" class="nav-link <?php if ($this->action[1] == 'sett'): ?> active <?php endif;?>">
                        <i class="am-icon-cog"></i>
                        <span>个人资料</span>
                    </a>
                </li>

            <?php endif; ?>

            <li class="tpl-left-nav-item">
                <a href="/" class="nav-link <?php if ($this->action[0] == 'index'): ?> active <?php endif;?>">
                    <i class="am-icon-home"></i>
                    <span>自助下单</span>
                </a>
            </li>
            <li class="tpl-left-nav-item">
                <a href="/chaka" class="nav-link <?php if ($this->action[0] == 'chaka'): ?> active <?php endif;?>">
                    <i class="am-icon-table"></i>
                    <span>订单查询</span>
                </a>
            </li>

        </ul>
    </div>
</div>