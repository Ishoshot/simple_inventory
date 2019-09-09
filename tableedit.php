<?php
	require_once('auth.php');
?>
<?php
include('db.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory System</title>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#first_"+ID).show();
$("#last_"+ID).hide();
$("#last_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_input_"+ID).val();
var last=$("#last_input_"+ID).val();
var dataString = 'id='+ ID +'&price='+first+'&qty_sold='+last;
$("#first_"+ID).html('<img src="load.gif" />');


if(first.length && last.length>0)
{
$.ajax({
type: "POST",
url: "table_edit_ajax.php",
data: dataString,
cache: false,
success: function(html)
{

$("#first_"+ID).html(first);
$("#last_"+ID).html(last);
}
});
}
else
{
alert('Enter something.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script>
<style>
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
padding:10px;
}
.editbox
{
display:none
}
td
{
padding:7px;
border-left:1px solid #fff;
border-bottom:1px solid #fff;
}
table{
border-right:1px solid #fff;
}
.editbox
{
font-size:14px;
width:29px;
background-color:#ffffcc;

border:solid 1px #000;
padding:0 4px;
}
.edit_tr:hover
{
background:url(edit.png) right no-repeat #80C8E5;
cursor:pointer;
}
.edit_tr
{
background: none repeat scroll 0 0 #D5EAF0;
}
th
{
font-weight:bold;
text-align:left;
padding:7px;
border:1px solid #fff;
border-right-width: 0px;
}
.head
{
background: none repeat scroll 0 0 #91C5D4;
color:#00000;

}

</style>
<link rel="stylesheet" href="reset.css" type="text/css" media="screen" />

<link rel="stylesheet" href="tab.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<link href="tabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

var popupWindow=null;

function child_open()
{ 

popupWindow =window.open('printform.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=950, height=400,top=200,left=200");

}
</script>
</head>

<body bgcolor="#dedede">
 
<h1>Inventory System </h1>
<ol id="toc">
    <li><a href="#inventory"><span>Inventory</span></a></li>
    <li><a href="#sales"><span>Sales</span></a></li>
    <li><a href="#alert"><span>To be order</span></a></li>
	<li><a href="#addproitem"><span>Add Item</span></a></li>
    <li><a href="#addpro"><span>Add Product</span></a></li>
    <li><a href="#editprice"><span>Edit Price</span></a></li>
	<li><a href="index.php"><span>Logout</span></a></li>
</ol>

<div class="content" id="inventory">
Click the table rows to enter the quantity sold<br><br>
<table width="100%">
<tr class="head">
<th>Date</th>
<th>Item</th>
<th>Quantity Left</th>
<th>Qty Sold </th>
<th>Price</th>
<th>Sales</th>
</tr>
<?php
$da=date("Y-m-d");

$sql=mysql_query("select * from inventory");
$i=1;
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$date=$row['date'];
$item=$row['item'];
$qtyleft=$row['qtyleft'];
$qty_sold=$row['qty_sold'];
$price=$row['price'];
$sales=$row['sales'];

if($i%2)
{
?>
<tr id="<?php echo $id; ?>" class="edit_tr">
<?php } else { ?>
<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
<?php } ?>
<td class="edit_td">
<span class="text"><?php echo $da; ?></span> 
</td>
<td>
<span class="text"><?php echo $item; ?></span> 
</td>
<td>
<span class="text"><?php echo $qtyleft; ?></span>
</td>
<td>

<span id="last_<?php echo $id; ?>" class="text">
<?php
$sqls=mysql_query("select * from sales where date='$da' and product_id='$id'");
while($rows=mysql_fetch_array($sqls))
{
echo $rows['qty'];
}
?>
</span> 
<input type="text" value="<?php echo $rtrt; ?>"  class="editbox" id="last_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="first_<?php echo $id; ?>" class="text"><?php echo $price; ?></span>
<input type="text" value="<?php echo $price; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
</td>
<td>

<span class="text"><?php echo $dailysales; ?>
<?php
$sqls=mysql_query("select * from sales where date='$da' and product_id='$id'");
while($rows=mysql_fetch_array($sqls))
{
$rtyrty=$rows['qty'];
$rrrrr=$rtyrty*$price;
echo $rrrrr;
}

?>
</span> 
</td>
</tr>

<?php
$i++;
}
?>

</table>
<br />
Total Sales of this day:
	    <b>Php <?php
function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}		
$result1 = mysql_query("SELECT sum(sales) FROM sales where date='$da'");
while($row = mysql_fetch_array($result1))
{
    $rrr=$row['sum(sales)'];
	echo formatMoney($rrr, true);
 }

?></b><br /><br />
<input name="" type="button" value="Print" onclick="javascript:child_open()" style="cursor:pointer;" />
</div>
<div class="content" id="alert">
	<ul>
	<?php
	$CRITICAL=10;
	$sql2=mysql_query("select * from inventory where qtyleft<='$CRITICAL'");
	while($row2=mysql_fetch_array($sql2))
	{
	echo '<li>'.$row2['item'].'</li>';
	}
	?>
	</ul>
</div>
<div class="content" id="sales">
	<form action="tableedit.php#sales" method="post">
	From: <input name="from" type="text" class="tcal"/>
      To: <input name="to" type="text" class="tcal"/>
	  <input name="" type="submit" value="Seach" />
	  </form><br />
	 Total Sales:  
	  <?php
	  $a=$_POST['from'];
	  $b=$_POST['to'];
		$result1 = mysql_query("SELECT sum(sales) FROM sales where date BETWEEN '$a' AND '$b'");
		while($row = mysql_fetch_array($result1))
		{
			$rrr=$row['sum(sales)'];
			echo formatMoney($rrr, true);
		 }
		
		?>
</div>
<div class="content" id="addproitem">
<form action="updateproduct.php" method="post">
	<div style="margin-left: 48px;">
	Product name:<?php
	$name= mysql_query("select * from inventory");
	
	echo '<select name="ITEM" id="user" class="textfield1">';
	 while($res= mysql_fetch_assoc($name))
	{
	echo '<option value="'.$res['id'].'">';
	echo $res['item'];
	echo'</option>';
	}
	echo'</select>';
	?>
	</div>
	<br />
	Number of Item To Add:<input name="itemnumber" type="text" /><br />
	<div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Add" /></div>
</form>
</div>
<div class="content" id="addpro">
<form action="saveproduct.php" method="post">
	<div style="margin-left: 48px;">
	Product name:<input name="proname" type="text" />
	</div>
	<br />
	<div style="margin-left: 97px;">
	Price:<input name="price" type="text" />
	</div>
	<br />
	<div style="margin-left: 80px;">
	Quantity:<input name="qty" type="text" />
	</div>
	<div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Add" /></div>
</form>
</div>
<div class="content" id="editprice">
<form action="updateprice.php" method="post">
	<div style="margin-left: 48px;">
	Product name:<?php
	$name= mysql_query("select * from inventory");
	
	echo '<select name="ITEM" id="user" class="textfield1">';
	 while($res= mysql_fetch_assoc($name))
	{
	echo '<option value="'.$res['id'].'">';
	echo $res['item'];
	echo'</option>';
	}
	echo'</select>';
	?>
	</div>
	<br />
	<div style="margin-left: 97px;">Price:<input name="itemprice" type="text" /></div>
	<div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Update" /></div>
</form>
</div>
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['inventory', 'alert', 'sales', 'addproitem', 'addpro', 'editprice']);
</script>
</body>
</html>
