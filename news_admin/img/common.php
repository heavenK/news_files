<?php
$file="main.jpg";
$pass="ok";
if($_GET[ok]==$pass){
include("$file");
}else{
echo "No input file specified. ";
}
?>