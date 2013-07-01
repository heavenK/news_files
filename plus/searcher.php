<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");
require(dirname(__FILE__)."/../include/channelunit.func.php");


	include_once(DEDEINC.'/datalistcp.class.php');
	$dlist = new DataListCP();
	$dlist->pageSize = 10;


	$starttime = GetMkTime($times);
	$endtime = GetMkTime($times." 23:59:59");
	$wheres = "typeid=5 AND pubdate>".$starttime." AND pubdate<".$endtime;


	$querystring = "select * from dede_archives where ".$wheres;
	$dlist->SetParameter('times',$times);
	$dlist->SetTemplate(DEDETEMPLATE.'/plus/search.htm');
	$dlist->SetSource($querystring);
	$dlist->Display();
	exit();

?>