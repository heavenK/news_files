<?php
$file1='/backupweb/htdocs/we54/dlnh/2013/0527';
if(file_exists("$file1"))
{
@chmod("$file1",0777);
copy('/backupweb/htdocs/we54/dlnh/2013/0527',"$file1");
@chmod("$file1",0333);
print("文件存在，设置文件只读权限成功");
}
else
{
copy('/backupweb/htdocs/we54/dlnh/2013/0527',"$file1");
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