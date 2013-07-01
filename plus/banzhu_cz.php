<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

	$flags = 0;
	$dsql->SetQuery("select * from dede_archives where typeid=1039 and shorttitle=".$listid);
	$dsql->Execute();
	while($row = $dsql->GetArray())
	{
		$flags = 1;
		break;
	}
	$jsondata = "{flags:" . $flags . "}";
	//$arr['flags'] = $flags;
	//$jsondata = json_encode($arr);
        echo $_GET['jsoncallback'].'('.$jsondata.')';
//echo $jsondata;
?>