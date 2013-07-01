<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");
session_start();
if($_SESSION["Zend_Auth"]['storage']->nickname) { 
								echo '1';
                            }else{ 	
               					 echo '0';
 }                            
?>