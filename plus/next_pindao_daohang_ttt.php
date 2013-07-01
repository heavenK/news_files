<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

session_start();
if($_SESSION["Zend_Auth"]['storage']->nickname) { 
 
 	         echo "document.write('<a href=\"http://bbs.we54.com/home.php?mod=space&do=index&view=admin\" target=\"_blank\" style=\" height:18px; margin:8px 3px 0 0; padding:3px 0 0 13px; color:#0035a0;\">您好！".$_SESSION["Zend_Auth"]['storage']->nickname." </a><a href=\"http://bbs.we54.com/home.php?mod=space&do=pm\" target=\"_blank\" style=\" height:18px; margin:8px 13px 0 0; padding:3px 0 0 8px; border-left:#d5d5d5 1px solid; color:#0035a0;\">短消息</a><a href=\"http://bbs.we54.com/member.php?mod=logging&action=logout&formhash=".$_GET['formhash']."\" style=\" color:#0035a0; margin:0 7px 0 0;\">退出</a><a href=\"http://bbs.we54.com/member.php?mod=sms&action=bindmobile\" target=\"_blank\" style=\" color:#ff7f00; margin:0 7px 0 0;\">申请认证</a><a href=\"http://bbs.we54.com/home.php?mod=spacecp\" target=\"_blank\" style=\" color:#0035a0;\">用户中心</a>')";
             }else	{ 
							
					echo "document.write('<strong style=\"font-weight:normal;\">您好！请 </strong><a href=\"http://bbs.we54.com/member.php?mod=logging&action=login&infloat=yes&handlekey=login&ajaxtarget=fwin_content_login\">登录</a><strong style=\"font-weight:normal;\"> 或 </strong><a href=\"http://bbs.we54.com/member.php?mod=register\">注册</a><strong style=\"font-weight:normal;\"> | </strong>')";
 					}                          
?>