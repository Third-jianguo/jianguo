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


<nav class="breadcrumb"><i class="fa fa-cog"></i>全局菜单管理设置，修改后需要清除缓存！图标查看网址：http://fontawesome.dashgame.com 
    </nav>
<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-border table-bordered">
            <tr>
                <th>No.</th>
                <th>类型</th>
                <th>验证</th>
                <th align="center">图标</th>
                <th>名称</th>
                <th>控制器</th>
                <th>方法</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td width="30"><span class="label label-success radius"><?php echo ($vo["id"]); ?></span></td>
                    <td width="30">
                        <?php if(($vo["level"]) == "1"): ?><span class="label label-secondary radius">菜单</span><?php endif; ?>
                        <?php if(($vo["level"]) == "2"): ?><span class="label label-secondary radius">模型</span><?php endif; ?>
                        <?php if(($vo["level"]) == "3"): ?><span class="label label-secondary radius">方法</span><?php endif; ?>
                    </td>
                    <td width="30">
                        <?php if(($vo["verify"]) == "1"): ?><span class="label label-primary radius">是</span><?php endif; ?>
                        <?php if(($vo["verify"]) == "2"): ?><span class="label label-primary radius">否</span><?php endif; ?>
                    </td>
                    <td width="25" align="center"><i class="fa fa-<?php echo ($vo["icon"]); ?>"></i></td>
                    <td><?php echo ($vo["number_str"]); echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["controller"]); ?></td>
                    <td><?php echo ($vo["action"]); ?></td>
                    <td class="td-manage" width="60">
                        <?php if(is_array($ActBtns)): $i = 0; $__LIST__ = $ActBtns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$btn): $mod = ($i % 2 );++$i;?><a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" class="<?php echo ($btn["action"]); ?>">
                                <i class="fa fa-<?php echo ($btn["icon"]); ?>"></i>&nbsp;
                            </a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </td>
                </tr>
                <!--<?php if(empty($vo["number"])): ?>-->
                    <!--<tr>-->
                        <!--<td width="30"><span class="label label-success radius"><?php echo ($vo["id"]); ?></span></td>-->
                        <!--<td width="30">-->
                            <!--<?php if(($vo["level"]) == "1"): ?><span class="label label-secondary radius">菜单</span><?php endif; ?>-->
                            <!--<?php if(($vo["level"]) == "2"): ?><span class="label label-secondary radius">模型</span><?php endif; ?>-->
                            <!--<?php if(($vo["level"]) == "3"): ?><span class="label label-secondary radius">方法</span><?php endif; ?>-->
                        <!--</td>-->
                        <!--<td width="30">-->
                            <!--<?php if(($vo["verify"]) == "1"): ?><span class="label label-primary radius">是</span><?php endif; ?>-->
                            <!--<?php if(($vo["verify"]) == "2"): ?><span class="label label-primary radius">否</span><?php endif; ?>-->
                        <!--</td>-->
                        <!--<td width="25" align="center"><i class="fa fa-<?php echo ($vo["icon"]); ?>"></i></td>-->
                        <!--<td><?php echo ($vo["name"]); ?></td>-->
                        <!--<td>------</td>-->
                        <!--<td>------</td>-->
                        <!--<td class="td-manage" width="60">-->
                            <!--<?php if(is_array($ActBtns)): $i = 0; $__LIST__ = $ActBtns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$btn): $mod = ($i % 2 );++$i;?>-->
                                <!--<a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" class="<?php echo ($btn["action"]); ?>">-->
                                    <!--<i class="fa fa-<?php echo ($btn["icon"]); ?>"></i>&nbsp;-->
                                <!--</a>-->
                            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--</td>-->
                    <!--</tr>-->
                <!--<?php endif; ?>-->
                <!--<?php if(($vo["number"]) == "1"): ?>-->
                    <!--<tr>-->
                        <!--<td width="30"><span class="label label-success radius"><?php echo ($vo["id"]); ?></span></td>-->
                        <!--<td width="30">-->
                            <!--<?php if(($vo["level"]) == "1"): ?><span class="label label-secondary radius">菜单</span><?php endif; ?>-->
                            <!--<?php if(($vo["level"]) == "2"): ?><span class="label label-secondary radius">模型</span><?php endif; ?>-->
                            <!--<?php if(($vo["level"]) == "3"): ?><span class="label label-secondary radius">方法</span><?php endif; ?>-->
                        <!--</td>-->
                        <!--<td width="30">-->
                            <!--<?php if(($vo["verify"]) == "1"): ?><span class="label label-primary radius">是</span><?php endif; ?>-->
                            <!--<?php if(($vo["verify"]) == "2"): ?><span class="label label-primary radius">否</span><?php endif; ?>-->
                        <!--</td>-->
                        <!--<td width="25" align="center"><i class="fa fa-<?php echo ($vo["icon"]); ?>"></i></td>-->
                        <!--<td>├─ ─ ─ ─ ─<?php echo ($vo["name"]); ?></td>-->
                        <!--<td><?php echo ($vo["controller"]); ?></td>-->
                        <!--<td><?php echo ($vo["action"]); ?></td>-->
                        <!--<td class="td-manage" width="60">-->
                            <!--<?php if(is_array($ActBtns)): $i = 0; $__LIST__ = $ActBtns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$btn): $mod = ($i % 2 );++$i;?>-->
                                <!--<a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" class="<?php echo ($btn["action"]); ?>">-->
                                    <!--<i class="fa fa-<?php echo ($btn["icon"]); ?>"></i>&nbsp;-->
                                <!--</a>-->
                            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--</td>-->
                    <!--</tr>-->
                <!--<?php endif; ?>-->
                <!--<?php if(($vo["number"]) == "2"): ?>-->
                    <!--<tr>-->
                        <!--<td width="30"><span class="label label-success radius"><?php echo ($vo["id"]); ?></span></td>-->
                        <!--<td width="30">-->
                            <!--<?php if(($vo["level"]) == "1"): ?><span class="label label-secondary radius">菜单</span><?php endif; ?>-->
                            <!--<?php if(($vo["level"]) == "2"): ?><span class="label label-secondary radius">模型</span><?php endif; ?>-->
                            <!--<?php if(($vo["level"]) == "3"): ?><span class="label label-secondary radius">方法</span><?php endif; ?>-->
                        <!--</td>-->
                        <!--<td width="30">-->
                            <!--<?php if(($vo["verify"]) == "1"): ?><span class="label label-primary radius">是</span><?php endif; ?>-->
                            <!--<?php if(($vo["verify"]) == "2"): ?><span class="label label-primary radius">否</span><?php endif; ?>-->
                        <!--</td>-->
                        <!--<td width="25" align="center"><i class="fa fa-<?php echo ($vo["icon"]); ?>"></i></td>-->
                        <!--<td>├ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─<?php echo ($vo["name"]); ?></td>-->
                        <!--<td><?php echo ($vo["controller"]); ?></td>-->
                        <!--<td><?php echo ($vo["action"]); ?></td>-->
                        <!--<td class="td-manage" width="60">-->
                            <!--<?php if(is_array($ActBtns)): $i = 0; $__LIST__ = $ActBtns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$btn): $mod = ($i % 2 );++$i;?>-->
                                <!--<a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" class="<?php echo ($btn["action"]); ?>">-->
                                    <!--<i class="fa fa-<?php echo ($btn["icon"]); ?>"></i>&nbsp;-->
                                <!--</a>-->
                            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--</td>-->
                    <!--</tr>-->
                <!--<?php endif; ?>--><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
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
<script>
    $(document).ready(function () {

        /**
         * 添加菜单按钮
         */
        $('.add').click(function () {
            var index = layer.open({
                type: 2,
                title: '<i class="fa fa-plus-square-o" style="color: red;"> </i> 新增树形菜单结构',
                area: ['700px', '470px'],
                fix: false, //不固定
                content: '/index.php/Admin/Setting/add',
                btn: ['确定', '关闭'],
                yes: function () {
                    var form = layer.getChildFrame('form', index);
                    $.post('/index.php/Admin/Setting/add', form.serialize(), function (data) {
                        if (data.status == 1) {
                            layer.msg(data.msg, {
                                time: 2000,
                                end: function () {
                                    layer.close(index);
                                    window.location.reload();
                                }
                            })
                        } else {
                            layer.msg(data.msg, function () {
                            });
                        }

                    }, 'json')
                }
            });
        });
        /**
         * 修改菜单按钮单击
         */
        $('.save').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.open({
                type: 2,
                title: '<i class="fa fa-plus-square-o" style="color: red;"> </i> 编辑' + title,
                area: ['700px', '470px'],
                fix: false, //不固定
                content: '/index.php/Admin/Setting/save/id/' + id,
                btn: ['确定', '关闭'],
                yes: function () {
                    var form = layer.getChildFrame('form', index);
                    $.post('/index.php/Admin/Setting/save', form.serialize(), function (data) {
                        if (data.status == 1) {
                            layer.msg(data.msg, {
                                time: 2000,
                                end: function () {
                                    layer.close(index);
                                    window.location.reload();
                                }
                            })
                        } else {
                            layer.msg(data.msg, function () {
                            });
                        }

                    }, 'json')
                }
            });

        })
        /**
         * 删除数据
         */

        $('.del').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.msg('是否删除' + title + '? <br>删除后不可恢复，请谨慎操作！', {
                icon: 5,
                time: 0,
                shade: [0.8, '#393D49'],
                btn: ['删除', '取消'],
                yes: function () {
                    layer.close(index);
                    $.post('/index.php/Admin/Setting/del', {id: id}, function (data) {
                        if (data.status == 1) {
                            layer.msg(data.msg, {
                                time: 1000, end: function () {
                                    window.location.reload();

                                }
                            })
                        } else {
                            layer.msg(data.msg, function () {
                            });
                        }

                    }, 'json');

                }

            });


        })
        //-----------------------------------------------------
    })
</script>