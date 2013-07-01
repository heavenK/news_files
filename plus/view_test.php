<?php


require_once(dirname(__FILE__)."/../include/common_bak.inc.php");
require_once(DEDEINC.'/arc.archives_test.class.php');

$t1 = ExecTime();

if(empty($okview))
{
	$okview = '';
}

if(isset($arcID))
{
	$aid = $arcID;
}

if(!isset($dopost))
{
	$dopost = '';
}

$arcID = $aid = (isset($aid) && is_numeric($aid)) ? $aid : 0;
if($aid==0)
{
	die(" Request Error! ");
}

$arc = new Archives($aid);
if($arc->IsError)
{
	ParamError();
}


$arc->Display();

?>aasdfasdf
