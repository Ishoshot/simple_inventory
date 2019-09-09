<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>Inventory</title>

        

        <!-- Our CSS stylesheet file -->

        <link rel="stylesheet" href="styles.css" />

        

        <!--[if lt IE 9]>

          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

        <![endif]-->

    </head>

    

<body>
<div style="margin:0 auto; width:300px; padding-left: 32px; margin-top:50px;">
	<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
echo '<ul class="err">';
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo '<li>',$msg,'</li>';
}
echo '</ul>';
unset($_SESSION['ERRMSG_ARR']);
}
$remark=$_GET['id'];
if($remark=='success')
{
echo '<ul>';
echo '<li>'." Registration Success You can now login ".'</li>';
echo '</ul>';
}
?>
</div>


		<div id="formContainer">

			<form id="login" method="post" action="login.php">

				<a href="#" id="flipToRecover" class="flipLink">Forgot?</a>

				<input type="text" name="username" id="loginEmail" placeholder="Username" />

				<input type="password" name="password" id="loginPass" placeholder="Password" />

				<input type="submit" name="submit" value="Login" />

			</form>

			<form id="recover" method="post" action="register.php">

				<a href="#" id="flipToLogin" class="flipLink">Forgot?</a>
				<input type="text" name="adminpass" id="loginEmail" placeholder="Admin Password" style="top: 138px;" />
				<input type="text" name="regusername" id="loginEmail" placeholder="Username" />
				<input type="password" name="regpassword" id="recoverEmail" placeholder="Password" />

				<input type="submit" name="submit" value="Save" />

			</form>

		</div>



    <!-- JavaScript includes -->

	<script src="jquery-1.7.1.min.js"></script>

		<script src="script.js"></script>


    

</body>

</html>



