<?php
/**
 * Created by PhpStorm.
 * User: DG
 * Date: 2018/3/24
 * Time: 12:35
 */

namespace Admin\Model;


use Think\Model;

class GamesModel extends Model
{

    /*
     * 骰子游戏提交结果
     * $data = array(1,2,3)
     */
    public function dice_game_add_result($data)
    {

        $this->dice_rules($data);

        $dice_round = $this->get_game_round();//期数
        if(!empty($_POST['round']) && $dice_round != $_POST['round']){
            return_ajax("期数计算错误");
        }

        $odd_even = 0;
        $size = 0;
        $number = $data['result1']+$data['result2']+$data['result3'];
        $odd_even = $number % 2;
        if($number > 10){
            $size = 1;
        }

        $check_round = M("dice_result")->where(array("round" => $data['round']))->find();
        if(!empty($check_round)){
            return_ajax($data['round']."期结果已存在");
        }

        $today_time = strtotime(date("Y-m-d", time()));

        $round_time = $today_time + ( $data['round'] * 300 );
        $res = M('dice_result')->add(array(
            'round' => $dice_round,
            'result1' => $data['result1'],
            'result2' => $data['result2'],
            'result3' => $data['result3'],
            'createtime' => time(),
            'roundtime' => $round_time,
            'size' => $size,
            'odd_even' => $odd_even,
            'number' => $number
        ));
        if (empty($res)) {
            return_ajax("no");
        }

        return_ajax("ok", 1);
    }


    /*
     * 骰子游戏规则
     */
    private function dice_rules($data)
    {

        if(empty($data)){return_ajax("数据为空");}

        return true;
    }

    //获取游戏期数
    public function get_game_round($game_id = 0){

        $now_time = time();
        $today_time = strtotime(date("Y-m-d", $now_time));
        $game_interval_time = 300;//秒
        return ceil(($now_time - $today_time) / $game_interval_time);
    }



}