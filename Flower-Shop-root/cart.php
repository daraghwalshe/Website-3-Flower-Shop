
<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
	session_start();
	require_once("include/db_connect.php");

	//The name of the database to connect to
	$db_link = db_connect("project");
	
	
	//put the users shopping cart together
	$cart_query = "SELECT * FROM cart";
	$cart_result = mysql_query($cart_query) or die("<br>get cart query failed ");
	
	if( !isset( $_SESSION['cart_state'] )){
		if(mysql_num_rows($cart_result) > 0){
			$_SESSION['cart_state'] = " ";
			}
			else{
				$_SESSION['cart_state'] = " is currently empty";
				}
	} //end if cart_state not set


	include('include/INC_default_nav_style.php');
	$page_title = 'Shopping Cart';
	$cartLinkStyle = 'id="thispage"';
	$page_css = 'catalogNew.css';	
	include('include/header.php');	
	
?>	
		<h2>
			Your Shopping Cart <?php echo $_SESSION['cart_state']; ?>
		</h2>

<?php
	//if user has updated cart print confirmation
	
	//unset message for cart state change
	unset($_SESSION['cart_state']);

?>
	
		<table id="cart_table">
		<th colspan='7'>Your Shopping Cart</th>
		<tr>
			<th>Product ID</th>
			<th>Name</th>
			<th>Colour</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Subtotal</th>
			<th>Update</th>
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
				<td><?php echo $row["price"]?></td>
				<form action="#" method="post">
				<td><input type="number" name="quantity" value="<?php echo $row['quantity']?>" min="0" max="999"></td>
				<td>&euro;<?php echo number_format(($row['quantity'])*($row['price']), 2); ?></td>
				<td>
					<input type="submit" value="Update" name="submit">
					<input type="hidden" name="product_id" value="<?php echo $row["product_id"];?>">
				</td>
				</form>
			</tr>
<?php
		$total += (($row['quantity'])*($row['price']));
	}//end while loop
?>
			<tr>
				<td colspan="5"></td><td> Total :</td> 
				<td>&euro;<?php echo number_format($total, 2);?></td>
			</tr>
			<tr>
				<td colspan="7">Enter a number to change the Quantity or 0 to delete an item.</td>
			</tr>	
			<tr>
				<td colspan="5">
					<a href="catalog.php">Continue Shopping</a>
				</td>
				
				<td colspan="2">
					<form action="checkout.php" method="post">
						<input type="submit" value="Proceed to Checkout">
					</form>
				</td>
			</tr>
		</table>
		
<?php	
	include('include/footer.php');
?>


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
//----------------------------------------------------------------------------
	// If the user presses the Update button
	if (isset($_REQUEST['submit']))
	{
	//echo "submit pressed <br>";

		//a variable to hold any error messages which need to be displayed to the user
		$error = '';

		//session id and variables from item form
		$session = session_id();						//echo $session . "<br>";
		$product_id =  $_REQUEST['product_id'];			//echo $product_id . "<br>";
		$quantity =  $_REQUEST['quantity'];				//echo $quantity . "<br>";

		if (($quantity) > 0){

			$query_qty_up = "UPDATE cart SET quantity = '$quantity' WHERE product_id = '$product_id' AND session_id = '$session'";
			$result = mysql_query($query_qty_up) or die("<br>Update query failed");
			}
		// an sql query to delete the row if quantity selected is 0  
		else{
			//Form and execute the query
			$delete_query = "DELETE FROM cart WHERE product_id = '$product_id'";
			$result2 = mysql_query($delete_query) or die("<br>delete query failed");
			$cart_query = "";
		}

		// Notify user of the change to the shopping cart
		if (!empty($result)){
			$_SESSION['cart_state'] = " has been updated";
		}
		if (!empty($result2)){
			$_SESSION['cart_state'] = " has been updated, item removed";
		}

		//shut down the connection to the database
		mysql_close();
		//header ("Location:cart.php");
?>

		<script  type="text/javascript">
			reloadDoc("cart.php");
		</script>

<?php
	}// end if submit( Update button on cart page )
?>


