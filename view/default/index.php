<?php require_once 'header.php' ?>





<div class="tpl-page-container tpl-page-header-fixed">


    <?php require_once 'left.php' ?>


    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            <?php echo $this->config['description'] ?>    </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">首页</a></li>
        </ol>
        <div class="tpl-content-scope">
            <div class="note note-info">
                <?php echo $this->config['tips'] ?>
            </div>
        </div>



        <div class="row">

            <div class="am-u-md-6 am-u-sm-12 row-mb">
                <div class="tpl-portlet">
                    <div class="tpl-portlet-title">
                        <div class="tpl-caption font-green ">
                            <i class="am-icon-shopping-bag"></i>
                            <span>购买商品</span>
                        </div>

                    </div>

                    <div class="tpl-scrollable">
                        <div class="am-g tpl-amazeui-form">


                            <div class="am-u-sm-12 ">
                                <form class="am-form am-form-horizontal" id="sgform">
                                    <div class="am-form-group">
                                        <label for="sc-cid" class="am-u-sm-2 am-form-label">商品分类</label>
                                        <div class="am-u-sm-10">
                                            <select id="sc-cid" class="am-form-field am-round">
                                                <option value="0">请选择分类</option>
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

                                    <div class="am-form-group">
                                        <label for="glist" class="am-u-sm-2 am-form-label">商品列表</label>
                                        <div class="am-u-sm-10">
                                            <select class="am-form-field am-round" id="glist">
                                                <option value="0">请选择商品</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="money" class="am-u-sm-2 am-form-label">商品单价</label>
                                        <div class="am-u-sm-10">
                                            <input type="text" id="money" class="am-form-field am-round"
                                                   disabled="disabled" value="">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="kuc" class="am-u-sm-2 am-form-label">商品库存</label>
                                        <div class="am-u-sm-10">
                                            <input type="text" id="kuc" class="am-form-field am-round"
                                                   disabled="disabled" value="">
                                        </div>
                                    </div>


                                    <div class="am-form-group">
                                        <label for="number" class="am-u-sm-2 am-form-label">购买数量</label>
                                        <div class="am-u-sm-10">
                                            <input id="number" class="am-form-field am-round" type="text" value="1">
                                        </div>
                                    </div>


                                    <div class="am-form-group" id="okshop">

                                        <div class="am-u-sm-12 am-u-sm-push-5">
                                            <a onclick="okOrder()" class="am-btn am-btn-primary">确认购买</a>
                                        </div>

                                    </div>


                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


            <div class="am-u-md-6 am-u-sm-12 row-mb">
                <div class="tpl-portlet">
                    <div class="tpl-portlet-title">
                        <div class="tpl-caption font-red ">
                            <i class="am-icon-credit-card-alt"></i>
                            <span>商品详情</span>
                        </div>
                        <div class="actions">

                        </div>
                    </div>
                    <div class="tpl-scrollable">
                        <div class="am-g tpl-amazeui-form">


                            <div class="am-u-sm-12 " id="gdinfo">

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="am-u-md-6 am-u-sm-12 row-mb">


                </div>
                <div class="am-u-md-6 am-u-sm-12 row-mb">

                </div>
            </div>


        </div>


    </div>


</div>


<?php require_once 'footer.php' ?>

<?php require_once 'foot.php' ?>

<?php if(!empty($gdata)):?>
    <script>

            $("#sc-cid").find("option[value='<?php echo $gdata['cid'] ?>']").attr("selected",true).change();
            $("#glist").find("option[value='<?php echo $gdata['id'] ?>']").attr("selected",true).change();




    </script>

<?php endif;?>



