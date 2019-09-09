<?php
//Start session
session_start();
 
//Include database connection details
require_once('db.php');
 
//Array to store validation errors
$errmsg_arr = array();
 
//Validation error flag
$errflag = false;
 
//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
$str = @trim($str);
if(get_magic_quotes_gpc()) {
$str = stripslashes($str);
}
return mysql_real_escape_string($str);
}

//Sanitize the POST values
$regusername = clean($_POST['regusername']);
$regpassword = clean($_POST['regpassword']);
$adminpass = clean($_POST['adminpass']);
//Input Validations
if($regusername == '') {
$errmsg_arr[] = 'Username missing';
$errflag = true;
}
if($regpassword == '') {
$errmsg_arr[] = 'Password missing';
$errflag = true;
}
 
//If there are input validations, redirect back to the login form
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
$result = mysql_query("SELECT * FROM user where password='".md5($_POST['adminpass'])."'");
$count=mysql_num_rows($result);

if($count!=0)
{
mysql_query("INSERT INTO user (username, password)
VALUES ('$regusername', '".md5($_POST['regpassword'])."')");
$errmsg_arr[] = 'Registration Success You can now login';
$errflag = true;
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
}
else{
$errmsg_arr[] = 'You dont have access to add user pls. contact the administrator';
$errflag = true;
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
}
?> 