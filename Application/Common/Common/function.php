<?php
/**
 * @param int $status 1 success other error
 * @param $code 错误代码代表的值
 */
function subtext($text, $length)
{
    if (mb_strlen($text, 'utf8') > $length)
        return mb_substr($text, 0, $length, 'utf8') . '...';
    return $text;
}

function ReturnJson($status = 1, $code)
{
    header('Content-type: application/json'); //json
    $msg = M('error')->where(array('error_id' => $code))->find();
    !$msg && $msg['error_detail'] = $code;
    exit(json_encode(array("status" => $status, "msg" => $msg['error_detail'])));
}

//输出错误信息值
function errorCode($code)
{
    $msg = M('error')->where(array(
        'error_id' => $code
    ))->find();
    !$msg && $msg['error_detail'] == $code;
    return $msg['error_detail'];

}

//生成导航菜单
function MenuformatTree($array, $pid = 0, $bs = 'belongid')
{
    if (is_array($array)) {
        $arr = array();
        $tem = array();
        foreach ($array as $v) {
            if ($v['level'] != 0) {
                if ($v[$bs] == $pid) {
                    $tem = MenuformatTree($array, $v['id']);
                    //判断是否存在子数组
                    $tem && $v['items'] = $tem;
                    $arr[$v['id']] = $v;
                }
            }
        }

        return $arr;
    }
}

/**
 * @param $list
 * @param $nowPage
 * @param $listNums
 * 数组分页
 * @return array;
 */

function pageList($list, $nowPage, $listNums = 10)
{
    $count = count($list);//总数
    $toPages = ceil($count / $listNums);//总页数
    $pageList = array_slice($list, ($nowPage - 1) * $listNums, 10);
    return array('count' => $count, 'total' => $toPages, 'list' => $pageList, 'nowPage' => $nowPage);


}

///无线递归/
function formatTree($array, $pid = 0, $bs = 'parent_id')
{
    if (is_array($array)) {
        $arr = array();
        $tem = array();
        foreach ($array as $v) {
            if ($v[$bs] == $pid) {
                $tem = formatTree($array, $v['id']);
                //判断是否存在子数组
                $tem && $v['items'] = $tem;
                $arr[] = $v;
            }
        }

        return $arr;
    }
}

function cGet($url)
{
    //初始化
    $ch = curl_init();
    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //执行并获取HTML文档内容
    $output = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    //打印获得的数据
    return $output;
}

function cPost($url, $post)
{
    //初始化
//    $headers = array("Content-type: application/json;charset='utf-8'");
    $ch = curl_init();
    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//    curl_setopt($ch, CURLOPT_HEADER, $headers);
    //执行并获取HTML文档内容
    $output = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    //打印获得的数据
    return $output;
}

function uploadImgs($path = '')
{
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize = 51200000;// 设置附件上传大小
    $upload->exts = array();// 设置附件上传类型
    $upload->rootPath = './Uploads/'; // 设置上传根目录
    $upload->savePath = $path; // 设置附件上传（子）目录
// 上传文件
    $info = $upload->upload();
    return $info;

}

function send_mail($sendto_email, $number, $subject = "admin", $body = '', $extra_hdrs = '', $user_name = '')
{
    require_once 'class.phpmailer.php';
    include_once('class.smtp.php');
    $mail = new PHPMailer();
    $mail->IsSMTP();                  // send via SMTP
    $mail->Host = "smtp.163.com";   // SMTP servers
    $mail->PORT = 994;
    $mail->SMTPAuth = true;           // turn on SMTP authentication
    $mail->Username = "18630319672";     // SMTP username  注意：普通邮件认证不需要加 @域名
    $mail->Password = "zxq5097"; // SMTP password
    $mail->From = "18630319672@163.com";      // 发件人邮箱
    $mail->FromName = "发件人";  // 发件人
    $mail->CharSet = "UTF-8";   // 这里指定字符集！
    $mail->Encoding = "base64";
    $mail->AddAddress($sendto_email, "jianguoer");  // 收件人邮箱和姓名
    $mail->IsHTML(true);  // send as HTML
    $mail->Subject = $subject;
    $mail->Body = "<html><head><meta http-equiv=\"Content-Language\" content=\"zh-cn\"><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"></head> <body> I love php。 <br/> your email code is " . $number . "  </body>  </html>  ";
    $mail->AltBody = "text/html";
    if (!$mail->Send()) {
        return false;
        echo "邮件发送有误 <p>";
        echo "邮件错误信息: " . $mail->ErrorInfo;
        exit;
    } else {
        return true;
        echo "$user_name 邮件发送成功!<br />";
    }


    // 参数说明(发送到, 邮件主题, 邮件内容, 附加信息, 用户名)
//    send_mail("jianguo03@qq.com", "欢迎使用phpmailer！", "NULL", "yourdomain.com", "admin");

}

