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

    <!--socket-->
    <script type="text/javascript" src="/Public/admin/webSocket/swfobject.js"></script>
    <script type="text/javascript" src="/Public/admin/webSocket/web_socket.js"></script>


    <!--<script>DD_belatedPNG.fix('*');</script>-->
    <![endif]-->
    <title>后台管理系统</title>


    <script language="javascript">
        connect();
        if (typeof console == "undefined") {
            this.console = {
                log: function (msg) {
                }
            };
        }
        WEB_SOCKET_SWF_LOCATION = "/Public/btc/swf/WebSocketMain.swf";
        // 开启flash的websocket debug
        WEB_SOCKET_DEBUG = true;
        var ws, name, admin_id, client_list = {};
        var round = 9999;
        var order_id = "<?php echo ($_GET['id']); ?>";
        admin_id = "<?php echo ($_SESSION['admin']['id']); ?>";
        name = "<?php echo ($_SESSION['admin']['username']); ?>";
        function connect() {
            ws = new WebSocket("ws://" + document.domain + ":7272");
            ws.onopen = onopen;
            ws.onmessage = onmessage;
            ws.onclose = function () {
            console.log("连接关闭，定时重连");
                connect();
            };
            ws.onerror = function () {
            console.log("出现错误");
            };
        }
        // 连接建立时发送登录信息
        function onopen() {
            var login_data = '{"type":"admin_login","msg_type":"tip","client_id":"'+admin_id+'","client_name":"' + name + '","content":"登录"}';
        console.log("websocket握手成功");
            ws.send(login_data);
        }

        // 服务端发来消息时
        function onmessage(e) {
            console.log(e.data);
            var data = JSON.parse(e.data);
            switch (data['type']) {
                case 'ping':
                    ws.send('{"type":"pong"}');
                    break;
                case 'admin_login':
//                console.log(data['client_name'] + "登录成功");
                    round = data['round'];
                    break;

                case 'timer':
                    round = data['round'];
                    test( data['round'] );
                    break;
                case 'logout':
//                say(data['from_client_id'], data['from_client_name'], data['from_client_name'] + ' 退出了', data['time']);
//                delete client_list[data['from_client_id']];
            }
        }


            function test( roundVal ){
                $(".show_iframe").each(function(e){
                    if($(this).css("display") == 'block'){
    //                        console.log($(this).find("iframe"));
                        iframe_show = $(this).find("iframe")[0];
    //                            console.log(iframe_show)
                        game_round = iframe_show.contentWindow.document.getElementById('game_round');
    //                            console.log(game_round);
                        $(game_round).html(roundVal);
                    }
                });
            }

    </script>


</head>

<body>
<!--.-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"><a class="logo navbar-logo f-l mr-10 hidden-xs navbar_fa_font" href=""><!--<i
                class="fa fa-location-arrow"></i>--><!--<i class="navbar_fa_logo"></i>--> 后台管理系统</a>
            <a class="logo navbar-logo-m f-l mr-10 visible-xs" href=""></a>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
                <ul class="cl">
                   <!-- <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i
                            class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="article_add('添加资讯','<?php echo U('News/add');?>')"><i
                                    class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
                            <li><a href="javascript:;" onclick="picture_add('添加图片','<?php echo U('Images/add');?>')"><i
                                    class="Hui-iconfont">&#xe613;</i> 图片</a></li>
                            <li><a href="javascript:;" onclick="product_add('添加产品','<?php echo U('Goods/add');?>')"><i
                                    class="Hui-iconfont">&#xe620;</i> 产品</a></li>
                        </ul>
                    </li>-->
                    <!--<li class="dropDown dropDown_hover"><a href="javascript:;" class="clearche"><i class="Hui-iconfont">
                        &#xe6e5;</i> 更新缓存</a>
                    </li>-->
                </ul>
            </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <!--<li>欢迎您回来！</li>-->
                    <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><i class="admin_icon"></i><?php echo ($_SESSION['admin']['username']); ?>
                        <!--<i class="Hui-iconfont">&#xe6d5;</i>--></a>
                        <!--<ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;">个人资料</a></li>
                            <li><a href="<?php echo U('Login/index');?>">切换账户</a></li>
                            <li><a href="<?php echo U('Login/index');?>">退出</a></li>
                        </ul>-->
                    </li>
                    <!--<li id="Hui-msg"><a href="#" title="消息"><span class="badge badge-danger">1</span><i
                            class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a></li>-->
                            <li class="dropDown dropDown_hover"><a href="javascript:;" class="clearche"><!--<i class="Hui-iconfont">
                        &#xe6e5;</i>--><i class="cache_icon"></i> 更新缓存</a>
                    </li>
                            <!--<li><a href="<?php echo U('Login/index');?>"><i class="switch_icon"></i>切换账户</a></li>-->
                            <li><a href="<?php echo U('Login/index');?>"><i class="exit_icon"></i>退出</a></li>
                    <!--<li id="Hui-skin" class="dropDown right dropDown_hover"><a href="javascript:;"
                                                                               class="dropDown_A" title="换肤"><i
                            class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                        	<li><a href="javascript:;" data-val="blue" title="默认（蓝色）">默认（蓝色）</a></li>
                            <li><a href="javascript:;" data-val="default" title="黑色">黑色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
                        </ul>
                    </li>-->
                </ul>
            </nav>
        </div>
    </div>
