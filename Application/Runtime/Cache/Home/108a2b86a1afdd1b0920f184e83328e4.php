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



<div>
    <div class="ever-top">
        <img src="/Public/game/img/tb2.png">
        <p>
            —————————— &nbsp; START &nbsp;THE &nbsp; GAME &nbsp;TOUR
        </p>
    </div>
    <div class="money_box_xinxi clearfloat" style="    margin-bottom: 0;">
        <div class="first_row clearfloat">
            <img style="       padding: 40px 0px;   width: 334px;" src="/Public/game/img/jieguo-Mbg.png">
            <img src="/Public/game/img/tb3.png" style=" display: block;">
            <h1 style="color:#fff;    padding: 27px 0;">GAME RESULTS</h1>
            <div class="third_row clearfloat">
                <div class="third_row_02 clearfloat">
                </div>
            </div>
        </div>

        <div class="new_money3" style="clear: both;    ">
            <table style="    background: #040d1c;">
                <tbody>
                    <tr>
                        <th style="background: #040d1e;border-top: 2px solid #040d1e;"><input type="text" id="search_time" style="color:#fff;position: relative;z-index:999;" placeholder="时间" class="delay1"></th>
                        <th style="background: #040d1e;border-top: 2px solid #040d1e;"><input type="text" style="color:#fff;position: relative;z-index:999;" placeholder="期数" id="search_round" class="delay1"></th>
                        <th style="background: #040d1e;border-top: 2px solid #040d1e;"><input id="searchbtn" type="submit" class="ab usersure" value="搜 索"></th>
                    </tr>
                </tbody>
            </table>
            <table width="1200" border="0" style="margin: 34px auto;" class="game_list" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <th>경기시간</th>
                    <th>리그</th>
                    <th>경기결과</th>
                </tr>

                <?php if(is_array($dice_result)): $i = 0; $__LIST__ = $dice_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>
                        <td width="150" class="betTd">
                           <?php echo ($result["round"]); ?> <?php echo (date("Y-m-d H:i:s",$result["createtime"])); ?>
                        </td>
                        <td width="50" class="betTd">
                            <img src="/Public/game/img/201509032149020.png" title="크로아티아 D1" height="24" style="text-align:center;margin:  0 auto;display: block;">
                        </td>
                        <td width="240" class="betTd  betState">
                            <div style=" width:100%;">
                                <span style="float:left ; display:block;padding: 0 36px;">
                                    &nbsp;
                                    <img src="/Public/game/img/sz<?php echo ($result["result1"]); ?>.png" class=" bet-img">
                                     <img src="/Public/game/img/sz<?php echo ($result["result2"]); ?>.png" class=" bet-img">
                                     <img src="/Public/game/img/sz<?php echo ($result["result3"]); ?>.png" class=" bet-img">
                                </span>
                                <span style="float:left;padding: 0 36px;    line-height: 40px; ">
                                    <?php echo ($result["number"]); ?>
                                </span>
                                <span style=";color:#3f3aff;float:right;padding: 0 36px;    line-height: 40px;">
                                    <?php if(($result["odd_even"]) == "1"): ?>EVEN
                                        <?php else: ?>
                                        ODD<?php endif; ?>
                                </span>
                                <span style="float:right;color:red;padding: 0 36px;    line-height: 40px;">
                                    <?php if(($result["size"]) == "1"): ?>LARGE
                                        <?php else: ?>
                                        SMALL<?php endif; ?>
                                </span>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
            </table>
            <?php echo ($page); ?>

        </div>
    </div>
</div>

<div class="fooder-box">
    <ul>
        <li class="fooder-left">
            <img style="  width: 61%;padding-top: 10px;" src="/Public/game/img/logo.png">
        </li>
        <li class="fooder-right">
            <span>官方热线：<?php echo ($config["tel"]); ?></span>
            <span>传真：<?php echo ($config["fax"]); ?></span>
            <span><?php echo ($config["official_link"]); ?></span>
        </li>
    </ul>
</div>
</body>
</html>

<script language="JavaScript">
    $(function(){
        $(".searchbtn").click(function(){
            search_time = $("#search_time").val();
            search_round = $("#search_round").val();
            $.post("/index.php/Home/Game/game_result", {search_time:search_time,search_round:search_round}, function(e){
                //TODO search
            },"json");
        });
    })
</script>