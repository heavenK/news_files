<?php
function litimgurls($imgid=0){
   global $lit_imglist;
   //获取图片附加表imgurls字段内容进行处理
   $dsql = new DedeSql(false);
   $row = $dsql->GetOne("Select imgurls From #@__addonimages where aid='$imgid'");
   //调用inc_channel_unit.php中ChannelUnit类
   $ChannelUnit = new ChannelUnit(2,$imgid);
   //调用ChannelUnit类中GetlitImgLinks方法处理缩略图
   $lit_imglist = $ChannelUnit->GetlitImgLinks($row['imgurls']);
   //返回结果
   return $lit_imglist;
}

//获取栏目的文档数
function getTypeNum($tid=0){
	$db = new DedeSql(false);
	$sql = "SELECT count(*) as num FROM `#@__addoninfos` WHERE typeid=".$tid." AND arcrank>-1";
	if ($arr = $db->GetOne($sql)) {
			return $arr['num'];
	}
	else return 0;
}
/**************** 
function GetOneImgUrl 
@@ 功能：读取自定义字段图片地址 
*****************/
function GetOneImgUrl($img,$ftype=1){ 
preg_match_all("/href='([^']+)/i", $img, $match);
$urls = $match[1];
$img=$urls[0];
return $img; 
}
?>