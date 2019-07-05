<?php require_once 'header.php' ?>
    <h3>
        <span class="current">
            商品列表
        </span>
        &nbsp;/&nbsp;
        <span>
            添加商品
        </span>

    </h3>
    <br>

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

    <div class="set set0 table-responsive">

    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" action="" method="get">

                    <div class="col-md-10">
                        <div class="form-group"><select name="cid" class="form-control">
                                <option value="-1"<?php echo $search['cid'] == '-1' ? ' selected' : '' ?>>全部分类
                                </option>

                                <?php foreach ($class as $key => $val): ?>
                                    <option value="<?php echo $val['id'] ?>"<?php echo $val['id'] == $search['cid'] ? ' selected' : '' ?>><?php echo $val['title'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group"><select name="is_ste" class="form-control">
                                <option value="-1"<?php echo $search['is_ste'] == '-1' ? ' selected' : '' ?>>
                                    全部状态
                                </option>
                                <option value="1"<?php echo $search['is_ste'] == '1' ? ' selected' : '' ?>>上架
                                </option>
                                <option value="0"<?php echo $search['is_ste'] == '0' ? ' selected' : '' ?>>下架
                                </option>
                            </select>
                        </div>
                        <div class="form-group"><select name="type" class="form-control">
                                <option value="-1"<?php echo $search['type'] == '-1' ? ' selected' : '' ?>>
                                    全部类别
                                </option>
                                <option value="0"<?php echo $search['type'] == '0' ? ' selected' : '' ?>>自动发卡
                                </option>
                                <option value="1"<?php echo $search['type'] == '1' ? ' selected' : '' ?>>手工商品
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="gname" placeholder="商品名称" value="<?php echo $search['gname'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;立即查询
                        </button>
                    </div>




            </form>
        </div>
    </div>

        <table class="table table-hover">
            <thead>
            <tr class="info">
                <th>
                    id
                </th>
                <th>
                    分类
                </th>
                <th>
                    商品名称
                </th>
                <th>
                    商品链接
                </th>
                <th>
                    普通售价
                </th>
                <th>
                    <?php echo $ulevel[0]['title'] ?>售价
                </th>
                <th>
                    <?php echo $ulevel[1]['title'] ?>售价
                </th>
                <th>
                    <?php echo $ulevel[2]['title'] ?>售价
                </th>
                <th>
                    商品密码
                </th>
                <th>
                    商品类型
                </th>
                <th>
                    允许重复下单
                </th>
                <th>
                    已卖出
                </th>
                <th>
                    库存
                </th>
                <th>
                    状态
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
            <?php if ($lists): ?>
                <?php foreach ($lists as $key => $val): ?>
                    <tr data-id="<?php echo $val['id'] ?>">
                        <td>
                            <?php echo $val['id'] ?>
                        </td>
                        <td>
                            <?php echo $val['title'] ?>
                        </td>
                        <td>
                            <?php echo $val['gname'] ?>
                        </td>
                        <td>
                            <?php echo $val['gurl'] ? $_SERVER['HTTP_HOST'].'/t/'.$val['gurl'] : '未设置单独商品链接' ?>
                        </td>
                        <td>
                            <?php echo $val['gmoney'] ?>￥
                        </td>
                        <td>
                            <?php echo $val['onemoney'] ?>￥
                        </td>
                        <td>
                            <?php echo $val['twomoney'] ?>￥
                        </td>
                        <td>
                            <?php echo $val['smoney'] ?>￥
                        </td>
                        <td>
                            <?php echo $val['gpasswd'] ? $val['gpasswd'] : '无密码' ?>
                        </td>
                        <td>
                            <?php if ($val['type'] == 0): ?>
                                <span class="label label-success">自动发卡</span>
                            <?php else: ?>
                                <span class="label label-warning">手工商品</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($val['checks'] == 1): ?>
                                <span class="label label-success">是</span>
                            <?php else: ?>
                                <span class="label label-warning">否</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            已卖(<a href="<?php echo $this->dir ?>orders?gid=<?php echo $val['id'] ?>" style="color: red"><?php echo $val['is_ym']?$val['is_ym']:0 ?></a>)
                        </td>
                        <td>
                            <?php if ($val['type'] == 0): ?>
                            库存(<a href="<?php echo $this->dir ?>kami?gid=<?php echo $val['id'] ?>&is_ste=0" style="color: green"><?php echo $val['kuc'] ?></a>)张
                            <?php else: ?>
                                <?php echo $val['kuc'] ?>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($val['is_ste'] == 0): ?>
                                <span class="label label-danger">下架</span>
                            <?php else: ?>
                                <span class="label label-success">上架</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $val['ord'] ?>
                        </td>
                        <td>
                            <a href="<?php echo $this->dir ?>goods/edit/<?php echo $val['id'] ?>" data-toggle="tooltip"
                               title="编辑">
                                    <span class="glyphicon glyphicon-edit">
                                    </span>
                            </a>
                            &nbsp;&nbsp;
                            <a href="javascript:;"
                               onclick="del(<?php echo $val['id'] ?>,'<?php echo $this->dir ?>goods/del')"
                               data-toggle="tooltip" title="删除">
                                    <span class="glyphicon glyphicon-trash">
                                    </span>
                            </a>
                            <?php if ($val['type'] == 0): ?>
                                &nbsp;&nbsp;
                                <a href="<?php echo $this->dir ?>kami?gid=<?php echo $val['id'] ?>"
                                   data-toggle="tooltip" title="卡密管理">
                                    <span class="glyphicon glyphicon-credit-card">
                                    </span>
                                </a>
                                &nbsp;&nbsp;
                                <a href="<?php echo $this->dir ?>kami/import?gid=<?php echo $val['id'] ?>&is_ste=0"
                                   data-toggle="tooltip" title="导出库存卡密">
                                    <span class="glyphicon glyphicon-import">
                                    </span>
                                </a>

                            <?php endif; ?>
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
        <form class="form-horizontal" action="<?php echo $this->dir ?>goods/save"
              method="post" autocomplete="off">
            <div class="form-group">
                <label for="gname" class="col-md-2 control-label">
                    商品名称：
                </label>
                <div class="col-md-3">
                    <input type="text" name="gname" id="gname" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="gurl" class="col-md-2 control-label">
                    自定义商品链接：
                </label>
                <div class="col-md-3">
                    <input type="text" name="gurl" id="gurl" class="form-control" >
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
                    <input type="text" name="gmoney" id="gmoney" class="form-control" required value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="onemoney" class="col-md-2 control-label">
                    <?php echo $ulevel[0]['title'] ?>售价：
                </label>
                <div class="col-md-3">
                    <input type="text" name="onemoney" id="onemoney" class="form-control" required value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="twomoney" class="col-md-2 control-label">
                    <?php echo $ulevel[1]['title'] ?>售价：
                </label>
                <div class="col-md-3">
                    <input type="text" name="twomoney" id="twomoney" class="form-control" required value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="smoney" class="col-md-2 control-label">
                    <?php echo $ulevel[2]['title'] ?>售价：
                </label>
                <div class="col-md-3">
                    <input type="text" name="smoney" id="smoney" class="form-control" required value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="gpasswd" class="col-md-2 control-label">
                    商品密码（不填则不需密码购买）：
                </label>
                <div class="col-md-3">
                    <input type="text" name="gpasswd" id="gpasswd" class="form-control"  value="">
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
                                <option value="<?php echo $val['id']?>">
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
                        <option value="1">手工充值</option>
                        <option value="0">自动发卡</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="is_ste" class="col-md-2 control-label">
                    状态：
                </label>
                <div class="col-md-3">
                    <select name="is_ste" class="form-control">
                        <option value="1">上架</option>
                        <option value="0">下架</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="checks" class="col-md-2 control-label">
                    是否允许重复下单：
                </label>
                <div class="col-md-3">
                    <select name="checks" class="form-control">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
                <span class="col-md-6">

                </span>
            </div>
            <div class="form-group">
                <label for="cont" class="col-md-2 control-label">
                    商品介绍：
                </label>
                <div class="col-md-4">
                    <textarea name="cont" style="width:100%;height:300px;visibility:hidden;">

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
                    <input type="text" name="onetle" id="onetle" class="form-control"  required value="QQ号">
                </div>
            </div>

            <div class="form-group">
                <label for="gdipt" class="col-md-2 control-label">
                    更多输入框：
                </label>
                <div class="col-md-3">
                    <input type="text" name="gdipt" id="gdipt" class="form-control" placeholder="" value="">
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
                    <input type="text" name="ord" id="ord" class="form-control"  value="0">
                </div>
            </div>

            <div class="form-group">
                <label for="kuc" class="col-md-2 control-label">
                    库存：
                </label>
                <div class="col-md-3">
                    <input type="text" name="kuc" id="kuc" class="form-control" placeholder=""  value="">
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
    </div>



<?php require_once 'footer.php' ?>

