<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

/**
 * 聊天主逻辑
 * 主要是处理 onMessage onClose 
 */
use \GatewayWorker\Lib\Gateway;
use Workerman\Lib\Timer;


use Workerman\Worker;

class Events
{

   /**
    * 有消息时
    * @param int $client_id
    * @param mixed $message
    */
   public static function onMessage($client_id, $message)
   {
        // debug
//        echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id session:".json_encode($_SESSION)." onMessage:".$message."\n";
        
        // 客户端传递的是json数据
        $message_data = json_decode($message, true);
        if(!$message_data)
        {
            return ;
        }

        // 根据类型执行不同的业务
        switch($message_data['type'])
        {
            // 客户端回应服务端的心跳
            case 'pong':
                echo "ping".PHP_EOL;
                return;
            // 客户端登录 message格式: {type:login, name:xx, room_id:1} ，添加到客户端，广播给所有客户端xx进入聊天室
            case 'login':
                echo "login".PHP_EOL;
                Gateway::bindUid($client_id, $message_data['client_id']);
                Gateway::joinGroup($client_id, 'user');
                Gateway::setSession($client_id,array('user_id' => $message_data['client_id']));

                //TODO check new  msg
                return;
              case 'admin_login':
                echo "admin_login".PHP_EOL;
                Gateway::bindUid($client_id, $message_data['client_id']);
                Gateway::joinGroup($client_id, 'admin');
                Gateway::sendToUid($message_data['client_id'], json_encode(array('type' => 'admin_login', 'round' => getRound())));
                  return;
            case 'chat':
                //管理员回复用户的消息
                $return_id = curl_post("http://xxxx.com:8080/index.php/Admin/Api/adminToUserChat", $message_data);
                //通知用户有新消息
                Gateway::sendToUid($message_data['user_id'], json_encode(array('type' => 'chat')));
                return;
              case 'logout':
                echo "logout socket".PHP_EOL;
                Gateway::sendToUid($message_data['client_id'], json_encode(array('type' => 'logout')));
                return;
//           case "tips":
//                echo "tips".PHP_EOL;
//                $message = get_msg($message_data);
//                return Gateway::sendToGroup($message_data['order_id'],$message);
        }
   }


    // 进程启动时设置个定时器。Events中支持onWorkerStart需要Gateway版本>=2.0.4
    public static function onWorkerStart($client_id)
    {
//        $client = $client_id->workerId;
        //            Gateway::sendToClient($client->workerId,'');

        Timer::add(1, function(){
            global $old_round;
            $game_round = getRound();
            if($old_round != $game_round){
                $old_round = $game_round;
                Gateway::sendToGroup("admin", json_encode(array('type' => 'timer', 'time' => time(), 'round' => $game_round)));
            }

        });

        Timer::add(60, function(){
            //check socket online and mysql online , the diff go to out
            $all = Gateway::getAllClientSessions("user");
            $users = array();
            foreach($all as $key => $val){
                $users[] = $val['user_id'];
            }

            $unline = curl_post("http://xxxx.com:8080/index.php/Home/Api/isLogout", $users);
            $unline = json_decode($unline, true);
            if(!empty($unline)){
//                var_dump($unline);
                foreach($unline as $key => $val){
                    if(Gateway::isUidOnline($val)){
                        Gateway::sendToUid($val, json_encode(array('type' => 'logout')));
                    }
                }
            }

        });

    }


   /**
    * 当客户端断开连接时
    * @param integer $client_id 客户端id
    */
   public static function onClose($client_id)
   {
       // debug
       echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id onClose:''\n";
       Gateway::closeClient($client_id);
   }
  
}

function getRound(){
    $now_time = time();
    $today_time = strtotime(date("Y-m-d", $now_time));

    $game_interval_time = 5;//秒

    return ceil(($now_time - $today_time) / $game_interval_time);
}

function curl_post($url , $data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('data' => json_encode($data)));
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

