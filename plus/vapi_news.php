<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");



$newsID = (isset($newsID) && is_numeric($newsID)) ? $newsID : exit;

$dsql->SetQuery("Select ar.id as id,channel,addtable From `#@__archives` ar LEFT JOIN `#@__channeltype` ct ON ar.channel=ct.id WHERE ar.id=".$newsID);
$dsql->Execute();
$row = $dsql->GetArray();

if($row){
	$dsql->SetQuery("Select ar.id as newsID, ar.title as newsTitle,ar.source as newsSource,ar.pubdate as newsDate, ar.description as newsContent, ad.shipin as newsFlv From `#@__archives` ar LEFT JOIN `".$row['addtable']."` ad ON ar.id = ad.aid WHERE ar.id=".$newsID);
	$dsql->Execute();
	$res = $dsql->GetArray();

    $reg_obj = "/<object(.)*<\/object>/isU";
	$reg_embed = "/<embed(.)*<\/embed>/isU";
	
	$reg_src = "/http:\/\/union.bokecc.com\/([\/\d\w_\.])*\" /";
	$newsFlv= $res['newsFlv'];
	preg_match($reg_src,$newsFlv,$match);
	
	if($test) var_dump($match);
	
	$res['newsFlv'] = preg_replace($reg_obj,"",$newsFlv);
	$res['newsFlv'] = preg_replace($reg_embed,"",$res['newsFlv']);
	$res['newsFlv'] = str_replace("#p#∏±±ÍÃ‚#e#","",$res['newsFlv']);
	$res['newsFlv'] = str_replace('" name="movie"',"",$match[0]);
	$res['newsFlv'] = str_replace('" ',"",$res['newsFlv']);
	$flv = $res['newsFlv'];
	if($test) var_dump($res);
	$reg_mp4 = '/_(false|true)_(.)*\.swf/isU';
	$flv = str_replace('/flash/single/','/file/',$flv);
	$flv = preg_replace($reg_mp4,'.mp4',$flv);
	$res['newsFlv'] = str_replace('_','/',$flv);
	
	if(!strstr($res['newsFlv'],'.mp4'))	$res['newsFlv'] = '';

/*
	$reg_w = "/width=\"[\d]*\"/isU";
	$reg_h = "/height=\"[\d]*\"/isU";
	$rr = preg_replace($reg_w,'width="300"',$res['newsContent']);
	$rr = preg_replace($reg_h,'',$rr);
	$rr = str_replace('<img ','<img onclick="var url=this.getAttribute(\'src\');document.location=\'original=\'+url" ',$rr);
	$rr = str_replace('src="/uploads','src="http://news.we54.com/uploads',$rr);
	$res['newsContent'] = $rr;
*/

	if($test) var_dump($res);
	
	foreach ($res as $key =>$value){
		$res[$key] = iconv('gbk','utf-8',$value);
	}

	
	echo json_encode($res);
}
else exit;
	
?>