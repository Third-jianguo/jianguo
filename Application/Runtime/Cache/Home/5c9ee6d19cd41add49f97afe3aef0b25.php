<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>骰子</title>
    <link rel="stylesheet" href="/Public/game/css/style.css">
    <script language="javascript" src="/Public/js/jquery-3.2.1.min.js" ></script>
    <script language="javascript" src="/Public/game/js/jianguo.js" ></script>


    <!--socket-->
    <script type="text/javascript" src="/Public/admin/webSocket/swfobject.js"></script>
    <script type="text/javascript" src="/Public/admin/webSocket/web_socket.js"></script>
</head>
<!--顶部-->
<script language="javascript">
    //页面加载时间
    window.onload = function () {
//顶部悬浮(吸顶菜单)
//1)获取元素
        var topNav = document.getElementById("topNav");
//2)当滚动到指定位置是给#topNav添加fixed类
//绑定滚动事件 (gunlun/拖动滚动条)时执行函数中的代码
        window.onscroll = function () {
//console.log('1111');

//获取滚动条滚动过的距离
            var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
            // 当滚动到指定位置时给#topNav添加fixed类
            if (scrollTop >= 10) {
//给元素添加类:ele.className = 'xx';
                topNav.className = 'fixed';
            } else {
                topNav.className = 'hide';
            }
        }


    }
</script>

<script language="javascript">
    if (typeof console == "undefined") {
        this.console = {
            log: function (msg) {
            }
        };
    }
    WEB_SOCKET_SWF_LOCATION = "/Public/btc/swf/WebSocketMain.swf";
    // 开启flash的websocket debug
    WEB_SOCKET_DEBUG = true;
    var ws, name, uid, client_list = {};
//    var round = 9999;
//    var order_id = "<?php echo ($_GET['id']); ?>";
    name = '<?php echo ($user["nick_name"]); ?>';
    uid = '<?php echo ($user["id"]); ?>';
    status = '<?php echo ($user["status"]); ?>';

    if(uid != '' || uid != 0){
        connect();
    }

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

        var login_data = '{"type":"login","msg_type":"tip","client_id":"' + uid +'","client_name":"' + name + '","content":"登录"}';
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
            case 'login':
//                console.log(data['client_name'] + "登录成功");
                round = data['round'];
                break;

            case 'logout':
                console.log("logout success");
                $.post("/index.php/Home/User/logout", {}, function(){
                    window.location = "/";
                }, 'json');
//                say(data['from_client_id'], data['from_client_name'], data['from_client_name'] + ' 退出了', data['time']);
//                delete client_list[data['from_client_id']];
        }
    }

    function logout(){
        $.post("/index.php/Home/User/logout",{}, function(e){alert(e.msg);window.location = "/";},"json");
//        ws.send('{"type":"logout","client_id":"1","content":"退出登录"}');

    }
</script>



<body class="ever-bg">

<div class="top " id="topNav">
    <div class="top-left">
        <a href="/" >
            <img style="padding-left: 181px;" src="/Public/game/img/logo.png">
        </a>
    </div>
    <div class="top-right">
        <ul>
            <li><a href="/index.php/Home/Game/game_info"><img src="/Public/game/img/top_an.png">游戏说明</a></li>
            <li><a href=""><img src="/Public/game/img/top_an.png">游戏</a></li>
            <li><a href="/index.php/Home/Game/game_result"><img src="/Public/game/img/top_an.png">结果</a></li>
            <li><a href="/index.php/Home/Game/api"><img src="/Public/game/img/top_an.png">API</a></li>
            <li><a href="/index.php/Home/Announcement"><img src="/Public/game/img/top_an.png">网页公告</a></li>
            <?php if(!empty($user)): ?><li><a href="/index.php/Home/User/inputMoney"><img src="/Public/game/img/top_an.png">충전하기</a></li>
            <li><a href="/index.php/Home/User/changeMoney"><img src="/Public/game/img/top_an.png">환전하기</a></li>
            <li><a href="/index.php/Home/User/user_bet"><img src="/Public/game/img/top_an.png">个人押注</a></li>
            <li><a href="/index.php/Home/User/info"><img src="/Public/game/img/top_an.png">个人资料</a></li>
            <li><a href="/index.php/Home/Chat/"><img src="/Public/game/img/top_an.png">1V1咨询</a></li>
            <li><a href="javascript:void(0)" onclick="logout();"><img src="/Public/game/img/top_an.png">退出</a></li>
                <?php else: ?>
                <li><a href="/index.php/Home/User/login"><img src="/Public/game/img/top_an.png">登录</a></li><?php endif; ?>

        </ul>
    </div>