</header>
<aside class="Hui-aside">
    <input runat="server" id="divScrollValue" type="hidden" value=""/>
    <div class="menu_dropdown bk_2">
        <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl id="menu-<?php echo ($vo["id"]); ?>">
                <dt class="aside_fa_dt"><i class="aside_fa_sty fa fa-<?php echo ($vo["icon"]); ?>"></i><span class="aside_fa_nam"> <?php echo ($vo["name"]); ?></span><i class="Hui-iconfont menu_dropdown-arrow aside_fa_arw">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <?php if(is_array($vo["items"])): $i = 0; $__LIST__ = $vo["items"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a _href="/index.php/Admin/<?php echo ($v["controller"]); ?>/<?php echo ($v["action"]); ?>" data-title="<?php echo ($v["name"]); ?>" href="javascript:void(0)"><i class="fa fa-<?php echo ($v["icon"]); ?>"></i> <?php echo ($v["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
                </dd>
            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
</div>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active"><span title="我的桌面" data-href="welcome.html">我的桌面</span><em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S"
                                                  href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a
                id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">
            &#xe6d7;</i></a></div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="/index.php/Admin/Index/welcome.html"></iframe>
        </div>
    </div>
</section>
<style>
	a{text-decoration: none;}
.popup{
	position: fixed;
	right: 0;
	bottom: 0;
	width:250px;
	overflow: hidden;
	height: 150px;
	background-color: rgba(0,0,0,0.5);
	z-index: 999;
}
.popup-window{
	width: 250px;
	overflow: hidden;
	height: 150px;
	margin: 0 auto 0 auto;
	background-color: #FFFFFF;
	border-radius: 5px;
	text-align: center;
}
.popup-title{
	background-color: #007fff;
	border-radius: 5px 5px 0 0;
	color: #FFFFFF;
	line-height: 24px;
	font-size: 14px;
}
.popup-content{
	font-size: 16px;
	line-height: 28px;
	color: #323232;
}
.popup-content p{
	margin: 15px auto;
}
.popup-btn{
	overflow: hidden;
	margin: 0 auto 10px auto;
	font-size: 14px;
	line-height: 30px;
}
.cancel{
	background-color: #a9a9a9;
	width: 95px;
	float: left;
	margin: 0 10px 0 20px;
	color: #FFFFFF;
	border-radius: 30px;
}
.cancel:hover{
	background-color: #848484;
	color: #FFFFFF;
}
.sure{
	background-color: #007fff;
	width: 95px;
	float: left;
	margin: 0 20px 0 10px;
	color: #FFFFFF;
	border-radius: 30px;
}
.sure:hover{
	background-color: #016fde;
	color: #FFFFFF;
}
</style>
<div class="popup" id="dingzhi" style="display: none;">
    <div class="popup-window">
        <div class="popup-title">
            <p>新消息提醒</p>
        </div>
        <div class="popup-content">
            <p id="content">您有新消息<br>
            请您立即处理</p>
        </div>
        <div class="popup-btn">
            <a href="javascript:void(0)" class="cancel">稍后处理</a>
            <a href="javascript:void(0)" _href="" data-title="" class="sure" id="sure">立即处理</a>
        </div>
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
    $('.clearche').click(function () {

        $.post('<?php echo U("Index/clearchache");?>', function (data) {
            if (data.status == 1) {
                layer.msg(data.msg);
            }

        }, 'json');
    })
//	$(".sure").click(function(){
//        $("#dingzhi").css("display","none");
//    });
    $(".cancel").click(function(){
        $("#dingzhi").css("display","none");
    });

    $("#sure").click(function(){
        Hui_admin_tab($("#sure"));
        $("#dingzhi").css("display","none");
    });
    $("#cancelorderbtn").click(function(){
        $("#cancel_details").html('');
        $("#cancelorder").css("display","none");
    });
</script>