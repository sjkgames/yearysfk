<?php require_once 'header.php' ?>
<h3>
        <span class="current">
            用户列表
        </span>
    &nbsp;/&nbsp;
    <span>
            添加用户
        </span>

</h3>
<br>


<div class="set set0 table-responsive">

    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">

                <div class="form-group"><select name="lid" class="form-control">
                        <option value="-1"<?php echo $search['cid'] == '-1' ? ' selected' : '' ?>>全部等级
                        </option>

                        <?php foreach ($ulevel as $key => $val): ?>
                            <option value="<?php echo $val['id'] ?>"<?php echo $val['id'] == $search['lid'] ? ' selected' : '' ?>><?php echo $val['title'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><select name="is_ste" class="form-control">
                        <option value="-1"<?php echo $search['is_ste'] == '-1' ? ' selected' : '' ?>>
                            全部状态
                        </option>
                        <option value="1"<?php echo $search['is_ste'] == '1' ? ' selected' : '' ?>>启用
                        </option>
                        <option value="0"<?php echo $search['is_ste'] == '0' ? ' selected' : '' ?>>禁用
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="uname" placeholder="用户名"
                           value="<?php echo $search['uname'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-search">

                                </span>
                    &nbsp;立即查询
                </button>
            </form>

        </div>
        <div class="panel-body">
            <button onclick="checkOrder('<?php echo $this->dir ?>user/checkUser',9)" type="button"
                    class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash">
                    </span>
                &nbsp;删除
            </button>
            <button onclick="checkOrder('<?php echo $this->dir ?>user/checkUser',0)" type="button"
                    class="btn btn-info">
                    <span class="glyphicon glyphicon-pencil">
                    </span>
                &nbsp;禁用
            </button>
            <button onclick="checkOrder('<?php echo $this->dir ?>user/checkUser',1)" type="button"
                    class="btn btn-success">
                    <span class="glyphicon glyphicon-ok">
                    </span>
                &nbsp;启用
            </button>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr class="info">
            <th>
                <input type="checkbox" id="checkAll" class="checkbox">
            </th>
            <th>
                用户id
            </th>
            <th>
                用户名
            </th>
            <th>
                用户等级
            </th>
            <th>
                邮箱
            </th>
            <th>
                状态
            </th>
            <th>
                累计消费
            </th>
            <th>
                上次登录ip
            </th>
            <th>
                上次登录时间
            </th>

            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody>
        <?php if ($lists): ?>
            <?php foreach ($lists as $key => $val): ?>
                <tr data-id="<?php echo $val['id'] ?>">
                    <td class="text-center">
                        <input type="checkbox" name="checkname" value="<?php echo $val['id'] ?>" class="checkbox">
                    </td>
                    <td>
                        <?php echo $val['id'] ?>
                    </td>
                    <td>
                        <?php echo $val['uname'] ?>
                    </td>

                    <td>
                        <?php echo $val['title'] ?>
                    </td>
                    <td>
                        <?php echo $val['uemail'] ?>
                    </td>

                    <td>
                        <?php if ($val['is_state'] == 1): ?>
                            <span class="label label-success">启用</span>
                        <?php else: ?>
                            <span class="label label-warning">禁用</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php echo $val['ctmoney'] ?>￥
                    </td>
                    <td>
                        <?php echo $val['logip'] ?>
                    </td>
                    <td>
                        <?php echo date('Y-m-d H:i', $val['logtime']) ?>
                    </td>


                    <td>
                        <a href="<?php echo $this->dir ?>user/edit/<?php echo $val['id'] ?>" data-toggle="tooltip"
                           title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                        </a>
                        &nbsp;
                        <a href="<?php echo $this->dir ?>orders?uid=<?php echo $val['id'] ?>" data-toggle="tooltip"
                           title="用户订单记录">
                                    <span class="glyphicon glyphicon-import">
                                    </span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">
                    no data.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php echo $lists ? $pagelist : '' ?><br><br>
</div>


<div class="set set1 hide">
    <form class="form-horizontal" action="<?php echo $this->dir ?>user/save"
          method="post" autocomplete="off">
        <div class="form-group">
            <label for="uname" class="col-md-2 control-label">
                用户名：
            </label>
            <div class="col-md-3">
                <input type="text" name="uname" id="uname" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="upasswd" class="col-md-2 control-label">
                密码：
            </label>
            <div class="col-md-3">
                <input type="password" name="upasswd" id="upasswd" class="form-control" required value="">
            </div>
        </div>
        <div class="form-group">
            <label for="cid" class="col-md-2 control-label">
                用户等级：
            </label>
            <div class="col-md-3">
                <select name="lid" class="form-control">
                    <?php if ($ulevel): ?>
                        <?php foreach ($ulevel as $key =>
                                       $val): ?>
                            <option value="<?php echo $val['id'] ?>">
                                <?php echo $val['title'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="is_state" class="col-md-2 control-label">
                是否启用：
            </label>
            <div class="col-md-3">
                <select name="is_state" class="form-control">
                    <option value="1">启用</option>
                    <option value="0">禁用</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="uemail" class="col-md-2 control-label">
                邮箱：
            </label>
            <div class="col-md-3">
                <input type="email" name="uemail" id="uemail" class="form-control" required value="">
            </div>
        </div>

        <div class="form-group">
            <label for="ckmail" class="col-md-2 control-label">
                邮箱是否启用：
            </label>
            <div class="col-md-3">
                <select name="ckmail" class="form-control">
                    <option value="1">启用</option>
                    <option value="0">禁用</option>
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

