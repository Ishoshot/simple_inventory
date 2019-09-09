<?php
include("db.php");
$proid=$_POST['ITEM'];
$itemnumber=$_POST['itemnumber'];
mysql_query("UPDATE inventory SET qtyleft='$itemnumber'
WHERE id='$proid'");
header("location: tableedit.php#page=addproitem");
?>