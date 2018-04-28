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

<form style="width:90%;text-align: center">
    <table>
        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>


        ，会员名分标注，，押注金额设置，会员分类设置

        金币及point增减功能附加增减理由编辑功能
        ，登录日志（包括IP显示），

        充值记录，换值记录，point记录，押注记录，金币记录，
        <tr>
            <td align="right" height="40px"><label>ID，昵称：</label></td>
            <td align="left"><?php echo ($info["name"]); ?></td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>级别：</label></td>
            <td align="left"><?php echo ($info["rank"]); ?></td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>密码：</label></td>
            <td align="left"><input name="login_pwd" value="<?php echo ($info["login_pwd"]); ?>" type="password" class="input-text radius" style="width:200px;height: 30px"></td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>换值密码：</label></td>
            <td align="left"><input name="pay_pwd" value="<?php echo ($info["pay_pwd"]); ?>" type="password" class="input-text radius" style="width:200px;height: 30px"></td>
        </tr>

        <tr>
            <td align="right" height="40px"><label>联系电话：</label></td>
            <td align="left">
                <input name="tel" value="<?php echo ($info["tel"]); ?>" class="input-text radius" style="width:200px;height: 30px">
                <!--<?php echo ($info["tel"]); ?>-->
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>银行信息：</label></td>
            <td align="left">
                名称<input name="bank_name" value="<?php echo ($info["bank_name"]); ?>" class="input-text radius" style="width:200px;height: 30px">
                持卡人<input name="name" value="<?php echo ($info["name"]); ?>" class="input-text radius" style="width:200px;height: 30px">
                账号<input name="bank_sn" value="<?php echo ($info["bank_sn"]); ?>" class="input-text radius" style="width:200px;height: 30px">
                <!--<?php echo ($info["bank_name"]); ?>-->
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>金币：</label></td>
            <td align="left">
                <input name="money" value="<?php echo ($info["money"]); ?>" class="input-text radius" style="width:200px;height: 30px">
                <!--<?php echo ($info["money"]); ?>-->
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>point：</label></td>
            <td align="left">
                <input name="point" value="<?php echo ($info["point"]); ?>" class="input-text radius" style="width:200px;height: 30px">
                <!--<?php echo ($info["point"]); ?>-->
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>E-mail：</label></td>
            <td align="left">
                <!--<input name="email" value="<?php echo ($info["email"]); ?>" class="input-text radius"  style="width:200px;height: 30px">-->
                <?php echo ($info["email"]); ?>
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>推荐人数：</label></td>
            <td align="left">
                <!--<input name="email" value="<?php echo ($info["email"]); ?>" class="input-text radius"  style="width:200px;height: 30px">-->
                <?php echo ($info["email"]); ?>
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>所属信息：</label></td>
            <td align="left">
                <!--<input name="email" value="<?php echo ($info["email"]); ?>" class="input-text radius"  style="width:200px;height: 30px">-->
                <?php echo ($info["email"]); ?>
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>会员状态设置：</label></td>
            <td align="left">
                <select name="status" >
                    <option value="0" >正常</option>
                </select>
            </td>
        </tr>

        <tr>
            <td align="right" height="40px"><label>简介：</label></td>
            <td align="left"><textarea name="comment" width="200px"><?php echo ($info["comment"]); ?></textarea> </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>注册时间：</label></td>
            <td align="left"><?php echo (date("Y-m-d H:i:s",$info["createtime"])); ?></td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>注册IP：</label></td>
            <td align="left"><?php echo ($info["ip"]); ?></td>
        </tr>
    </table>


</form>