function isLogin($call_back = "")
{
    if (empty($_SESSION['user']) || empty($_SESSION['user']['id'])) {
        if ($call_back == "") {
            header("Location:/index.php/Home/User/login");
            exit;
        }
        header("Location:/index.php/Home/User/login?callback=" . $call_back);
        exit;
    }
    return true;
}

//检测验证码
function check_verify($code, $id = "")
{
    $Verify = new \Think\Verify();
    return $Verify->check($code, $id);
}

//ajax返回数据
function return_ajax($msg, $code = 0, $data = array())
{
    $detail = M("error")->where(array('error_id' => $msg))->getField("error_detail");
    if (empty($detail)) {
        $res = array('code' => $code, 'msg' => $msg);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $res[$key] = $val;
            }
        }
        echo json_encode($res);
        exit;
    } else {
        $res = array('code' => $code, 'msg' => $detail);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $res[$key] = $val;
            }
        }
        echo json_encode($res);
        exit;
    }
}

function csrf()
{
    return md5(rand(1000, 99999));
}


function check_ip_rule($rule = "", $ip = "")
{
    //获取客户端IP
    if (!$ip) $ip = get_client_ip();
    if ($rule) {
        //ip用"," 例如白名单IP：123.*.23.44,193.134.*.*
        if (is_string($rule)) {
            $rule = explode(",", $rule);
        }
    }
    if (in_array($ip, $rule)) {
        return true;
    }
    $ip_regexp = implode('|', str_replace(array('*', '.'), array('\d+', '\.'), $rule));
    $rs = preg_match("/^(" . $ip_regexp . ")$/", $ip);
    if ($rs) return true;
    return false;
}

/*
 * excel 转array
 */

function importExcel($file)
{
    if(!file_exists($file)){
        if(file_exists("D:/1php/game".$file)){
            $file = "D:/1php/game".$file;
        }elseif(file_exists("/home/wwwroot/game".$file)){
            $file = "/home/wwwroot/game".$file;
        }else{
            return_ajax("file is not find");
        }
    }


    import("Org.Util.PHPExcel");
    import("Org.Util.PHPExcel.IOFactory",'',".php");
    import("Org.Util.PHPExcel.Reader.Excel5",'',".php");
    $objReader = \PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow(); // 取得总行数
    $highestColumn = $sheet->getHighestColumn(); // 取得总列数
    $objWorksheet = $objPHPExcel->getActiveSheet();

    $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
    $excelData = array();
    for ($row = 1; $row <= $highestRow; $row++) {
        for ($col = 0; $col < $highestColumnIndex; $col++) {
            $excelData[$row][] = trim((string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
        }
    }
    return $excelData;
}


/* 导出excel函数*/
function downLoadExcel($data,$name='user'){
    import("Org.Util.PHPExcel");
    //close error msg
    error_reporting(E_ALL);
//    date_default_timezone_set('Europe/London');
    $objPHPExcel = new PHPExcel();

    /*以下是一些设置 ，什么作者  标题啊之类的*/
    $objPHPExcel->getProperties()->setCreator("jianguo")
        ->setLastModifiedBy("jianguoer")
        ->setTitle("会员导出")
        ->setSubject("会员信息")
        ->setDescription("备份数据")
        ->setKeywords("excel")
        ->setCategory("result file");
    /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
    foreach($data as $k => $v){
        $num=$k+1;
        //Excel的第A列，uid是你查出数组的键值，下面以此类推
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $v['nick_name'])
            ->setCellValue('B'.$num, $v['user_name'])
            ->setCellValue('C'.$num, $v['login_pwd']);
    }

    $objPHPExcel->getActiveSheet()->setTitle('User');
    $objPHPExcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}


//  Games function


/*
 * 骰子游戏
 */
function get_games_result($game)
{

}




































