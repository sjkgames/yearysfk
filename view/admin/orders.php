<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            卡密列表
        </span>

    </h3>
    <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline" action="" method="get">
                    <div class="form-group">
                        <select name="otype" class="form-control">
                            <option value="-1"<?php echo $search['otype'] == '-1' ? ' selected' : '' ?>>全部订单类型
                            </option>
                            <option value="0"<?php echo $search['otype'] == '0' ? ' selected' : '' ?>>自动发卡
                            </option>
                            <option value="1"<?php echo $search['otype'] == '1' ? ' selected' : '' ?>>手工订单
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="-1"<?php echo $search['status'] == '-1' ? ' selected' : '' ?>>
                                全部订单状态
                            </option>
                            <option value="1"<?php echo $search['status'] == '1' ? ' selected' : '' ?>>待处理
                            </option>
                            <option value="2"<?php echo $search['status'] == '2' ? ' selected' : '' ?>>已处理
                            </option>
                            <option value="3"<?php echo $search['status'] == '3' ? ' selected' : '' ?>>已完成
                            </option>
                            <option value="4"<?php echo $search['status'] == '4' ? ' selected' : '' ?>>处理失败
                            </option>
                            <option value="5"<?php echo $search['status'] == '5' ? ' selected' : '' ?>>发卡失败
                            </option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="oid" placeholder="订单id" value="<?php echo $search['oid'] ?>"
                               size="14">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="uname" placeholder="用户名" value="<?php echo $search['uname'] ?>"
                               size="14">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="account" placeholder="充值账号" value="<?php echo $search['account'] ?>"
                               size="14">
                    </div>
                    <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search">
                    </span>
                        &nbsp;立即查询
                    </button>
                </form>

            </div>
            <div class="panel-body">
                <button onclick="checkOrder('<?php echo $this->dir?>orders/checkOrder',9)" type="button" class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash">
                    </span>
                    &nbsp;删除
                </button>
                <button onclick="checkOrder('<?php echo $this->dir?>orders/checkOrder',2)" type="button" class="btn btn-info">
                    <span class="glyphicon glyphicon-pencil">
                    </span>
                    &nbsp;开始处理
                </button>
                <button onclick="checkOrder('<?php echo $this->dir?>orders/checkOrder',3)" type="button" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok">
                    </span>
                    &nbsp;订单完成
                </button>
                <button onclick="checkOrder('<?php echo $this->dir?>orders/checkOrder',4)" type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-erase">
                    </span>
                    &nbsp;处理失败
                </button>
            </div>
        </div>

        <div class="set set0">
            <table class="table table-hover">
                <thead>
                <tr class="info">

                    <th >
                        <input type="checkbox"  id="checkAll" class="checkbox">
                    </th>
                    <th>
                        订单id
                    </th>
                    <th>
                        订单名称
                    </th>
                    <th>
                        购买用户
                    </th>
                    <th>
                        商品名称
                    </th>
                    <th>
                        商品单价
                    </th>
                    <th>
                        购买数量
                    </th>
                    <th>
                        订单总价
                    </th>
                    <th>
                        充值账号
                    </th>
                    <th>
                        订单类型
                    </th>
                    <th>
                        三方支付号
                    </th>
                    <th>
                        支付方式
                    </th>
                    <th>
                        查询密码
                    </th>
                    <th>
                        订单状态
                    </th>
                    <th>
                        创建时间
                    </th>
                    <th class="text-center">
                        操作
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if($lists):?>
                    <?php foreach($lists as $key=>$val):?>
                        <tr data-id="<?php echo $val['id']?>">


                            <td class="text-center">
                                <input type="checkbox" name="checkname" value="<?php echo $val['id']?>" class="checkbox">
                            </td>
                            <td>
                                <?php echo $val['orderid']?>
                            </td>
                            <td>
                                <?php echo $val['oname']?>
                            </td>
                            <td>
                                <?php echo $val['uname'] ? $val['uname'] : '普通用户' ?>
                            </td>
                            <td>
                                <?php echo $val['gname']?>
                            </td>
                            <td>
                                <?php echo $val['omoney']?>￥
                            </td>
                            <td>
                                <?php echo $val['onum']?>
                            </td>
                            <td>
                                <?php echo $val['cmoney']?>￥
                            </td>
                            <td>
                                <?php echo $val['account']?>
                            </td>
                            <td>
                                <?php if ($val['otype'] == 0): ?>
                                    <span class="label label-success">自动发卡</span>
                                <?php else: ?>
                                    <span class="label label-info">手工订单</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo $val['payid']?>
                            </td>
                            <td>
                                <?php echo $val['paytype']?>
                            </td>
                            <td>
                                <?php echo $val['chapwd']?>
                            </td>
                            <td>
                                <?php
                                switch($val['status']){
                                    case '0':
                                        $state='<span class="label label-danger">未付</span>';
                                        break;
                                    case '1': $state='<span class="label label-warning">待处理</span>' ;
                                        break;
                                    case '2': $state='<span class="label label-info">已处理</span>' ;
                                        break;
                                    case '3': $state='<span class="label label-success">已完成</span>' ;
                                        break;
                                    case '4': $state='<span class="label label-danger">处理失败</span>' ;
                                        break;
                                    case '5': $state='<span class="label label-danger">发卡异常</span>' ;
                                        break;
                                }
                                echo $state;?>
                            </td>
                            <td>
                                <?php echo date( 'm-d H:i:s',$val[ 'ctime'])?>
                            </td>
                            <td class="text-center">
                                <a href="javascript:;" onclick="showContent('基本信息','<?php echo $this->dir ?>orders/getinfo/<?php echo $val['id'] ?>')"
                                   data-toggle="tooltip" title="订单详情">
                                    <span class="glyphicon glyphicon-eye-open">
                                    </span>订单详情
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan="5">
                            no data.
                        </td>
                    </tr>
                <?php endif;?>
                </tbody>

            </table><?php echo $lists ? $pagelist : ''?>

        </div>





<?php require_once 'footer.php' ?>

