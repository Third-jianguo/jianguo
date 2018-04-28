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
        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />

        <tr>
            <td align="right" height="40px"><label>游戏名称：</label></td>
            <td align="left"><input name="name"  value="<?php echo ($info["name"]); ?>"class="input-text radius" placeholder="游戏名称" style="width:200px;height: 30px"></td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>标题：</label></td>
            <td align="left"><input name="name"  value="<?php echo ($info["title"]); ?>"class="input-text radius" style="width:200px;height: 30px"></td>
        </tr>
        <tr>
            <td align="right" width="15%" height="40px"><label>上传图片：</label></td>
            <td align="left">
                <img src="" id="show_image" height="50" style="display: none"/>
                <input type="hidden" value="" id="url"  name="img" class="input-text radius" />
                <input type="button" id="uploadButton" value="Upload" />
                <img src="<?php echo ($info["img"]); ?>" width="55px" height="55px" />
            </td>
        </tr>
        <tr>
            <td align="right" height="40px"><label>内容：</label></td>
            <td align="left"> <textarea class="textarea" id="inscontent" placeholder="......" name="content" style="width: 400px;height: 400px" onchange="getcontent()"><?php echo ($info["content"]); ?></textarea></td>
        </tr>
    </table>
</form>
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
    KindEditor.ready(function(K) {
        var uploadbutton = K.uploadbutton({
            button : K('#uploadButton')[0],
            fieldName : 'image',
            url : '/index.php/Admin/Games/upload',
            afterUpload : function(data) {
                //console.log(data)
                data= eval(data);
                if (data.status == 1) {
                    K('#url').val(data.msg);
                    var img = '/index.php/../'+data.msg;
                    $('#show_image').attr('src',img);
                    $('#show_image').css('display','');
                } else {
                    alert(data.msg);
                }
            }
        });
        uploadbutton.fileBox.change(function(e) {
            uploadbutton.submit();
        });
    });
</script>
<script>
    var editor;
    KindEditor.ready(function (K) {
        editor = K.create('textarea[name="content"]', {
            resizeType: 1,width:"80%",height:"280px",
            allowPreviewEmoticons: false,
            allowImageUpload: true,
            items: [
                'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
                'table', 'hr',  'baidumap', 'pagebreak',
                'anchor', 'link', 'unlink'
            ],
            afterBlur: function () {
                this.sync();
            }
        });
    });

    function getcontent(){
        var content = editor.html();
        $('#inscontent').val(content);
    }
</script>