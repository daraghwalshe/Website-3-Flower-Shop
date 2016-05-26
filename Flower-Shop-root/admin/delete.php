
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

	$page_title = 'Delete';
	$deleteLinkStyle = 'id="thispage"';
	
	$page_css = 'admin.css';
	include('include/header.php');	
?>	
	
	<br><br><br>
	
<?php 
	if (isset($_SESSION['delete_status']))
	{
		echo $_SESSION['delete_status'];
		unset($_SESSION['delete_status']);
	} 
?>	
	
	<form action="#" method="post" class="delete_form"><!--  id="loginForm"  -->

		<h2>
			Please enter the product ID of the item to delete.
		</h2>
		<h4>
			Values in the range b001 to b999
		</h4>

		<h3>
			Product ID:
			<input type="text" name="product_id" size="30" autofocus required> <br>
		</h3>

		<input type="submit" id="submit" name="button" value="Delete">
		<input type="reset" id="reset" value="Clear Form" id="button">
	</form>	
	
	<br><br><br><br><br><br><br><br><br>

<?php

	// if submit was clicked
	if(isset($_REQUEST['button']))
	{
		$product_id = trim($_REQUEST['product_id']);

		//connect to the database
		require_once("include/db_connect.php");
		//The name of the database to connect to
		$db_link = db_connect("project");

		// create the SQL query and execute
		$check_query = "SELECT * FROM products WHERE product_id = '$product_id'";
		$delete_query = "DELETE FROM products WHERE product_id = '$product_id'";
			
		$check_result = @mysql_query( $check_query )or die( "" );
		$delete_result = @mysql_query( $delete_query )or die( "" );


		if (mysql_num_rows($check_result) < 1)
		{		
			$_SESSION['delete_status'] = "<h3>No matches found in product table</h3>";
			mysql_close();
			header ("Location:delete.php");
		}		
		else
		{		
			$_SESSION['delete_status'] = "<h3>Item was sucessfully deleted from product table</h3>";
			mysql_close();
			header ("Location:delete.php");
		}
	}

?>


<?php
	include('../include/footer.php');
?>

