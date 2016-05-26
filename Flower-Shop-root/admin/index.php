
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

	$page_title = 'Insert';
	
	$page_css = 'admin.css';
	include('include/header.php');	
?>	
	
	<br>
	<form class="user_form">
		<h1>
			Welcome to the Admin section <?php echo $_SESSION['valid_user']; ?>
		</h1>

		<h2>
			You may perform the following functions in this area:
		</h2>

		<h3>
			Display: view the items in the products table.
		</h3>

		<h3>
			Insert: Place new items into the products table.
		</h3>

		<h3>
			Update: view the items in the products table.
		</h3>

		<h3>
			Delete: Remove an item from the products table.
		</h3>

		<h3>
			Logout: Leave the admin area.
		</h3>

		<h2>
			Simply click one of the links at the top of the page.
		</h2>
	</form>

<?php
	include('../include/footer.php');
?>

