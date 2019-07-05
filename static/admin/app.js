$(function(){
    $('.form-ajax').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action'),
            type : 'POST',
            dataType : 'json',
            data: $(this).serialize(),
            beforeSend: function(){
                $('.prompt-error').text('');
                $('.woody-prompt').hide();
            },
            success : function(result){
                if(result.status=='0'){
                    $('.prompt-error').html('<span class="glyphicon glyphicon-info-sign"></span>&nbsp;'+result.msg);
                    $('.woody-prompt').show();
                }

                if(result.status=='1'){
                    alert(result.msg);
                    if(result.url){
                        window.location.href = result.url;
                    }
                }

                if(result.status=='0'){
                    $('[name=chkcode]').val('');
                    $('.imgcode').click();
                }
            }
        });
    });

    $('h3 span').click(function(){
        $('h3 span').removeClass('current');
        $(this).addClass('current');
        $('.set').hide();
        $('.set'+$(this).index()).removeClass('hide').show();
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.selectAllCheckbox').click(function(){
        if($(this).prop('checked')){
            $('.checkbox').prop('checked',true);
        } else {
            $('.checkbox').prop('checked',false);
        }
    });

    $('.zclipCopy').zclip({
      path: '/static/common/ZeroClipboard.swf',
      copy: function(){
        return $(this).prop('data');
      },
      afterCopy: function(){
        alert('复制成功');
      }
    });

    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd',
        minView: 'month',
        todayBtn: 1,
        autoclose: 1,
    });
    $("#sc-type").change(function(){
        $.ajax({
            url : 'goods/typegd',
            type : 'POST',
            dataType : 'json',
            data: {cid:$("#sc-type").val()},
            beforeSend: function(){
                layer.load(1);
                $('#sc-good').html();
            },
            success : function(result){
                if(result.status == '1'){
                    $('#sc-good').html(result.html);
                    layer.closeAll();
                }else{
                    $('#sc-good').html("<option value=\"-1\">该分类下没有商品</option>");
                    layer.closeAll();
                }
            }

        });

    });

    $("#checkAll").click(
        function(){
            if(this.checked){
                $("input[name='checkname']").prop('checked', true)
            }else{
                $("input[name='checkname']").prop('checked', false)
            }
        }
    );
});

/**
 * 获取所有复选框选中的内容
 */
var getCheckAll = function () {
    var ids ="";
    $.each($('input:checkbox'),function(){
        if(this.checked && $(this).val() != 'on'){
            ids += $(this).val() + ','
        }
    });
    ids=ids.substring(0,ids.length-1)
    return ids
}

function showContent(title,url){
    $('#waModal').modal('show');
    $('#waModal .modal-title').text(title);
    $.get(url,{t:new Date().getTime()},function(data){
        $('#waModal .modal-body').html(data);
    });
}

function del(id,url){
    if(confirm('是否要执行此操作？')){
        $.get(url,{id:id},function(ret){
            if(ret.status=='0'){
                alert('删除失败');
            } else {
                $('[data-id="'+id+'"]').fadeOut();
            }
        },'json');
    }
}

function freeze(id,url){
    if(confirm('是否要执行此操作？')){
        $.get(url,{id:id},function(ret){
            if(ret.status=='0'){
                alert(ret.msg);
            } else {
                $('.freeze'+id).prop('title',ret.title);
                $('.state'+id+' span').removeClass(ret.removeClass);
                $('.state'+id+' span').addClass(ret.addClass);
                $('.state'+id+' span').text(ret.stateName);
                $('.freeze'+id).text(ret.msg);
            }
        },'json');
    }
}

/**
 * 处理订单
 */
var checkOrder = function (url,status) {

    var ids = getCheckAll();
    if(ids == ""){layer.alert('请选择要处理的订单',{icon:2}); return}
    layer.load(1);
    $.post(url,{ids:ids,status:status},function(result){
        layer.closeAll();
        if(result.status == 0){
            layer.alert(result.msg,{icon:2})
        }else{
            location.reload()
        }
    });


}

function checkUpdate(version) {
    $.ajax({
        type: "get",
        data: "random="+Math.random(),
        url: "http://api2.yunscx.com/api/YunsNews/checkUpdate?version="+version,
        dataType: "jsonp",
        jsonp: "callback",
        success: function(data) {
            if(data.code == 0){
                layer.alert(data.msg,{icon:2}); return
            }else {
                layer.alert('当前已是最新版本',{icon:6}); return
            }
        },
        error: function() {
            console.log('Request Error.');
        }
    });
}