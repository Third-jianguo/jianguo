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


<!--顶部-->

<!--main-->
<div>
    <div class="ever-top">

        <img src="/Public/game/img/tb2.png">

        <p>
            —————————— &nbsp; START &nbsp;THE &nbsp; GAME &nbsp;TOUR
        </p>
    </div>
    <div class="money_box_xinxi clearfloat" style="    margin-bottom: 0;">

        <div class="first_row clearfloat">
            <img style="       padding: 40px 0px;   width: 334px;" src="/Public/game/img/change-Mbg.png">
            <img src="/Public/game/img/tb3.png" style=" display: block;">

            <h1 style="color:#fff;    padding: 27px 0;">SWAP VALUE</h1>

            <div class="first_row_01">
                <span class="name_money_box">보유머니</span>
					<span class="boder_style" style="padding: 5px 25px;margin: 0 24px;">
							<input type="text" value="<?php echo ($user["money"]); ?>" id="exchangePwdId" style="background: rgba(0,0,0,0);
   border: 1px solid rgba(0,0,0,0);    width: 953px;">
					</span>
                <br/>
            </div>
            <div class="first_row_02">

            </div>
            <div class="third_row clearfloat">
                <div class="third_row_01 clearfloat">
                    <span class="name_money_box ">환전금액</span>

                    <span class="boder_style" style="     padding-right: 63px;    padding: 5px 73px 5px 41px;   margin: 0 22px;">
                        <input name="money" id="money" value="0" type="text" style="background: rgba(0,0,0,0);
border: 1px solid rgba(0,0,0,0); color:#fff;    width: 877px;">
                        원
                    </span>
                </div>

                <div class="third_row_02 clearfloat">

                    <span class="name_money_box">환전비번</span>
                    <span class="personal_true boder_style" style="       padding: 5px 16px;margin: 0 22px;">
                        <input type="text" name="AccountName" value="" style="background: rgba(0,0,0,0);    width: 980px;
       border: 1px solid rgba(0,0,0,0); color:#fff;"></span><br/>
                    <span style="font-size:  13px; color:  #aaa; display:  block; padding-top: 18px;">
                        (회원가입시 입력하신 환전비밀번호를 입력하세요)
                    </span>

                </div>

            </div>
            <div class="second_row clearfloat" style="padding-bottom: 50px;">

                <div class="second_row_01 clearfloat">
                    <span class="name_money_box second_name">금액선택</span>
                    <ul class="money_tl">
                        <li class="money_bull01 money_button" data-money="10000"><img src="/Public/game/img/tb4.png"></li>
                        <li class="money_bull02 money_button" data-money="30000"><img src="/Public/game/img/tb5.png"></li>
                        <li class="money_bull03 money_button" data-money="50000"><img src="/Public/game/img/tb6.png"></li>
                        <li class="money_bull04 money_button" data-money="100000"><img src="/Public/game/img/tb7.png"></li>
                        <li class="money_bull05 money_button" data-money="500000"><img src="/Public/game/img/tb8.png"></li>
                        <li class="money_bull06 money_button" data-money="1000000"><img src="/Public/game/img/tb9.png"></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="fourth_row clearfloat">
            <span><img src="/Public/game/img/exchange.png" onclick="inputMoneySubmit()"></span>
            <span><img src="/Public/game/img/reSet.png" onclick="resetMoney(0)"></span>
        </div>

        <div class="new_money2" style="clear: both;">
            <table cellpadding="0" cellspacing="0" class="new_money_tab2">
                <tbody>
                <tr>
                    <th width="100" align="center">NO</th>
                    <th width="250" align="center">입금자</th>
                    <th width="250" align="center">신청금액</th>
                    <th width="200" align="center">신청일자</th>
                    <th width="200" align="center">상태</th>
                    <th width="100" align="center">실행</th>
                </tr>

                <?php if(is_array($money_apply)): $k = 0; $__LIST__ = $money_apply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apply): $mod = ($k % 2 );++$k;?><tr>
                        <td width="100" align="center"><?php echo ($k); ?></td>
                        <td width="250" align="center"><?php echo ($apply["apply_name"]); ?></td>
                        <td width="250" align="center"><?php echo ($apply["money"]); ?></td>
                        <td width="200" align="center"><?php echo (date("Y-m-d H:i:s",$apply["createtime"])); ?></td>
                        <td width="200" align="center"><?php echo ($apply["status"]); ?></td>
                        <td width="100" align="center">
                            <a href="javascript:void(0)" class="delete" style="color:#bf7d2e; font-weight: bold;">삭제</a>
                        </td>

                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
            </table>
        </div>

        <div class="inputmoney_left2">
            <h2><!-- ▶ 주의사항 안내 ◀ --><img src="/Public/game/img/money_bt.png"></h2>
            <ul class="inputmoney_left_ul">
                <li><span style="color:#dab662;">Step.01</span> 24시간 자유롭게 입,출금이 가능하며 최장 3~5분 소요됩니다<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(단 23:30부터 00:30분 까지는 타행이체 불가) 환전은 신청즉시 보유머니에 차감됩니다.）
                </li>
                <li><span style="color:#dab662;">Step.02</span> 10분이상 입금이 지연될 경우에는 회원님의 입금계좌정보를 잘못 기입한 경우가 많습니다.
                </li>
                <li><span style="color:#dab662;">Step.03</span> 다른 계좌로 환전하시려면 고객센터로 문의주세요.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(회원님의 정보에 등록된 예금주명 외의 계좌로는 환전이 절대 불가능 합니다.)
                </li>


            </ul>
        </div>
        <div class="inputmoney_left2">
            <h2>▶ 환전 규정 ◀ </h2>
            <ul class="inputmoney_left_ul">
                <li style="padding-left:50px;">

                    라이브 베팅시 최소 5판 베팅을 하셔야 환전이 가능하십니다.<br>

                    환전은 1회최대환전 300만원까지 가능하며, 일일 최대환전 500만원까지 가능합니다.<br>

                    스포츠 경기 배팅시 충전금액 이벤트 머니 포함 100% 배팅시 환전이 가능 하십니다.<br>

                    라이브 경기 배팅시 충전금액 이벤트 머니 포함 300% 배팅시 환전이 가능 하십니다.<br>

                    이벤트로 받으신 포인트는 200% 배팅시 환전이 가능 하십니다.<br>

                    은행점검 시간인 23:30~00:30 사이에는 환전업무가 진행 되지 않으니 <br>

                    되도록 점검시간 이외의 시간에 신청해 주시면 보다 빠르게 환전처리 가능 하십니다.

                </li>

            </ul>
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

<script language="javascript">
    $(function () {
        var user_money = parseInt("<?php echo ($user["money"]); ?>");
        $(".money_button").click(function () {
            money = parseInt($(this).attr("data-money"));
            if(user_money < money){
                alert("not sufficient funds");
                return false;
            }

            $("#money").val(money);
        });
    })
</script>