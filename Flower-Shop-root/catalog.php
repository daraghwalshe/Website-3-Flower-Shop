<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
	session_start();
	//$page_css = '';
	require_once("include/db_connect.php");
	include('include/INC_default_nav_style.php');
	
	$page_title = 'Catalog';
	$catalogLinkStyle = 'id="thispage"';
	$page_css = 'catalogNew.css';
	include('include/header.php');	
?>

<?php
	//The name of the database to connect to
	$db_link = db_connect("project");
	
	// create the SQL query and execute
	$query = "select * from products order by product_id";
	$result = @mysql_query( $query )or die( "Could not execute SQL query" );	

	if (isset($_SESSION['cart_state']))
	{
		echo $_SESSION['cart_state'];
		unset($_SESSION['cart_state']);
	} 

?>
		<table>
			<tr >
				<th>
					<strong>Item No:</strong>
				</th>
				<th>
					<strong> Name: </strong>
				</th>
				<th>
					<strong>Colour:</strong>
				</th>
				<th>
					<strong> Flowering in: </strong>
				</th>
				<th class="widen">
					<strong>Height:</strong>
				</th>
				<th class="widen">
					<strong> Soil:&nbsp; </strong>
				</th>
				<th>
					<strong>Hardiness:</strong> 
				</th>				
				<th class="widen">
					<strong> Price:</strong>
				</th>
				<th>
					<strong> Image:</strong> 
				</th>	
				<th class="widen">
					<strong> Quantity:</strong> 
				</th>
				<th class="widen">
					<strong> Add:</strong> 
				</th>
			</tr>	
	
<?php	
	// A function to give rows a different html class for styling
	include('include/FUNC_oddrow.php');

	// loop through all records & display in a HTML table
	while ($row = mysql_fetch_array( $result) )
	{
?>
			<tr <?php oddrow(); ?> >
				<td>
					<?php echo $row["product_id"]; ?>
				</td>
				<td>
					<?php echo $row["name"]; ?>
				</td>
				<td>
					<?php echo $row["colour"]; ?>
				</td>
				<td>
					<?php echo $row["blooming"]; ?>
				</td>
				<td>
					<?php echo $row["height"]; ?>
				</td>
				<td>
					<?php echo $row["soil"]; ?>
				</td>
				<td>
					<?php echo $row["hardiness"]; ?>
				</td>
				<td>
					&euro;<?php echo $row["price"]; ?>
				</td>
				<td>
					<a href="detailProduct.php?product_id=<?php echo $row['product_id']; ?>">
					<img width="70" height="70" src="images/<?php echo $row['image'];?>"> 
					</a>
				</td>
				<form action= "#" method="#">
				<td>
					<input type="number" name="quantity" value="1" min="1" max="999">
					<input type="hidden" name="product_id" value="<?php echo $row["product_id"];?>">
					<input type="hidden" name="price" value="<?php echo $row["price"];?>">
				</td>
				<td>
					<input type="submit" value="Add" name="submit">
				</td>
				</form>
			</tr>
			<?php $counter+=1; ?>

	<?php
	} // end loop
	?>
		</table>


<?php
//----------------------------------------------------------------------------
// If the user presses the Add to Cart button
if (isset($_REQUEST['submit']))
{
    //a variable to hold any error messages which need to be displayed to the user
    //$error = '';

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
		
		
		if (mysql_num_rows($check_result) > 0){
			
			$quantity += $row["quantity"];
			
			$query_qty_up = "UPDATE cart SET quantity = '$quantity' WHERE product_id = '$product_id' AND session_id = '$session'";
			$result = mysql_query($query_qty_up) or die("<br>Update query failed");
			}
		// an sql query to insert the item details into the cart, 
		// provided that the item is not in the cart 
		else{
			
			$insert_query = "INSERT INTO cart(session_id, product_id, price, quantity) VALUES ('$session', '$product_id', $price, $quantity)";

			// Run the query
			$result2 = mysql_query($insert_query) or die("<br>Insertion query failed");
			mysql_close();///////////////////////////////////
		}

		// Notify user if the items were inserted correctly to the cart table
		if ($result || $result2){
			$_SESSION['cart_state'] =  "<h3>Your Shopping cart has been updated</h3>";
		}
		else{
			 $_SESSION['cart_state'] = "<h3>There was a problem entering your items in the shopping cart</h3>";
		 }
	//header ("Location:catalog.php");

	echo "<script  type='text/javascript'>reloadDoc('catalog.php');</script>;";		
			
	}
?>


<?php
/*
		<script  type="text/javascript">
			reloadDoc("catalog.php");
		</script>
*/
	include('include/footer.php');
?>
