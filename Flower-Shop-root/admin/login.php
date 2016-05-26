
<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
	session_start();
	require_once("include/db_connect.php");
	include('include/default_admin_nav_style.php');

	$page_title = 'Login';
	$loginLinkStyle = 'id="thispage"';	
	$page_css = 'admin.css';
	
	include('include/headerLogin.php');	
?>	
	
	<h1>
		Login Page
	</h1>

<?php 

	// if submit was clicked
	if(isset($_REQUEST['button']))
	{
		$error = validate_form();

		if ($error){
			display_form_page($error);
		}
		else{
			display_output_page();
		}
	}
	// displays the blank form for the first time
	else{
		display_form_page('');
	}
?>
	
<?php
	function validate_form(){
		
		$username = trim($_REQUEST['username']);
		$password = trim($_REQUEST['password']);

		$error = '';

		if (strlen($username) == 0){
			$error .= "Please fill in your name<br>";	
		}
		if (strlen($password) < 4){
			$error .= "Password must be a minimum of 4 characters<br>";	
		}
		return $error;
	}
?>

<?php
	function display_form_page($error){
		
		$self = $_SERVER['PHP_SELF'];
		$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
		$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
?>


<?php
	if ($error){
		echo "<h3>Error: $error</h3>";
	}

	if (isset($_SESSION['login_error']))
	{
		echo $_SESSION['login_error'];
		unset($_SESSION['login_error']);
	} 
?>

		<form action= "<?php echo $self ?>" method= "post" class="user_form"><!--  id="loginForm"  -->

			<h2>
				Please enter your name and Password
			</h2>

			<p>
				Name:
				<input type="text" name="username" size="40" class="input" required> <br>
			</p>

			<p>
				Password:
				<input type="password" name="password" size="40" class="input" required> <br>
			</p>

			<input type="submit" id="submit" name="button" value="Sign In">
			<input type="reset" id="reset" value="Clear Form" id="button">
		</form>

		<br><br>
		<nav id="login_link">
			<ul>
				<li>
				<a href="../index.php">Return to Shop</a>
				</li>
			</ul>
		</nav>
		
		<br><br><br><br><br><br><br><br>
	
<?php
}
?>

<?php
	function display_output_page(){
		
		// Get the name and password again
		// Save as $username and $password
		$username = trim($_REQUEST['username']);
		$password = trim($_REQUEST['password']);
		
		// Connect to the database
		$db_link = db_connect("project");
		
		//set up the sql query
		$query ="select * from users where username = '$username' and password = MD5('$password') ";

		//run the query
		$result = mysql_query($query) or die ("<br> Could not execute SQL query");
		$row = mysql_fetch_assoc($result);

?>

	<body>

<?php
		// If the name and password have been inserted correctly
		if($row)
		{
			$_SESSION['valid_user'] = $username;
			$_SESSION['authenticated'] = true;
			mysql_close();	
			header ("Location:index.php");
		}
		else
		{
			$_SESSION['login_error'] = "<h3>Invalid username or password.<br>You are not authorised to enter the admin area.</h3>";
			mysql_close();	
			header ("Location:login.php");
		}
		
	}//end function display_output_page
?>

	</body>
	</html>

<?php
	include('../include/footer.php');
?>

