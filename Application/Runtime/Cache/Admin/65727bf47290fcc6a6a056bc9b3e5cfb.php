<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>CSS柱状图</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        .chart {
            list-style: none;
            font-size: 14px;
            border: 1px solid #ccc;
            margin: 0;
            padding: 5px;
            background: #F2F1D7;
            float: left;
        }

        .chart li {
            width: 75px;
            height: 140px;
            float: left;
            background: #DDF3FF url(/Public/images/o_pillar.gif) center center repeat-y;
        }

        .chart li em, .chart li span, .chart li strong {
            display: block;
            height: 20px;
            text-align: center;
        }

        .chart li em, .chart li strong {
            background: #DDF3FF;
        }

        .chart li span {
            height: 100px;
            background: transparent url(/Public/images/o_mask.jpg) no-repeat;
        }
    </style>
</head>
<body>
<div>
    <ul class="chart">
        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($k % 2 );++$k; if(($k) == "9"): endif; ?>
            <li>
                <em><?php echo ($li["count"]); ?>次<br/><?php echo ($li["percent"]); ?>%</em>
                <span style="background-position: center -<?php echo ($li["percent"]); ?>px"></span>
                <strong>----<?php echo ($li["number"]); ?>----
                </strong>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

    <ul class="chart">
        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li2): $mod = ($k % 2 );++$k; if(($k) == "9"): endif; ?>
            <li>
                <em><?php echo ($li2["money"]); ?>元</em>
                <span style="background-position: center -<?php echo ($li2["percent_money"]); ?>px"></span>
                <strong>----<?php echo ($li2["number"]); ?>----
                </strong>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

</body>
</html>