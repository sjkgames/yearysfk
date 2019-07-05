<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            商品分类
        </span>
        &nbsp;/&nbsp;
        <span>
            添加分类
        </span>
    </h3>
    <br>

    <div class="set set0 table-responsive">
        <table class="table table-hover">
            <thead>
            <tr class="info">
                <th>
                    id
                </th>
                <th>
                    名称
                </th>
                <th>
                    排序
                </th>

                <th>
                    操作
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if($lists):?>
                <?php foreach($lists as $key=>$val):?>
                    <tr data-id="<?php echo $val['id']?>">
                        <td>
                            <?php echo $val['id'] ?>
                        </td>
                        <td>
                            <?php echo $val['title'] ?>
                        </td>
                        <td>
                            <?php echo $val['ord'] ?>
                        </td>
                        <td>
                            <a href="<?php echo $this->dir?>gdclass/edit/<?php echo $val['id']?>"  data-toggle="tooltip" title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                            </a>
                            &nbsp;&nbsp;
                            <a href="javascript:;" onclick="del(<?php echo $val['id']?>,'<?php echo $this->dir?>gdclass/del')"  data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr>
                    <td colspan="6">
                        no data.
                    </td>
                </tr>
            <?php endif;?>
            </tbody>
        </table>
    </div>

    <div class="set set1 hide">
        <form class="form-horizontal" action="<?php echo $this->dir?>gdclass/save"
              method="post" autocomplete="off">
            <div class="form-group">
                <label for="title" class="col-md-2 control-label">
                    分类名称：
                </label>
                <div class="col-md-6">
                    <input type="text" name="title" id="title" class="form-control" required=>
                </div>
            </div>
            <div class="form-group">
                <label for="addtime" class="col-md-2 control-label">
                    排序：
                </label>
                <div class="col-md-6">
                    <input type="text" name="ord" id="ord" class="form-control" required
                           value="0">
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