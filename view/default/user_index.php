<?php require_once 'header.php' ?>


<div class="tpl-page-container tpl-page-header-fixed">


    <?php require_once 'left.php' ?>


    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            用户中心
        </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">用户中心</a></li>

        </ol>

        <div class="row">
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="am-icon-calendar-o"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <?php echo $user['ctOrder'] ?> </div>
                        <div class="desc"> 总订单</div>
                    </div>

                </div>
            </div>
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="am-icon-money"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <?php echo $user['ctMoney']['ctmoney'] ?> 元</div>
                        <div class="desc"> 总消费</div>
                    </div>

                </div>
            </div>
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="am-icon-clipboard"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <?php echo date('Y-m-d H:i', $this->session->get('login_time')) ?> </div>
                        <div class="desc"> 上次登录时间</div>
                    </div>

                </div>
            </div>
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="am-icon-times-circle"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <?php echo $this->session->get('login_ip') ?> </div>
                        <div class="desc"> 上次登录ip</div>
                    </div>

                </div>
            </div>


        </div>

        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 我的订单
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">

                </div>


            </div>
            <div class="tpl-block">
                <div class="am-g">
                    <form class="form-inline" action="" method="get">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">

                            </div>
                        </div>

                        <div class="am-u-sm-12 am-u-md-3">
                            <div class="am-form-group">
                                <select id="otype" name="otype" data-am-selected="{btnSize: 'sm'}">
                                    <option value="-1"<?php echo $search['otype'] == '-1' ? ' selected' : '' ?>>全部订单类型
                                    </option>
                                    <option value="0"<?php echo $search['otype'] == '0' ? ' selected' : '' ?>>自动发卡
                                    </option>
                                    <option value="1"<?php echo $search['otype'] == '1' ? ' selected' : '' ?>>手工订单
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="am-u-sm-12 am-u-md-3">

                            <div class="am-input-group am-input-group-sm">

                                <input type="text" id="account" name="account" value="<?php echo $search['account'] ?>"
                                       placeholder="充值账号搜索"
                                       class="am-form-field">
                                <span class="am-input-group-btn">
                             <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search"
                                     type="submit"></button>
                            </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="am-g">
                    <div class="am-u-sm-12 am-scrollable-horizontal">

                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>

                                <th class="table-id">订单id</th>
                                <th class="table-oname">订单名称</th>
                                <th class="table-otype">订单类型</th>
                                <th class="table-onum">充值数量</th>
                                <th class="table-omoney">商品单价</th>
                                <th class="table-cmoney">订单总价</th>
                                <th class="table-account">充值账号</th>
                                <th class="table-paytype">支付方式</th>
                                <th class="table-status">状态</th>
                                <th class="table-date am-hide-sm-only">下单时间</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>

                            <tbody id="ordcont">

                            <?php if ($lists): ?>
                                <?php foreach ($lists as $key => $val): ?>
                                    <tr>

                                        <td><?php echo $val['orderid'] ?></td>
                                        <td><?php echo $val['oname'] ?></td>
                                        <td>
                                            <?php if ($val['otype'] == 0): ?>
                                                <span class="am-badge am-badge-success am-radius">自动发卡</span>
                                            <?php else: ?>
                                                <span class="am-badge am-badge-warning am-radius">手工订单</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $val['onum'] ?></td>
                                        <td><?php echo $val['omoney'] ?></td>
                                        <td><?php echo $val['cmoney'] ?></td>
                                        <td><?php echo $val['account'] ?></td>
                                        <td>

                                            <span class="am-badge am-badge-success am-radius"><?php echo $val['paytype'] ?></span>
                                        </td>
                                        <?php
                                        $orderStatus = [
                                            1 => "<span class=\"am-badge am-badge-warning am-radius\">待处理</span>",
                                            2 => " <span class=\"am-badge am-badge-primary am-radius\">已处理</span>",
                                            3 => " <span class=\"am-badge am-badge-success am-radius\">已完成</span>",
                                            4 => " <span class=\"am-badge am-badge-danger am-radius\">处理失败</span>",
                                            5 => " <span class=\"am-badge am-badge-danger am-radius\">发卡失败</span>",
                                        ];

                                        ?>

                                        <td> <?php echo $val['orderStatus'][$status] ?></td>
                                        <td class="am-hide-sm-only"><?php echo date('Y-m-d H:i', $val['ctime']) ?></td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button onclick="orderInfo('<?php echo $val['orderid'] ?>')"
                                                            class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                                        <span class="am-icon-eye"></span>订单详情
                                                    </button>

                                                </div>
                                                <?php if ($val['otype'] == 0): ?>
                                                <div class="am-btn-group am-btn-group-xs">
                                                        <a href="/user/sett/import?id=<?php echo $val['orderid'] ?>" class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                                            <span class="am-icon-caret-down"></span>导出卡密
                                                        </a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="11">
                                        暂无订单
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>


                        </table>

                        <div class="am-cf">

                            <div class="am-fr">
                                <ul class="am-pagination tpl-pagination">
                                    <?php echo $lists ? $pagelist : '' ?>
                                </ul>
                            </div>
                        </div>
                        <hr>


                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>


    </div>


</div>


<?php require_once 'footer.php' ?>

