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
    <nav class="breadcrumb"><i class="fa fa-home"></i> 用户管理
        <div class="nav_right_nav">
            <?php if(is_array($ActBtns)): $i = 0; $__LIST__ = $ActBtns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$btn): $mod = ($i % 2 );++$i; if(($btn["action"]) == "add"): ?><a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" class="<?php echo ($btn["action"]); ?> add message-right">
                        <i class="fa fa-<?php echo ($btn["icon"]); ?>"></i><?php echo ($btn["name"]); ?>
                    </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <a href="javascript:void(0);" class="downloadexcel message-right">
                <i class="fa fa-file-excel-o "></i>导出excel
            </a>
        </div>
    </nav>
    <form action="/index.php/Admin/User/index">
        <div class="search_list">
            <span class="search_list_content">
                用户：<input type="text" name="keyword" style="width: 175px" placeholder="ID/昵称" value="<?php echo ($search["keyword"]); ?>" class="search_input"/>
            </span>

            <span class="search_list_content">
                时间：<input type="text" name="start_time" value="<?php echo ($search["start_time"]); ?>" class="search_input" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="width: 100px;"/>
                至 <input type="text" name="end_time" value="<?php echo ($search["end_time"]); ?>" class="search_input" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="width: 100px;"/>
            </span>

            <span class="search_list_content">
                会员状态：<select name="status" class="search_input">
                <option value="999">--全部--</option>
                <option value="0">正常</option>
                <option value="1">黑名单</option>
            </select>
            </span>

            <span class="search_list_content">
                会员分类：<select name="category" class="search_input">
                <option value="">--全部--</option>
                <option value="0">正常</option>
                <option value="1">黑名单</option>
            </select>
            </span>
            <span class="search_list_content">
                今日押注：<select name="category" class="search_input">
                <option value="">--全部--</option>
                <option value="0">是</option>
                <option value="1">否</option>
            </select>
            </span>
            <span class="search_list_content">
                备注查询：<input type="text" name="comment" value="<?php echo ($search["comment"]); ?>" class="search_input"/>
            </span>
            <span class="search_list_content">
                推荐码：<input type="text" name="invite_code" value="<?php echo ($search["invite_code"]); ?>" class="search_input"/>
            </span>

            <span class="search_list_content">
                推荐人：<select name="parent_user_id" class="search_input">
                <option value="">--全部--</option>
                <?php if(is_array($parentList)): $i = 0; $__LIST__ = $parentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($parent["id"]); ?>"><?php echo ($parent["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </span>

            <!--排序-->
            <input type="text" name="display_order" id="display_order" value="<?php echo ($search["display_order"]); ?>"/>
            <input type="text" name="excel" id="excel"/>
            <input type="text" name="display_order_field" id="display_order_field" value="<?php echo ($search["display_order_field"]); ?>"/>

        <span class="search_list_content">
            <input type="submit" value="查询" class="btn_fa_css btn btn-primary" style="margin:0;"/></span>
        </div>
        <div class="page-container">
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <!--<th width="20"><input name="" type="checkbox" value=""></th>-->
                        <th width="30">No.</th>
                        <th class="name" onclick="displayOrder('name');">用户</th>
                        <th class="rank" onclick="displayOrder('rank');">级别</th>
                        <th class="money" onclick="displayOrder('money');">金币</th>
                        <th class="point" onclick="displayOrder('point');">point</th>
                        <th class="tel" onclick="displayOrder('tel');">联系电话</th>
                        <th class="tel" onclick="displayOrder('xx');">充、换值额、差额</th>
                        <th class="tel" onclick="displayOrder('xx');">月充、换值额、差额</th>
                        <th class="bet_count" onclick="displayOrder('bet_count');">押注次数</th>
                        <th class="parent_user_id" onclick="displayOrder('parent_user_id');">推荐人</th>
                        <th class="createtime" onclick="displayOrder('createtime');">注册时间</th>
                        <th class="last_login_time" onclick="displayOrder('last_login_time');">最近登录时间</th>
                        <th class="status" onclick="displayOrder('status');">状态</th>
                        <th width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($list)): ?><tr class="text-c va-m">
                            <td colspan="6">暂无符合条件的数据！</td>
                        </tr>
                        <?php else: ?>
                        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr class="text-c va-m">
                                <td><span class="label label-success radius"><?php echo ($k); ?></span></td>
                                <td><img src="<?php echo ($vo["head_img"]); ?>" width="50" height="50"
                                         onerror="this.src='/Public/images/noHead.png'"/> <?php echo ($vo["nick_name"]); ?>
                                </td>
                                <td><?php echo ($vo["rank"]); ?></td>
                                <td><?php echo ($vo["money"]); ?></td>
                                <td><?php echo ($vo["point"]); ?></td>
                                <td><?php echo ($vo["tel"]); ?></td>
                                <td><?php echo ($vo["tel"]); ?></td>
                                <td><?php echo ($vo["tel"]); ?></td>
                                <td><?php echo ($vo["bet_count"]); ?></td>
                                <td><?php echo ($vo["parent_user_name"]); ?></td>
                                <td><?php echo (date("Y-m-d H:s:i",$vo["createtime"])); ?></td>
                                <td><?php echo (date("Y-m-d H:s:i",$vo["last_login_time"])); ?></td>
                                <td><?php echo ($vo["status"]); ?></td>
                                <td class="td-manage">
                                    <?php if(is_array($ActBtns)): $i = 0; $__LIST__ = $ActBtns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$btn): $mod = ($i % 2 );++$i; if(($btn["action"]) != "add"): if(($vo["status"]) == "1"): if(($btn["action"]) != "black"): ?><a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["title"]); ?>" class="<?php echo ($btn["action"]); ?>">
                                                        <i class="fa fa-<?php echo ($btn["icon"]); ?>"></i>
                                                    </a><?php endif; ?>

                                    <?php else: ?>
                                                <?php if(($btn["action"]) != "returnBlack"): ?><a href="javascript:;" title="<?php echo ($btn["name"]); ?>" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["title"]); ?>" class="<?php echo ($btn["action"]); ?>">
                                                        <i class="fa fa-<?php echo ($btn["icon"]); ?>"></i>
                                                    </a><?php endif; endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
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
<script>
    $(document).ready(function () {
        /* 添加菜单按钮单击 */
        $('.add').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.open({
                type: 2,
                title: '<i class="fa fa-plus-square-o" style="color: red;"> </i> 添加',
                area: ['85vw', '85vh'],
                fix: false, //不固定
                content: '/index.php/Admin/User/add/',
                btn: ['确定', '关闭'],
                yes: function () {
                    var form = layer.getChildFrame('form', index);
                    $.post('/index.php/Admin/User/add', form.serialize(), function (data) {
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
        /* 修改按钮单击 */
        $('.save').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.open({
                type: 2,
                title: '<i class="fa fa-plus-square-o" style="color: red;"> </i> 编辑' + title,
                area: ['85vw', '85vh'],
                fix: false, //不固定
                content: '/index.php/Admin/User/save/id/' + id,
                btn: ['确定', '关闭'],
                yes: function () {
                    var form = layer.getChildFrame('form', index);
                    $.post('/index.php/Admin/User/save', form.serialize(), function (data) {
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
        /* 删除数据 */
        $('.black').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.msg('是否将' + title + '加入黑名单? <br>', {
                icon: 5,
                time: 0,
                shade: [0.8, '#393D49'],
                btn: ['确定', '取消'],
                yes: function () {
                    layer.close(index);
                    $.post('/index.php/Admin/User/black', {id: id}, function (data) {
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
        /* returnBlack */
        $('.returnBlack').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.msg('是否将' + title + '移出黑名单? <br>', {
                icon: 5,
                time: 0,
                shade: [0.8, '#393D49'],
                btn: ['确定', '取消'],
                yes: function () {
                    layer.close(index);
                    $.post('/index.php/Admin/User/returnBlack', {id: id}, function (data) {
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
        /* 查看单击 */
        $('.view').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.open({
                type: 2,
                title: '<i class="fa fa-plus-square-o" style="color: red;"> </i> 查看' + title,
                area: ['85vw', '85vh'],
                fix: false, //不固定
                content: '/index.php/Admin/User/view/id/' + id,
                btn: ['关闭'],
                yes: function () {
                    layer.close(index);
                }
            });
        })


//        调整余额
        $('.money_change').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.open({
                type: 2,
                title: '<i class="fa fa-plus-square-o" style="color: red;"> </i> 编辑' + title,
                area: ['85vw', '85vh'],
                fix: false, //不固定
                content: '/index.php/Admin/User/money_change/id/' + id,
                btn: ['确定', '关闭'],
                yes: function () {
                    var form = layer.getChildFrame('form', index);
                    $.post('/index.php/Admin/User/money_change', form.serialize(), function (data) {
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
//        日志
        $('.user_log').click(function () {
            var title = $(this).data('name');
            var id = $(this).data('id');
            var index = layer.open({
                type: 2,
                title: '<i class="fa fa-plus-square-o" style="color: red;"> </i> 编辑' + title,
                area: ['85vw', '85vh'],
                fix: false, //不固定
                content: '/index.php/Admin/User/user_log/id/' + id,
                btn: ['确定', '关闭'],
                yes: function () {
                    var form = layer.getChildFrame('form', index);
                    $.post('/index.php/Admin/User/user_log', form.serialize(), function (data) {
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
        //-----------------------------------------------------
    })
</script>
<script>
    $(function () {
        var display_order = $("#display_order").val();
        var display_order_field = $("#display_order_field").val();
        //加载后给class
        $("." + display_order_field).addClass(display_order);
    });

    function displayOrder(name) {
        if ($("." + name).hasClass("desc")) {
            //倒序变正序
            $("." + name).removeClass("desc");
            $("." + name).addClass("asc");
            $("#display_order").val('asc');
            $("#display_order_field").val(name);
        } else if ($("." + name).hasClass("asc")) {
            //正序变无序
            $("." + name).removeClass("asc");
            $("." + name).removeClass("desc");
            $("#display_order").val('');
            $("#display_order_field").val('');
        } else {
            //无序变倒序
            $("." + name).addClass("desc");
            $("#display_order").val('desc');
            $("#display_order_field").val(name);
        }
        //提交
        $(".btn").click();
    }

    $(".downloadexcel").click(function () {
        $("#excel").val('excel');
        $(".btn").click();
        $("#excel").val('');

    });
</script>