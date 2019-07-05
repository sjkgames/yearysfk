<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            编辑用户
        </span>
    </h3>

    <br>
    <form class="form-horizontal" action="<?php echo $this->dir?>user/editsave/<?php echo $data['id']?>"
          method="post" autocomplete="off">
        <div class="form-group">
            <label for="uname" class="col-md-2 control-label">
                用户名：
            </label>
            <div class="col-md-3">
                <input type="text" name="uname" id="uname" class="form-control" required value="<?php echo $data['uname']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="upasswd" class="col-md-2 control-label">
                密码：
            </label>
            <div class="col-md-3">
                <input type="password" name="upasswd" id="upasswd" class="form-control" placeholder="不改请留空" value="">
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
                            <option value="<?php echo $val['id'] ?>"<?php echo $val['id'] == $data['lid'] ? ' selected' : '' ?>>
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
                    <option value="1" <?php echo 1 == $data['is_state'] ? ' selected' : '' ?>>启用</option>
                    <option value="0" <?php echo 0 == $data['is_state'] ? ' selected' : '' ?>>禁用</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="uemail" class="col-md-2 control-label">
                邮箱：
            </label>
            <div class="col-md-3">
                <input type="email" name="uemail" id="uemail" class="form-control" required value="<?php echo $data['uemail']?>">
            </div>
        </div>

        <div class="form-group">
            <label for="ckmail" class="col-md-2 control-label">
                邮箱是否启用：
            </label>
            <div class="col-md-3">
                <select name="ckmail" class="form-control">
                    <option value="1" <?php echo 1 == $data['ckmail'] ? ' selected' : '' ?>>启用</option>
                    <option value="0" <?php echo 0 == $data['ckmail'] ? ' selected' : '' ?>>禁用</option>
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

<?php require_once 'footer.php' ?>