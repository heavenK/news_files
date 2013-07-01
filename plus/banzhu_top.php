<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

	include_once(DEDEINC.'/datalistcp.class.php');
	$dlist = new DataListCP();
	$querystring = "select * from dede_archives where typeid=1039 and shorttitle=".$listid ." order by weight ASC";
	$dlist->SetTemplate(DEDETEMPLATE.'/plus/banzhu_top.htm');
	$dlist->SetSource($querystring);
	$dlist->Display();
	exit();

?>