</div>
<?php if(!empty($user)): ?><div class="top-bottom">

    <div>
        <a href="/index.php/Home/News"><img src="/Public/game/img/top_an.png">쪽지함 <span style=" color:#b3966c;">(0)</span></a>
        <a href=""><img src="/Public/game/img/top_an.png">포인트 <span style=" color:#b3966c;"><?php echo ($user["point"]); ?></span> 원</a>

        <a href=""><img src="/Public/game/img/top_an.png">보유금액 <span style=" color:#b3966c;"><?php echo ($user["money"]); ?></span>원 </a>

        <a href=""><img src="/Public/game/img/top_an.png"><span style=" color:#b3966c;">Lv<?php echo ($user["rank"]); ?></span> <?php echo ($user["nick_name"]); ?></a>

    </div>


</div><?php endif; ?>


<div class="container-s pt-20">
    <div class="ever-top">

        <img src="/Public/game/img/tb2.png">

        <p>
            —————————— &nbsp; START &nbsp;THE &nbsp; GAME &nbsp;TOUR
        </p>
    </div>
    <div class="money_box_xinxi clearfloat" style="    margin-bottom: 0;">

        <div class="first_row22 clearfloat">
            <img style="       padding: 40px 0px;   width: 391px;" src="/Public/game/img/login.png">


        </div>


        <div class="new_money3" style="clear: both;    margin: 63px auto;">
            <form class="form-cont" id="form_login">
                <input type="hidden" value="<?php echo ($csrf); ?>" name="csrf" />
                <div class="">
                    <div class="page-content">
                        <div class="input-row" style="margin-top:20px;">
                            <label class="label fadeIn"><!-- 아이디 --></label>

                            <div class="box_login clearfloat">
                                <div class="name_text">User Id</div>
                                <input type="text" style="color:#fff;position: relative;z-index:999;" name="user_name" placeholder="" class="input fadeIn delay1">
                            </div>
                        </div>
                        <div class="input-row" style="margin-bottom:10px;">
                            <label class="label fadeIn delay2"><!-- 비밀번호 --></label>

                            <div class="box_login clearfloat">
                                <div class="name_text">Password</div>
                                <input style="color:#fff;position: relative;z-index:999;" type="password" name="password" placeholder="" class="input fadeIn delay3">
                            </div>
                        </div>

                        <div class="yanzheng clearfloat box_login rollOut animated" style="       z-index: 1; margin-top: 5px;margin-bottom: 10px;">

                            <img src="/index.php/Home/User/verify" id="codeImg" style="border:2px solid #9f9f9f;    margin-top: 2px;" onclick="this.src='/index.php/Home/User/verify?'+ Math.random()" title="" class="fadeIn delay3 te_box">
                            <input type="text" style="border:1px solid #9f9f9f;position: relative;z-index:999;" id="code" name="code" placeholder="코드입력..." class="fadeIn delay3 te_box02">
                        </div>
                        <div style="height:10px;">&nbsp;</div>
                        <div class="input-row perspective" style="text-align: center;position:relative;z-index:999;    height: 57px; margin-top: 6px;">

                            <input type="button" id="login" class="button load-btn fadeIn delay4" value="로그인">

                        </div>
                        <div class="input-row perspective" style="text-align: center;position:relative;z-index:999; margin-top: 26px;">
                            <input type="button" id="register" class="buttonB load-btn fadeIn delay4" value="회원가입">
                        </div>
                        <div style="width:400px;margin:0 auto; text-align:center; font-size:12px; font-weight:600;">
                            copyright © BAYUE all rights reserved
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
<script language="javascript">
    $(function(){
        $("#login").click(function(){
            form = serializeJson($("#form_login"));
            $.post("/index.php/Home/User/login", form, function(e){
                alert(e.msg);
                if(e.code == 1){
                    window.location = "/";
                }else{
                    $("#code").val('');
                    $("#code").focus();
                    $("#codeImg").click();
                }
            },"json");
        });
        $("#register").click(function(){window.location="/index.php/Home/User/register";});
    })
</script>