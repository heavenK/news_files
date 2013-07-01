<?php

header('Cache-Control: post-check=0, pre-check=0');
header('Pragma: no-cache');
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

session_start();
if($_SESSION["Zend_Auth"]['storage']->nickname) { 
 
 	         echo "document.write('{dede:arclist typeid=397 row=6 titlelen=44 }<li><a href=\"[field:arcurl/]\" target=\"_blank\">[field:title/]</a></li>{/dede:arclist}')";
             }                
?>