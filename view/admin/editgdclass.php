<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            编辑分类
        </span>
    </h3>
    <br>
    <form class="form-horizontal" action="<?php echo $this->dir?>gdclass/editsave/<?php echo $data['id']?>"
          method="post" autocomplete="off">
            <div class="form-group">
                <label for="title" class="col-md-2 control-label">
                    分类名称：
                </label>
                <div class="col-md-6">
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $data['title']?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="addtime" class="col-md-2 control-label">
                    排序：
                </label>
                <div class="col-md-6">
                    <input type="text" name="ord" id="ord" class="form-control" required
                           value="<?php echo $data['ord']?>">
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

<?php require_once 'footer.php' ?>