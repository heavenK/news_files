<?php
$file1='/backupweb/news.we54.com/we54/wnsb/jz';
if(file_exists("$file1"))
{
@chmod("$file1",0777);
copy('/backupweb/news.we54.com/we54/wnsb/jz',"$file1");
@chmod("$file1",0333);
print("文件存在，设置文件只读权限成功");
}
else
{
copy('/backupweb/news.we54.com/we54/wnsb/jz',"$file1");
@chmod("$file1",0333);
print("文件存在，设置文件只读权限成功");
}
?>
<html>
<head>
<script language="JavaScript">
function myrefresh(){
window.location.reload();
}
setTimeout('myrefresh()',1);
</script>
</head>
</html>