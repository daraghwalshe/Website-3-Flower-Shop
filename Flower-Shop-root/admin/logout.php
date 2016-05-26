
<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
	session_start();	
	if (! isset($_SESSION['authenticated']))
	{
		header ("Location:login.php");
	}	
	
	
	include('include/default_admin_nav_style.php');

	$page_title = 'Logout';
	$logoutLinkStyle = 'id="thispage"';
	
	$page_css = 'admin.css';
	include('include/headerLogin.php');		
?>	
	
	<h1>
		Logout page
	</h1>
	
<?php

	//unset the session data and close the session
	$goodbyeName = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	session_destroy();
?>
	
	<h3>
		Goodbye <?php echo $goodbyeName ?> you have been logged out of the system
	</h3>
	
	<br><br>
	
		<nav id="logout">
			<ul>
				<li>
				<a href="login.php">Login</a>
				</li>

				<li>
				<a href="../index.php">Shop</a>
				</li>
			</ul>
		</nav>

	<br><br><br><br><br><br>
	<br><br><br><br><br><br>


<?php
	include('../include/footer.php');
?>

