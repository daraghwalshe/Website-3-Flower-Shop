
<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
	session_start();
	require_once("include/db_connect.php");
	//The name of the database to connect to
	$db_link = db_connect("project");
	
	//Get the users shopping cart items
	$cart_query = "SELECT * FROM cart";
	$cart_result = mysql_query($cart_query) or die("<br>get cart query failed ");
	
	include('include/INC_default_nav_style.php');
	$page_title = 'Checkout';
	$checkoutLinkStyle = 'id="thispage"';
	$page_css = 'catalogNew.css';
	include('include/header.php');	
	
?>	
		<h2>
			Checkout
		</h2>
	
		<table id="cart_table">
		<th colspan='6'>Your Shopping Cart</th>
		<tr>
			<th>Product ID</th>
			<th>Name</th>
			<th>Colour</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Subtotal</th>
			
		</tr>
	<?php	
		$total = 0;
		//loop to display values in the cart table
		while ($row = mysql_fetch_array($cart_result))
		{
	?>		
			<tr border=1>
				<td><?php echo $row['product_id']?></td>
				<?php $details = get_details($row['product_id']); ?>
				<td><?php echo $details['name']?></td>
				<td><?php echo $details['colour']?></td>
				<td><?php echo number_format($row['price'], 2);?></td>
				<td><?php echo $row['quantity']?></td>
				<td>&euro;<?php echo number_format(($row['quantity'])*($row['price']),2)?></td>
			</tr>
	<?php
			$total += ($row['quantity'])*($row['price']);
		}//end while loop
		$_SESSION['total'] = $total;
	?>
			<tr>
				<td colspan="4"></td><td> Total :</td>    <td>&euro;<?php echo number_format($total, 2);?></td>
			</tr>	
			<tr>
				<td colspan="4"></td>
							
				<td colspan="2">
					<form action="catalog.php" method="post">
						<input type="submit" value="Continue Shopping">
					</form>
				</td>
			</tr>
		</table>
<?php
	//------------------------------------------------------------------------------------
	//a function to get some extra details from the products table to display on cart page
	function get_details($prod_id){
		//construct the product details query and execute
		$detail_query = "SELECT * FROM products WHERE product_id LIKE '".$prod_id."';";
		$detail_result = mysql_query($detail_query) or die("<br>get details query failed ");

		// place the result(should be only one) in an array
		$detail_row = mysql_fetch_array($detail_result);

		return $detail_row;
		}
?>

<?php
	include('include/userForm.php');
	
	include('include/footer.php');
?>



<?php

?>