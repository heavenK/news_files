<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

isset($id) ? $id = $id : exit();

$num = getTypeNum($id);

echo "document.write('".$num."')";


?>