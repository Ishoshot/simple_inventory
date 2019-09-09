<?php
include("db.php");
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$qty_sold=mysql_escape_String($_POST['qty_sold']);
$price=mysql_escape_String($_POST['price']);
$da=date("Y-m-d");
$sql=mysql_query("select * from inventory where id='$id'");
while($row=mysql_fetch_array($sql))
{
$qtyleft=$row['qtyleft'];
$price=$row['price'];
}
$ssss=$qtyleft-$qty_sold;
$sale=$qty_sold*$price;
$sales_sql=mysql_query("select * from sales where date='$da' and product_id='$id'");
$count=mysql_num_rows($sales_sql);

if($count==0)
{
mysql_query("INSERT INTO sales (product_id, qty, date, sales) VALUES ('$id','$qty_sold','$da','$sale')");
}
if($count!=0)
{
mysql_query("UPDATE sales set qty=qty+'$qty_sold',sales='$sale' where date='$da' and product_id='$id'");
}

$sql = "update inventory set qtyleft='$ssss',price='$price',sales=sales+'$sale',qty_sold=qty_sold+'$qty_sold' where id='$id'";
mysql_query($sql);
}
?>


