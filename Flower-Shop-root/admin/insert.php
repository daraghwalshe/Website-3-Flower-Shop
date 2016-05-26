
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
	$insertLinkStyle = 'id="thispage"';
	
	$page_css = 'admin.css';
	include('include/header.php');	

	if (isset($_REQUEST['button'])) // submit was clicked
	{
	   process_form();
	}
	else // display form for first time
	{
	   display_form_page();
	}
?>	


<?php
// Display the form page
function display_form_page()
{
?>
	<h2>
		Please insert details of new item
	</h2>
	
	<?php 
	if (isset($_SESSION['insert_status']))
	{
		echo $_SESSION['insert_status'];
		unset($_SESSION['insert_status']);
	} 
	
	?>

	<form action= "<?php /*echo $self*/ ?>" method= "post" class="user_form"><!--  id="loginForm"  -->
		<p>
			Product ID:
			<input type="text" name="product_id" size="40" class="input" autofocus required> <br>
		</p>
		<p>
			Name:
			<input type="text" name="name" size="40" class="input" required> <br>
		</p>
		<p>
			Colour:
			<input type="text" name="colour" size="40" class="input" required> <br>
		</p>
		<p>
			Flowers In:
			<input type="text" name="blooming" size="40" class="input" required> <br>
		</p>		
		<p>
			Height:
			<input type="number" name="height" size="40" class="input" required> <br>
		</p>
		<p>
			Soil:
			<input type="text" name="soil" size="40" class="input" required> <br>
		</p>
		<p>
			Hardiness:
			<input type="text" name="hardiness" size="40" class="input" required> <br>
		</p>		
		<p>
			Price:
			<input type="text" name="price" size="40" class="input" required> <br>
		</p>
		<p>
			Image Name:
			<input type="text" name="image" size="40" class="input" required> <br>
		</p>		

		<input type="submit" id="submit" name="button" value="Submit">
		<input type="reset" id="reset" value="Clear Form" id="button">
	</form>
<?php
}
?>


<?php
	function process_form()
	{
		//echo "<br>Processing form<br>";
		
		$product_id = trim($_REQUEST['product_id']);
		$name = trim($_REQUEST['name']);
		$colour = trim($_REQUEST['colour']);
		$blooming = trim($_REQUEST['blooming']);
		$height = trim($_REQUEST['height']);		
		$soil = trim($_REQUEST['soil']);
		$hardiness = trim($_REQUEST['hardiness']);
		$price = trim($_REQUEST['price']);
		$image = trim($_REQUEST['image']);
		
		//---------------------------------------------------
		
		//connect to the database
		require_once("include/db_connect.php");
		//The name of the database to connect to
		$db_link = db_connect("project");

		// create the SQL query and execute
		$insert_query  = "INSERT INTO products VALUES(";
		$insert_query  .= "'$product_id', '$name', '$colour', '$blooming', $height, '$soil', '$hardiness', $price, '$image');";
		
		//echo $insert_query;
		
		$result = @mysql_query( $insert_query )or die( "Could not execute insert new item query" );
		mysql_close();
		
		if($result)
		{
			$_SESSION['insert_status'] = "<h3>New item was sucessfully added to product table</h3>";
			header ("Location:insert.php");
		}
		else
		{
			echo "<h3>There was a problem entering the item into the products table</h3>";	
		}
			
	}
?>


<?php
	include('../include/footer.php');
?>

	

