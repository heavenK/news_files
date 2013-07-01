<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$num=rand(1000,99999);

if($_SESSION["Zend_Auth"]['storage']->nickname) { 
 	     echo "document.write('<a href=\"/poster/build_l/index.php?s=/We54HomeBuyer\" style=\"border:none;\"><img src=\"/images/dzhiye/hd_canyu_btn.jpg\" width=\"457\" height=\"137\" border=\"0\" title=\"我要参加\" /></a>')";
 }else	{ 
							
		echo "document.write('<a href=\"http://passport.we54.com/Index/login?forward=".$_GET['forward']."\"  style=\"border:none;\"><img src=\"/images/dzhiye/hd_canyu_btn.jpg\" width=\"457\" height=\"137\" border=\"0\" title=\"我要参加\" /></a>')";
} 

?>