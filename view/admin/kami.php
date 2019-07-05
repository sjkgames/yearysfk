<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            卡密列表
        </span>
        &nbsp;/&nbsp;
        <span>
            卡密导入
        </span>
    </h3>
    <br>
    <div class="set set0 table-responsive">
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">
                <div class="form-group">
                    <select name="gid" class="form-control">
                        <option value="-1"<?php echo $search['gid'] == '-1' ? ' selected' : '' ?>>全部商品
                        </option>

                        <?php foreach ($class as $key => $val): ?>
                            <option value="<?php echo $val['id'] ?>"<?php echo $val['id'] == $search['gid'] ? ' selected' : '' ?>><?php echo $val['gname'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><select name="is_ste" class="form-control">
                        <option value="-1"<?php echo $search['is_ste'] == '-1' ? ' selected' : '' ?>>
                            全部状态
                        </option>
                        <option value="0"<?php echo $search['is_ste'] == '0' ? ' selected' : '' ?>>正常
                        </option>
                        <option value="1"<?php echo $search['is_ste'] == '1' ? ' selected' : '' ?>>售出
                        </option>

                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="kano" placeholder="卡号" value="<?php echo $search['kano'] ?>"
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
            <button onclick="checkOrder('<?php echo $this->dir?>kami/delall',9)" type="button" class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash">
                    </span>
                &nbsp;批量删除
            </button>
        </div>
    </div>
    <div class="set set0">
        <table class="table table-hover">
            <thead>
            <tr class="info">
                <th>
                    <input type="checkbox"  id="checkAll" class="checkbox">
                </th>
                <th class="text-center">
                    编号
                </th>
                <th>
                    商品名称
                </th>
                <th>
                    卡密
                </th>
                <th>
                    状态
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
                        <td>
                            <input type="checkbox" name="checkname" value="<?php echo $val['id']?>" class="checkbox">
                        </td>
                        <td class="text-center">
                            <?php echo $val[ 'id']?>
                        </td>
                        <td>
                            <?php echo $val[ 'gname']?>
                        </td>
                        <td>
                            <?php echo $val[ 'kano']?>
                        </td>
                        <td>
                            <?php if ($val['is_ste'] == 0): ?>
                                <span class="label label-success">正常</span>
                            <?php else: ?>
                                <span class="label label-danger">售出</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo date( 'm-d H:i:s',$val[ 'ctime'])?>
                        </td>
                        <td class="text-center">
                            <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>kami/del')"
                               data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
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
        </table>
    </div>
<?php echo $lists ? $pagelist : ''?>
    </div>


    <div class="set set1 hide">



        <form class="form-horizontal" action="<?php echo $this->dir ?>kami/impka"
              method="post" autocomplete="off" enctype="multipart/form-data">

            <div class="form-group">
                <label for="type" class="col-md-2 control-label">
                    请选择商品：
                </label>
                <div class="col-md-3">
                    <select name="type" class="form-control" id="sc-type">
                        <option value="-1">请选择分类</option>
                        <?php if($gclass):?>
                            <?php foreach($gclass as $key=>
                                          $val):?>
                                <option value="<?php echo $val['id']?>">
                                    <?php echo $val['title']?>
                                </option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                    <select name="gid" class="form-control" id="sc-good">

                    </select>

                </div>
            </div>
            <div class="form-group">
                <label for="kamicont" class="col-md-2 control-label">
                    卡密列表：
                </label>
                <div class="col-md-4">
                    <textarea name="kamicont" style="width:100%;height:300px;"></textarea>
                </div>
                <span class="col-md-6">
                    格式：卡号----卡密 或者卡号 一行一条
                </span>
            </div>
            <div class="form-group">
                <label for="imptxt" class="col-md-2 control-label">
                    导入txt：
                </label>
                <div class="col-md-3">
                    <input type="file" name="file" id="imptxt" class="form-control">
                </div>
                <span class="col-md-6">
                    格式：卡号----卡密 或者卡号 一行一条，请勿上传过大数据，最好不要超过2M
                </span>
            </div>
            <div class="form-group">
                <label for="checkm" class="col-md-2 control-label">
                    过滤重复卡密：
                </label>
                <div class="col-md-3">
                    <select name="checkm" class="form-control" id="sc-good">
                        <option value="1">
                            过滤
                        </option>
                        <option value="0">
                            不过滤
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

<?php require_once 'footer.php' ?>