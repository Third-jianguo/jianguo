<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--<LINK rel="Bookmark" href="/favicon.ico" >-->
    <!--<LINK rel="Shortcut Icon" href="/Public/admin/favicon.ico" />-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/admin/lib/html5.js"></script>
    <script type="text/javascript" src="/Public/admin/lib/respond.min.js"></script>
    <script type="text/javascript" src="/Public/admin/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/lib/Hui-iconfont/1.0.7/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Huploadify/Huploadify.css" />
    <link href="/Public/kindeditor/themes/default/default.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/ztree/zTreeStyle.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/page.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/right-down-tip.css" />

	
	<!-- 测试图片上传CSS样式 -->
	<link rel="stylesheet" href="/Public/admin/static/h-ui.admin/css/jquery.fileupload.css">
	
	<!--  js  -->
	<script src="/Public/js/jquery2.1.4.min.js"></script>
	<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/jquery.fileupload.js"></script>
	
	
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>

    <!--<script>DD_belatedPNG.fix('*');</script>-->
    <![endif]-->
    <title>后台管理系统</title>


</head>

<body>

<div>
    <nav class="breadcrumb"><i class="fa fa-home"></i> 관리자 일기
    </nav>
    <form action="/index.php/Admin/Admin/log_view" >
        <div class="page-container">
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th>No.</th>
                        <th>접속ID</th>
                        <th>시간</th>
                        <th>접속IP</th>
                        <th>실행</th>
                        <th>类型</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr class="text-c va-m">
                            <td><span class="label label-success radius"><?php echo ($k); ?></span></td>
                            <td><?php echo ($vo["admin_name"]); ?></td>
                            <td><?php echo ($vo["time"]); ?></td>
                            <td><?php echo ($vo["login_ip"]); ?></td>
                            <td><?php echo ($vo["details"]); ?></td>
                            <td><?php if(($vo["type"]) == "1"): ?>用户<?php else: ?>管理员<?php endif; ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <div class="scott"><?php echo ($page); ?></div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Huploadify/jquery.Huploadify.js"></script>
<script type="text/javascript" src="/Public/kindeditor/kindeditor-all.js"></script>
<script src="/Public/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/Public/ztree/jquery.ztree.all.js"></script>
<script type="text/javascript" src="/Public/js/md5.js"></script>
<script type="text/javascript">
    /*资讯-添加*/
    function article_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-添加*/
    function picture_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*产品-添加*/
    function product_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*用户-添加*/
    function member_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
</script>
</body>
</html>