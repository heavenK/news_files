<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");
session_start();
if($_SESSION["Zend_Auth"]['storage']->nickname) { 
 
 	         echo "document.write('<b>���������ѣ�".$_SESSION["Zend_Auth"]['storage']->nickname." | <a href=\"http://bbs.we54.com\">������̳</a> | <a href=\"http://news.we54.com\">�������</a> | <a href=\"http://www.we54.com\">��ҳ</a></b>')";

                            }else{ 
							
                echo "document.write('";
				echo '<form name="login" target="_self" method="post" action="http://passport.we54.com/index/login"><b>�û�����<input name="username" type="text" id="user" style="border:1px #e7e3e3 solid" class="vvv"/></b><b>���룺<input name="password" type="password" id="address" style="border:1px #e7e3e3 solid" class="jjj"/></b> <a onclick="login.submit();"><img src="/images/jiaopian/image/login.jpg" width="39px" height="20px" border="0"/></a><input type="hidden" value="http://news.we54.com/plus/feedback.php?aid='.$aid.'" name="forward"><b><a href="http://passport.we54.com/Index/register">ע��</a></b></form>';
						echo "')";
 }      
                             

                            
?>
                           		