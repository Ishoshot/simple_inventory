<?php
include("db.php");
$proid=$_POST['ITEM'];
$itemprice=$_POST['itemprice'];
mysql_query("UPDATE inventory SET price='$itemprice'
WHERE id='$proid'");
header("location: tableedit.php#page=editprice");
?>