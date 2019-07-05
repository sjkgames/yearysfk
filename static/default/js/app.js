
$("#sc-cid").change(function () {
    if ($("#sc-cid").val() == 0) return;
    $.ajax({
        url: '/index/typegd',
        type: 'POST',
        dataType: 'json',
        async:false,
        data: {cid: $("#sc-cid").val()},
        beforeSend: function () {
            layer.load(1);
            $('#glist').html();
        },
        success: function (result) {
            if (result.status == '1') {
                $('#glist').html("<option value=\"0\">请选择商品</option>" + result.html);
                layer.closeAll();
            } else {
                $('#glist').html("<option value=\"0\">该分类下没有商品</option>");
                layer.closeAll();
            }
        }

    });

});
// 商品密码
var gpwd;

$("#glist").change(function () {
    var pwd = $("#glist").find("option:selected").attr('data-pwd')
    var gid = $(this).val()
    if(pwd == "yes"){
        layer.prompt({title: '请输入商品密码', formType: 1}, function (pass, index) {
            layer.close(index);
            if (pass == "") {
                layer.alert('请输入商品密码', {icon: 2});
                return;
            }
            gpwd = pass
            getGoodsInfo(gid,pass)
        });
    }else{
        getGoodsInfo(gid)
    }
});


//查询商品详情
function getGoodsInfo(id,pwd) {
    if (id == 0) return;
    $(".ajaxdiv").remove();
    $('#gdinfo').html()
    $.ajax({
        url: '/index/getGoodsInfo',
        type: 'POST',
        dataType: 'json',
        data: {id: id,pass:pwd},
        beforeSend: function () {
            layer.load(1);
        },
        success: function (result) {
            layer.closeAll();
            if (result.status == 0) {
                layer.alert(result.msg, {icon: 2})
            } else {
                $('#gdinfo').html(result.data.info.cont)
                $('#okshop').before(result.data.html)
                $('#money').val(result.data.info.gmoney)
                $('#kuc').val(result.data.info.kuc)
            }

        }
    });
}

/**
 * 提交订单
 */
function okOrder() {
    var gid = $("#glist").val();
    var number = $("#number").val();
    var account = $("#account").val();
    var chapwd = $("#chapwd").val();
    var ipu1 = $("#ipu1").val();
    var ipu2 = $("#ipu2").val();
    var ipu3 = $("#ipu3").val();
    var ipu4 = $("#ipu4").val();
    $.ajax({
        url: '/index/postOrder',
        type: 'POST',
        dataType: 'json',
        data: {
            gid: gid,
            number: number,
            account: account,
            chapwd: chapwd,
            gpass:gpwd,
            ipu1: ipu1,
            ipu2: ipu2,
            ipu3: ipu3,
            ipu4: ipu4
        },
        beforeSend: function () {
            layer.load(1);
        },
        success: function (result) {
            layer.closeAll();
            if (result.status == 0) {
                layer.alert(result.msg, {icon: 2})
            } else if (result.status == 2) {
                layer.alert(result.msg, {icon: 6})
            } else {
                $('#okshop').before(result.data)
                $('#okshop').remove()
            }

        }
    });
}

/**
 * 查询订单详情
 */

function getOrders() {
    var account = $('#account').val();
    var type = $('#otype').val();
    var chapwd = '';
    if (account == "") {
        layer.alert('请输入查询账号', {icon: 2});
        return;
    }
    if (type == 0) {
        layer.prompt({title: '自动发卡订单需要查询密码', formType: 1}, function (pass, index) {
            layer.close(index);
            if (pass == "") {
                layer.alert('请输入查询密码', {icon: 2});
                return;
            }
            chapwd = pass;
            sendOrder(account, type, chapwd);
        });
    } else {
        sendOrder(account, type, chapwd);
    }


}

function sendOrder(account, type, chapwd) {
    $.ajax({
        url: '/chaka/orderList',
        type: 'POST',
        dataType: 'json',
        data: {account: account, otype: type, chapwd: chapwd},
        beforeSend: function () {
            $('#ordcont').html('');
            layer.load(1);
        },
        success: function (result) {
            layer.closeAll();
            if (result.status == 0) {
                layer.alert(result.msg, {icon: 2})
            } else {
                $('#ordcont').html(result.data)
            }

        }
    });
}

function orderInfo(id) {
    $.ajax({
        url: '/chaka/orderInfo',
        type: 'POST',
        dataType: 'json',
        data: {id: id},
        beforeSend: function () {
            layer.load(1);
        },
        success: function (result) {
            layer.closeAll();
            if (result.status == 0) {
                layer.alert(result.msg, {icon: 2})
            } else {
                layer.open({
                    type: 1,
                    title: '订单详情',
                    skin: 'layui-layer-rim', //加上边框
                    area: ['420px', '240px'], //宽高
                    content: result.data.info
                });
            }

        }
    });
}
// ==========================
// 头部导航隐藏菜单
// ==========================

function navHover() {
    $('.tpl-left-nav').toggle();
    $('.tpl-content-wrapper').toggleClass('tpl-content-wrapper-hover');
}

function repwd() {
    layer.prompt({title: '请输入新密码，最小为6位字符', formType: 1}, function (pass, index) {
        layer.close(index);
        if (pass == "") {
            layer.alert('请输入新密码', {icon: 2});
            return;
        }
        if (pass.lenth < 6) {
            layer.alert('密码最小为6位', {icon: 2});
            return;
        }
        doRepwd(pass);
    });
}

function doRepwd(pass) {
    $.ajax({
        url: '/user/sett/repwd',
        type: 'POST',
        dataType: 'json',
        data: {pass: pass},
        beforeSend: function () {
            layer.load(1);
        },
        success: function (result) {
            layer.closeAll();
            if (result.status == 0) {
                layer.alert(result.msg, {icon: 2})
            } else {
                layer.alert(result.msg, {icon: 6})
            }

        }
    });
}