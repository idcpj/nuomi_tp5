
$(function () {
    $("input[name=listorder]").blur(function () {
        var url =SCOPE.listorder_url,
            data={};
        data.id=$(this).data('id');
        data.value=$(this).val();
        $.post(url,data,function (result) {
            if (result.code!=200){
                layer.msg(result.msg);
            }else {
                location.href=result.data;
            }
        },'JSON');
    });
});

function o2o_status(url) {
    $.getJSON(url,function (result) {
        if (result.code!=200){
            layer.msg(result.msg);
        }else {
            location.href=result.data;
        }
    });
}

/*资讯-删除*/
function article_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: SCOPE.del_url,
            dataType: 'json',
            data:{'id':id},
            success: function(data){
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            },
            error:function(data) {
                layer.msg(data.msg);
            },
        });
    });
}

/*资讯-审核*/
function article_shenhe(obj,id){
    layer.confirm('审核文章？', {
            btn: ['通过','不通过','取消'],
            shade: false,
            closeBtn: 0
        },
        function(){
            $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布', {icon:6,time:1000});
        },
        function(){
            $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
            $(obj).remove();
            layer.msg('未通过', {icon:5,time:1000});
        });
}
/*资讯-下架*/
function article_stop(obj,id){
    layer.confirm('确认要下架吗？',function(index){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
        $(obj).remove();
        layer.msg('已下架!',{icon: 5,time:1000});
    });
}

/*资讯-发布*/
function article_start(obj,id){
    layer.confirm('确认要发布吗？',function(index){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
        $(obj).remove();
        layer.msg('已发布!',{icon: 6,time:1000});
    });
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
    $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
    $(obj).parents("tr").find(".td-manage").html("");
    layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

//获取城市列表
$(".cityId").change(function () {
    var city_id=$(this).val(),
        url=SCOPE.city_url,
        postData={'id':city_id}
    $.post(url,postData,function (result) {
        if(result.status==1){
            //将信息填充到select;
            var data=result.data,
                html='';
            $(data).each(function (i) {
                html+=" <option value='"+this.id+"'>"+this.name+"</option>";
            })
            $(".se_city_id").html(html);
        }else if(result.status==0){
            $(".se_city_id").html('');
        }
    },'JSON');
})

//获取分类列表
$(".categoryId").change(function () {
    var category_id=$(this).val(),
        url=SCOPE.category_url,
        postData={'id':category_id}
    $.post(url,postData,function (result) {
        if(result.status==1){
            //将信息填充到select;
            var data=result.data,
                html='';
            $(data).each(function (i) {
                html+=" <input name='se_category_id[]' type='checkbox' id='checkbox-moban' value='" + this.id + "'>"+this.name;
                html+="<label for='checkbox-moban' >&nbsp;</label>"
            })
            $(".category_child_id").html(html);
        }else if(result.status==0){
            $(".category_child_id").html('');
        }
    },'JSON');
})

$(".change_captcha").click(function () {
    var img = $(this).children('img');
    var src =img.attr('src');
    img.attr('src',src+'?'+Math.random());
})
