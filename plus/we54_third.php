<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");


session_start();
if($_SESSION["Zend_Auth"]['storage']->nickname) { 
 
 	         echo "document.write('<dl style=\"margin-top:12px;\"><a href=\"http://bbs.we54.com/home.php?mod=space&do=index&view=admin\" target=\"_blank\" style=\" height:18px; margin:8px 3px 0 0; padding:3px 0 0 13px; color:#0035a0;\">您好！".$_SESSION["Zend_Auth"]['storage']->nickname." </a><a href=\"http://bbs.we54.com/member.php?mod=logging&action=logout&formhash=".$_GET['formhash']."\" style=\" color:#0035a0; margin:0 7px 0 0;\">退出</a><a href=\"http://bbs.we54.com/member.php?mod=sms&action=bindmobile\" target=\"_blank\" style=\" color:#ff7f00; margin:0 7px 0 0;\">申请认证</a><a href=\"http://bbs.we54.com/home.php?mod=spacecp\" target=\"_blank\" style=\" color:#0035a0;\">用户中心</a></dl>')";
             }else	{ 
							
					echo "document.write('<dl><dd><a href=\"http://bbs.we54.com/member.php?mod=register\" target=\"_blank\" onfocus=\"this.blur()\" title=\"注册\"><img src=\"/images/we54_third/zhuce.jpg\" width=\"62\" height=\"24\" border=\"0\"/></a></dd><dt><a href=\"http://bbs.we54.com/member.php?mod=logging&action=login&infloat=yes&handlekey=login&ajaxtarget=fwin_content_login\" target=\"_blank\" onfocus=\"this.blur()\" title=\"登录\"><img src=\"/images/we54_third/denglu.jpg\" width=\"62\" height=\"24\" border=\"0\"/></a></dt></dl>')";
 					}                          
?>