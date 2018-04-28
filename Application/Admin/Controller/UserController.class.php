<?php
/**
 * Created by 坚果.
 * User: zq
 * 模板型控制器
 * Date: 2017/8/21 0021
 * Time: 12:49
 */

namespace Admin\Controller;


class UserController extends TemplateController
{

    public function __construct()
    {
        parent::__construct();
        $GLOBALS['Template']['CONTROLLER_NAME'] = '用户管理';
        $GLOBALS['Template']['DBName'] = 'User';

    }

    public function index(){
        if(!empty($_GET)){
            global $Template;
            $Template['WHERE'] = " 1 ";
            $key = $_GET['keyword'];
            if(!empty($key)){
                $Template['WHERE'] .= " AND ( user_name like '%{$key}%' or nick_name like '%{$key}%' ) ";
            }
            if($_GET['status'] != 999){
                $Template['WHERE'] .= " AND status = '{$_GET[status]}' ";
            }
            if(!empty($_REQUEST['display_order_field'])){
                $Template['ORDER'] = $_REQUEST['display_order_field'] . ' ' . $_REQUEST['display_order'];
            }
            if($_GET['excel'] == "excel"){
                $data = M("User")->where($Template['WHERE'])->order($Template['ORDER'])->select();
                downLoadExcel($data);
            }

        }


        parent::index();
    }

    public function black(){
        global $Template;
        $id = I('post.id', '0', 'intval');
        $del = M("User")->find($id);
        $res1 = D("User")->save(array('id' => $id, 'status' => 1));
        if ($res1 === false) {
            ReturnJson(0, "no");
        } else {
            $this->set_admin_log($Template['CONTROLLER_NAME'] . '—加入黑名单：' . $del['name']);
            ReturnJson(1, "ok");
        }
    }

    public function returnBlack(){
        global $Template;
        $id = I('post.id', '0', 'intval');
        $del = M("User")->find($id);
        $res1 = D("User")->save(array('id' => $id, 'status' => 0));
        if ($res1 === false) {
            ReturnJson(0, "no");
        } else {
            $this->set_admin_log($Template['CONTROLLER_NAME'] . '—移出黑名单：' . $del['name']);
            ReturnJson(1, "ok");
        }
    }








    //批量添加会员
    public function user_add_more(){

        if(IS_POST){
            $excel_array = importExcel($_POST['file_url']);
            //user_name, nick_name, email, tel
            $user_model = M("User");
            foreach($excel_array as $key => $val){
                $data['user_name'] = $val[0];
                $data['nick_name'] = $val[1];
                $data['email'] = $val[2];
                $data['tel'] = $val[3];
                $data['form'] = 2;//批量添加
                $res = $user_model->add($data);
                if(!$res){

                }
            }
            return_ajax("ok",1);
        }

        $this->display();
    }


    public function money_change(){

        if(IS_POST){
            //修改用户的资金
            //        加减 数值 金币或者point user_id
            $type = $_POST['type']; // 1加 0减
            $number = $_POST['number'];// 数值
            $money_type = $_POST['money_type']; //1金币, 2point
            $user_id = $_POST['user_id'];
            $msg = $_POST['msg'];

            if(!isset($type) || empty($number) || empty($money_type) || empty($user_id) || empty($msg) ){
                ReturnJson(0, "数据填写不完整");
            }

            M("money_log")->add(array(
                'user_id' => $user_id,
                'number' => $number,
                'type' => $type,
                'money_type' => $money_type,
                'admin_id' => $_SESSION['admin']['id'],
                'createtime' => time(),
                'msg' => $msg
            ));

            ////TODO  事务
            $where = array('id' => $user_id);
            //金币
            if($money_type == 1){
                if($type == 1){
                    //增加
                    M("user")->where($where)->setInc("money", $number);
                    ReturnJson(1, "ok");
                }elseif($type == 0){
                    //减少
                    M("user")->where($where)->setDec("money", $number);
                    ReturnJson(1, "ok");
                }
            }elseif($money_type == 2){
                //point
                if($type == 1){
                    //增加
                    M("user")->where($where)->setInc("point", $number);
                    ReturnJson(1, "ok");
                }elseif($type == 0){
                    //减少
                    M("user")->where($where)->setDec("point", $number);
                    ReturnJson(1, "ok");
                }
            }else{
                ReturnJson(0, "no");
            }

        }

        $user = M("User")->find($_REQUEST['id']);
        $this->assign("user", $user);
        $this->display();
    }

    /*
     * 用户列表访问的单用户日志 包括登录,充值记录，换值记录，point记录，押注记录，金币记录
     */
    public function user_log(){
        $where = array(
            'log.user_id' => intval($_GET['id']),
            'log.log_type' => intval($_GET['log_type']),
        );
        if(!empty($_GET['start_time'])){
            $start = strtotime($_GET['start_time']);
            $end = strtotime($_GET['end_time']) + 86400;
            $where['log.createtime'] = array("BETWEEN", array($start,$end));
        }

        $list = M("user_log log")->field("log.*, user.nick_name, user.user_name")->join("game_user user ON log.user_id = user.id", "left")->where($where)->select();

        $this->assign("list", $list);
        $this->assign("search", $_REQUEST);
        $this->display();
    }


        //用户押注列表
    public function user_bet(){
        $where = array();
        if(!empty($_REQUEST['start_time'])){
            $start = strtotime($_REQUEST['start_time']);
            $where['bet.createtime'] = array('between' , array($start, $start + 86400));
        }
        if(!empty($_REQUEST['round'])){
            $where['bet.round'] = $_REQUEST['round'];
        }
        if(!empty($_REQUEST['keyword'])){
            $where['_string'] = " user.user_name like '%{$_REQUEST['keyword']}%' or user.nick_name like '%{$_REQUEST['keyword']}%' " ;//user.nick_name$_REQUEST['keyword'];
        }

        $count = M("dice_bet bet")
                    ->join("game_user user ON bet.user_id = user.id", 'left')
                    ->where($where)->count();
        $Page = new \Think\Page($count,20);
        $show = $Page->show();

        $list = M("dice_bet bet")->field("bet.game_id,bet.round, bet.size, bet.odd_even, bet.number, bet.status, bet.createtime AS bet_time, user.*")
            ->join("game_user AS user ON bet.user_id = user.id", 'left')
            ->where($where)->select();

        $this->assign("list", $list);
        $this->assign('page',$show);
        $this->assign("search", $_REQUEST);

        $this->display();
    }

    public function user_bet_back(){


        //TODO  操作回滚, 判断状态是否需要回滚金币
    }




}