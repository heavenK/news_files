<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");


$wheres = ' WHERE typeid=37';


$orders = '  ORDER BY pubdate DESC';


$dsql->SetQuery("Select id,title,litpic as imgURL,description as content From `#@__archives`".$wheres. $orders ." LIMIT 0,3");
$dsql->Execute();
while($row = $dsql->GetArray())
{
	$res['news'][] = $row;
}
	


if($test) var_dump($res);

foreach ($res['news'] as $key =>$news){
	foreach($news as $key1 => $value){
		$res['news'][$key][$key1] = iconv('gbk','utf-8',$value);
	}
}

echo json_encode($res);
	
?>