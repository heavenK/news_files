<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

$db = new DedeSql(false);
$rs = $db->GetOne("SELECT count(*) as num FROM dede_feedback WHERE AID='{$aid}'");
echo "document.write('".$rs['num']."')";

?>