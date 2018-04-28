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

<script type="text/javascript" src="/Public/laydate/laydate.js"></script>

<div>
    <form action="/index.php/Admin/User/user_log">
        <div class="search_list">

  <span class="search_list_content">

条件： <select name="log_type" class="search_input">
      <option value="0"
      <?php if(($search["log_type"]) == "0"): ?>selected<?php endif; ?>
      >登录日志</option>
      <option value="1"
      <?php if(($search["log_type"]) == "1"): ?>selected<?php endif; ?>
      >充值记录</option>
      <option value="2"
      <?php if(($search["log_type"]) == "2"): ?>selected<?php endif; ?>
      >换值记录</option>
      <option value="3"
      <?php if(($search["log_type"]) == "3"): ?>selected<?php endif; ?>
      >金币记录</option>
      <option value="4"
      <?php if(($search["log_type"]) == "4"): ?>selected<?php endif; ?>
      >point记录</option>
      <option value="5"
      <?php if(($search["log_type"]) == "5"): ?>selected<?php endif; ?>
      >押注记录</option>
  </select></span>


            <span class="search_list_content">&nbsp;时间：
        <input type="text" name="start_time" value="<?php echo ($search["start_time"]); ?>" class="search_input" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="width: 100px;"/>
        至 <input type="text" name="end_time" value="<?php echo ($search["end_time"]); ?>" class="search_input" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="width: 100px;"/>
        </span>
            <input type="text" name="id" value="<?php echo ($_GET['id']); ?>" />

        <span class="search_list_content">
        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="查询" class="btn_fa_css btn btn-primary"
                                       style="margin:0;"/></span>
        </div>
        <div class="page-container">
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <!--<th width="20"><input name="" type="checkbox" value=""></th>-->
                        <th width="30">No.</th>
                        <th>用户</th>
                        <th>日志类型</th>
                        <th>金币/point</th>
                        <th>说明</th>
                        <th>时间</th>
                        <th>IP</th>
                        <!--<th width="100">操作</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($list)): ?><tr class="text-c va-m">
                            <td colspan="6">暂无符合条件的数据！</td>
                        </tr>
                        <?php else: ?>
                        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr class="text-c va-m">
                                <td><span class="label label-success radius"><?php echo ($k); ?></span></td>
                                <td><?php echo ($vo["nick_name"]); ?></td>
                                <td><?php echo ($vo["log_type"]); ?></td>
                                <td><?php echo ($vo["type"]); echo ($vo["money_type"]); echo ($vo["number"]); ?></td>
                                <td><?php echo ($vo["msg"]); ?></td>
                                <td><?php echo (date("Y-m-d H:i:s",$vo["createtime"])); ?></td>
                                <td><?php echo ($vo["ip"]); ?></td>
                                <!--<td class="td-manage">-->
                                    <!--<?php if(is_array($ActBtns)): $i = 0; $__LIST__ = $ActBtns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$btn): $mod = ($i % 2 );++$i;?>-->
                                        <!--<?php if(($btn["action"]) != "add"): ?>-->
                                            <!--<a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["title"]); ?>" class="<?php echo ($btn["action"]); ?>">-->
                                                <!--<i class="fa fa-<?php echo ($btn["icon"]); ?>"></i>&nbsp;-->
                                            <!--</a>-->
                                        <!--<?php endif; ?>-->
                                    <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                                <!--</td>-->
                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>
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