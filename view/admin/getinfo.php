<style>
    table.customize{border-collapse: collapse;width:100%}table.customize td{height:
        40px;border-bottom:1px solid #ddd}table.customize td.title{color:#999;background:
        #fff}
</style>
<div class="panel panel-info">
    <div class="panel-heading">
        订单信息
    </div>
    <div class="panel-body">
        <table class="customize">
            <tr>
                <td class="title">
                    订单名称：
                </td>
                <td>
                    <?php echo $data['oname'] ?>
                </td>
                <td class="title">
                    商品单价：
                </td>
                <td>
                    <?php echo $data['omoney'] ?>￥
                </td>
            </tr>
            <tr>
                <td class="title">
                    购买数量：
                </td>
                <td>
                    <?php echo $data['onum'] ?>

                </td>
                <td class="title">
                    订单总价：
                </td>
                <td>
                    <?php echo $data['cmoney'] ?>
                    ￥
                </td>

            </tr>

        </table>
    </div>
</div>
<div class="panel panel-warning">
    <div class="panel-heading">
        充值详情
    </div>
    <div class="panel-body">
        <?php echo $data['info'] ?>
    </div>
</div>