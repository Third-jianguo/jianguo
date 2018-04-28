<?php
/**
 * Created by 坚果.
 * User: zq
 * Date: 2017/10/28
 * Time: 12:49
 */

namespace Admin\Controller;
use Think\Controller;

class ApiController extends Controller
{


    public function excel_upload()
    {

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('xls');// 设置附件上传类型
        $upload->rootPath = './Uploads/excel/'; // 设置附件上传根目录
        // 上传单个文件
        $info = $upload->uploadOne($_FILES['excel_file']);
        if (!$info) {// 上传错误提示错误信息
            ReturnJson(0, "上传失败");
            // $this->error($upload->getError());
        } else {// 上传成功 获取上传文件信息
            //var_dump($info);
            ReturnJson(1, '/Uploads/excel/' . $info['savepath'] . $info['savename']);

        }
    }


    public function adminToUserChat(){
        $data = array(
            'user_id' => intval($_POST['user_id']),
            'admin_id' => intval($_POST['admin_id']),
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'createtime' => time(),
        );
        return M("chat")->add($data);
    }



}