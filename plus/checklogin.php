<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");
session_start();
if($_SESSION["Zend_Auth"]['storage']->nickname) { 
 
 	         echo "document.write('<div id=\"hellodl_detail_discuss_subnav\">���������ѣ�".$_SESSION["Zend_Auth"]['storage']->nickname." | <a href=\"http://bbs.we54.com\">������̳</a> | <a href=\"http://news.we54.com\">�������</a> | <a href=\"http://www.we54.com\">��ҳ</a></div>')";

                            }else{ 
							
                echo "document.write('";
				echo '<dl><dt><form name="login" target="_self" method="post" action="http://passport.we54.com/index/login"><em>�û�����</em><input name="username" type="text" id="username" /><em>���룺</em><input name="password" type="password" /><em><input type="submit" value="�� ¼" style="border:none; background:url(/images/login_bg.jpg) no-repeat; height:24px;color:#000 text-align:center;" /></em><input type="hidden" value="http://news.we54.com/plus/feedback.php?aid='.$aid.'" name="forward"></form></dt><dd><a href="http://passport.we54.com/Index/register">ע��ͨ��֤</a></dd></dl>';
						echo "')";
 }      
                             

                            
?>

