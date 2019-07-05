<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            编辑商品
        </span>
    </h3>
    <script charset="utf-8" src="/view/editor/kindeditor-min.js">
    </script>
    <script charset="utf-8" src="/view/editor/lang/zh_CN.js">
    </script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="cont"]', {
                allowFileManager: false,
            });
        });
    </script>
    <br>
    <form class="form-horizontal" action="<?php echo $this->dir?>goods/editsave/<?php echo $data['id']?>"
          method="post" autocomplete="off">
        <div class="form-group">
            <label for="gname" class="col-md-2 control-label">
                商品名称：
            </label>
            <div class="col-md-3">
                <input type="text" name="gname" id="gname" class="form-control" required value="<?php echo $data['gname']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="gurl" class="col-md-2 control-label">
                自定义商品链接：
            </label>
            <div class="col-md-3">
                <input type="text" name="gurl" id="gurl" class="form-control" value="<?php echo $data['gurl']?>" >
            </div>
            <span class="col-md-4">
                    例如填写sp123，那么可以直接通过http://域名/t/sp123访问该商品，注意请勿添加斜杠
                </span>
        </div>
        <div class="form-group">
            <label for="gmoney" class="col-md-2 control-label">
                普通售价（无需登录）：
            </label>
            <div class="col-md-3">
                <input type="text" name="gmoney" id="gmoney" class="form-control" required value="<?php echo $data['gmoney']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="onemoney" class="col-md-2 control-label">
                <?php echo $ulevel[0]['title'] ?>售价：
            </label>
            <div class="col-md-3">
                <input type="text" name="onemoney" id="onemoney" class="form-control" required value="<?php echo $data['onemoney']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="twomoney" class="col-md-2 control-label">
                <?php echo $ulevel[1]['title'] ?>售价：
            </label>
            <div class="col-md-3">
                <input type="text" name="twomoney" id="twomoney" class="form-control" required value="<?php echo $data['twomoney']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="smoney" class="col-md-2 control-label">
                <?php echo $ulevel[2]['title'] ?>售价：
            </label>
            <div class="col-md-3">
                <input type="text" name="smoney" id="smoney" class="form-control" required value="<?php echo $data['smoney']?>">
            </div>
        </div>
        <div class="form-group">
            <label for="gpasswd" class="col-md-2 control-label">
                商品密码（不填则不需密码购买）：
            </label>
            <div class="col-md-3">
                <input type="text" name="gpasswd" id="gpasswd" class="form-control"  value="<?php echo $data['gpasswd']?>">
            </div>
        </div>

        <div class="form-group">
            <label for="cid" class="col-md-2 control-label">
                商品分类：
            </label>
            <div class="col-md-3">
                <select name="cid" class="form-control">
                    <?php if($class):?>
                        <?php foreach($class as $key=>
                                      $val):?>
                            <option value="<?php echo $val['id']?>" <?php echo $val['id'] == $data['cid'] ? ' selected' : '' ?>>
                                <?php echo $val['title']?>
                            </option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="type" class="col-md-2 control-label">
                商品类型：
            </label>
            <div class="col-md-3">
                <select name="type" class="form-control">
                    <option value="1" <?php echo $data['type'] == 1 ? ' selected' : '' ?>>手工充值</option>
                    <option value="0" <?php echo $data['type'] == 0 ? ' selected' : '' ?>>自动发卡</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="is_ste" class="col-md-2 control-label">
                状态：
            </label>
            <div class="col-md-3">
                <select name="is_ste" class="form-control">
                    <option value="1" <?php echo $data['is_ste'] == 1 ? ' selected' : '' ?>>上架</option>
                    <option value="0" <?php echo $data['is_ste'] == 0 ? ' selected' : '' ?>>下架</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="checks" class="col-md-2 control-label">
                是否允许重复下单：
            </label>
            <div class="col-md-3">
                <select name="checks" class="form-control">
                    <option value="1" <?php echo $data['checks'] == 1 ? ' selected' : '' ?>>是</option>
                    <option value="0" <?php echo $data['checks'] == 0 ? ' selected' : '' ?>>否</option>
                </select>
            </div>
            <span class="col-md-6">
                    自动发卡商品此选项无效
                </span>
        </div>
        <div class="form-group">
            <label for="cont" class="col-md-2 control-label">
                商品介绍：
            </label>
            <div class="col-md-4">
                    <textarea name="cont" style="width:100%;height:300px;visibility:hidden;">
                        <?php echo $data['cont']?>
                    </textarea>
            </div>
            <span class="col-md-6">
                </span>
        </div>

        <div class="form-group">
            <label for="onetle" class="col-md-2 control-label">
                第一个输入框标题：
            </label>
            <div class="col-md-3">
                <input type="text" name="onetle" id="onetle" class="form-control" required value="<?php echo $data['onetle']?>">
            </div>
        </div>

        <div class="form-group">
            <label for="gdipt" class="col-md-2 control-label">
                更多输入框：
            </label>
            <div class="col-md-3">
                <input type="text" name="gdipt" id="gdipt" class="form-control" placeholder="" value="<?php echo $data['gdipt']?>">
            </div>
            <span class="col-md-4">
                   例如 密码,大区 以英文逗号分割;最多支持4个，如商品是自动发卡请勿填写!
            </span>
        </div>

        <div class="form-group">
            <label for="ord" class="col-md-2 control-label">
                排序：
            </label>
            <div class="col-md-3">
                <input type="text" name="ord" id="ord" class="form-control"  value="<?php echo $data['ord']?>">
            </div>
        </div>

        <div class="form-group">
            <label for="kuc" class="col-md-2 control-label">
                库存：
            </label>
            <div class="col-md-3">
                <input type="text" name="kuc" id="kuc" class="form-control" placeholder=""  value="<?php echo $data['kuc']?>">
            </div>
            <span class="col-md-4">
                   如商品是自动发卡请勿填写，导入卡密时会自动识别
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

<?php require_once 'footer.php' ?>