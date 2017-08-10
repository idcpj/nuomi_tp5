<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"D:\phpStudy\WWW\nuomi_tp5\public/../application/admin\view\category\index.html";i:1501774115;s:76:"D:\phpStudy\WWW\nuomi_tp5\public/../application/admin\view\public\_meta.html";i:1501714147;s:78:"D:\phpStudy\WWW\nuomi_tp5\public/../application/admin\view\public\_footer.html";i:1501715183;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="Bookmark" href="/favicon.ico" >
  <link rel="Shortcut Icon" href="/favicon.ico" />
  <!--[if lt IE 9]>
  <script type="text/javascript" src="__STATIC__/admin/hui/lib/html5shiv.js"></script>
  <script type="text/javascript" src="__STATIC__/admin/hui/lib/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui/css/H-ui.min.css" />
  <link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/css/H-ui.admin.css" />
  <link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/lib/Hui-iconfont/1.0.8/iconfont.css" />
  <link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/skin/default/skin.css" />
  <link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/css/style.css" />
  <script type="text/javascript" src="__STATIC__/admin/hui/lib/DD_belatedPNG_0.0.8a-min.js"></script>
  <link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/common.css" />

  <!--[if IE 6]>
  <script>DD_belatedPNG.fix('*');</script>
  <![endif]-->
  <title>H-ui.admin v3.1</title>
  <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
  <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	资讯管理
	<span class="c-gray en">&gt;</span>
	资讯列表
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="Hui-article">
	<article class="cl pd-20">
		<div class="cl pd-5 bg-1 bk-gray mt-20">
			<span class="l">
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
			<a class="btn btn-primary radius" data-title="添加分类" _href="<?php echo url('Category/add'); ?>"
			   onclick="layer_show('添加分类','<?php echo url('Category/add'); ?>')" href="javascript:;"><i
					class="Hui-iconfont">&#xe600;</i> 添加分类</a>
			</span>
			<span class="r">共有数据：<strong>54</strong> 条</span>
		</div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="orderlist[]" value=""></th>
						<th width="80">ID</th>
						<th width="20">排序</th>
						<th width="80">分类</th>
						<th width="80">添加时间</th>
						<th width="60">发布状态</th>
						<th width="120">操作</th>
					</tr>
				</thead>
				<tbody>

				<?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr class="text-c">
						<td><input type="checkbox" value="" name="orderlist[]"></td>
						<td><?php echo $vo['id']; ?></td>
                        <td><input type="text" size="3" data-id="<?php echo $vo['id']; ?>" name="listorder" value="<?php echo $vo['listorder']; ?>"></td>
                        <td class="text-l"><?php echo $vo['name']; ?></td>
						<td><?php echo $vo['create_time']; ?></td>
						<td class="td-status"><a href="javascript:;" onClick="o2o_status('<?php echo url('Category/status',['id'=>$vo['id'],'status'=>$vo->getData('status')==1?0:1]); ?>')"><?php echo $vo['status']; ?></a></td>
						<td class="f-14 td-manage">
							<a style="text-decoration:none"  href="<?php echo url('category/index',['parent_id'=>$vo['id']]); ?>" title="获取子栏目">获取子栏目</a>
							<a style="text-decoration:none" class="ml-5" onClick="layer_show('编辑','<?php echo url('category/edit',['id'=>$vo['id']]); ?>')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
							<a style="text-decoration:none" class="ml-5" onClick="o2o_status('<?php echo url('Category/status',['id'=>$vo['id'],'status'=>-1]); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</article>
	<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o"><?php echo $categorys->render(); ?></div>
</div>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/laypage/1.2/laypage.js"></script>
<!--<script type="text/javascript" src="__STATIC__/admin/hui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>-->
<script type="text/javascript" src="__STATIC__/admin/js/common.js"></script>
<!--<script type="text/javascript" src="__STATIC__/admin/uploadify/jquery.uploadify.min.js"></script>-->
<!--<script type="text/javascript" src="__STATIC__/admin/js/image.js"></script>-->



<script>
var SCOPE={
    'listorder_url':"<?php echo url('Category/listorder'); ?>",
}

</script>
</body>
</html>