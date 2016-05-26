
<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Lab_08
 */

	//Start the session
	session_start();
	require_once("include/db_connect.php");
	include('include/INC_default_nav_style.php');
	$back_to = 'Back to';
	$page_title = 'Product Details';
	$cartLinkStyle = 'id="thispage"';
	$page_css = 'catalogNew.css';
	include('include/header.php');		
?>

<?php
	//$product_id is the value we brought with us from the catalog page
	$product_id = $_REQUEST['product_id'];//echo $product_id;
	//put the name of the database to connect to here
	$db_link = db_connect("project");
	
	// create the SQL query
	$query = "select * from products where product_id = '$product_id'";
	
	// execute the query
	$result = @mysql_query( $query )or die( "Could not execute SQL query" );
?>	
	
<?php	
	// A function to give rows a different html class for styling
	include('include/FUNC_oddrow.php');

	// loop through all records & display in a HTML table
	while ($row = mysql_fetch_array( $result) )
	{
?>			
			<br>
			<table class="detailTable">
			<tr>
				<th colspan="2">
					<strong>Name:&nbsp;<?php echo $row["name"]; ?> </strong>
				</th>			
			</tr>
			
			<tr<?php oddrow();$counter+=1 ?>>
				<td rowspan="6" id="img_data">
					<img src="images/<?php echo $row["image"];?>" id="adminDetail"> 
				</td>
				
				<td>
					Blooms in:&nbsp;<?php echo $row["blooming"]; ?>
				</td>
			</tr>

			<tr<?php oddrow();$counter+=1 ?>>
				<td>
					Colour:&nbsp;<?php echo $row["colour"]; ?>
				</td>
			</tr>
			
			<tr<?php oddrow();$counter+=1 ?>>
				<td>
					Height:&nbsp;<?php echo $row["height"]; ?>cm
				</td>
			</tr>
			
			<tr<?php oddrow();$counter+=1 ?>>
				<td>
					Soil:&nbsp;<?php echo $row["soil"]; ?>
				</td>
			</tr>

			<tr<?php oddrow();$counter+=1 ?>>
				<td>
					Price:&nbsp;&euro;<?php echo $row["price"]; ?>
				</td>
			</tr>
				
			<tr<?php oddrow();$counter+=1 ?>>
			<form>
				<td id="cartRow">
					<input type="number" name="quantity" value="1" min="0" max="99">
					&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Add to Cart" name="submit">
					<input type="hidden" name="product_id" value="<?php echo $row["product_id"];?>">
					<input type="hidden" name="price" value="<?php echo $row["price"];?>">
				</td>
			</form>
			</tr>
			
<?php
	} // end loop
?>
		</table>
	</body>
</html>


<?php
//----------------------------------------------------------------------------
// If the user presses the Add to Cart button
if (isset($_REQUEST['submit']))
{
    //a variable to hold any error messages which need to be displayed to the user
    $error = '';

	//$result = 0;
	$session = session_id();					//echo $session . "<br>";
	$product_id =  $_REQUEST['product_id'];		//echo $product_id . "<br>";
	$price =  $_REQUEST['price'];				//echo $price . "<br>";
	$quantity =  $_REQUEST['quantity'];			//echo $quantity . "<br>";

	// An sql query to check if the item is in the cart already for this session
	$check_query = "SELECT * FROM cart WHERE product_id = '$product_id' AND session_id = '$session' ";//echo $check_query;

	// Run the query
	$check_result = mysql_query($check_query) or die("<br>Select query failed ");

	// place the result(should be only one) in an array
	$row = mysql_fetch_array($check_result);

	// an sql query to insert the item details into the cart, and update quantity
	if (mysql_num_rows($check_result) > 0){
		$quantity += $row["quantity"];
		$query_qty_up = "UPDATE cart SET quantity = '$quantity' WHERE product_id = '$product_id' AND session_id = '$session'";
		$result = mysql_query($query_qty_up) or die("<br>Update query failed");
	}	 
	// provided that the item is not in the cart 
	else{
		$insert_query = "INSERT INTO cart(session_id, product_id, price, quantity) VALUES ('$session', '$product_id', $price, $quantity)";
		// Run the query
		$result2 = mysql_query($insert_query) or die("<br>Insertion query failed");			
	}

	// Notify user if the items were inserted correctly to the cart table
	if ($result || $result2){
		echo "<h3>Your Shopping cart has been updated</h3>";
	}
	else{
		 $error .= "There was a problem entering your items in the shopping cart<br>";
		 echo $error;
	 }
}
	
	//shut down the connection to the database
	mysql_close();
	include('include/footer.php');
?>






