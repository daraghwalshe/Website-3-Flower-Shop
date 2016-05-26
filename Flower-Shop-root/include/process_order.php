<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
 ?>

<?php

	   $first_name = trim($_REQUEST['firstname']);
	   $last_name = trim($_REQUEST['lastname']);
	   $address = trim($_REQUEST['address']);
	   $delivery = trim($_REQUEST['delivery']);
	   $credit = trim($_REQUEST['credit']);
	   $customer_id = uniqid("ORD_");
	   $session = session_id();
	   //$_SESSION['customer_id'] = $customer_id;	   
			
		//------------------------------------------------------------------------------------
		//construct the query to insert customer details on customer table
		$check_customer = "SELECT * FROM customer WHERE customer_id = '$customer_id' ";
		$customer_exists = mysql_query($check_customer) or die("<br>check customer query failed ");
		$num_rows = mysql_num_rows($customer_exists);
		
		//prevent a re-write to the db if user is using the browser back button		
		if(! isset($_SESSION['customer_id'])){
			$_SESSION['customer_id'] = $customer_id;	
			//echo "wrote customer to db<br>";
			
			//construct the query to insert customer details on customer table
			$insert_customer = "INSERT INTO customer (customer_id, first_name, last_name, address, delivery) VALUES ('$customer_id', '$first_name', '$last_name', '$address', '$delivery')";
			$customer_result = mysql_query($insert_customer) or die("<br>insert customer query failed ");			
			
			//---------------------------------------------------------------
			//query to get all products for this customer		
			$get_cart = "SELECT * FROM cart WHERE session_id = '$session' ";
			$customer_cart = mysql_query($get_cart) or die("<br>get cart query failed <br>");
						
			//place items from cart onto products_ordered table
			while ($cart_row = mysql_fetch_array($customer_cart)){
				$insert_product = "INSERT INTO products_ordered (order_id, session_id, prod_id, item_price, quantity)";
				$insert_product .= "VALUES ('$customer_id','".$cart_row["session_id"]."','".$cart_row["product_id"]."',".$cart_row["price"].",".$cart_row["quantity"].")";
				//echo $insert_product;
				$prod_result = mysql_query($insert_product) or die("<br>insert product query failed ");
				//echo "Prod_ordered row inserted<br>";
			}//end while loop
		}//end is session order in db already

		//Form and execute the query to delete session items from the cart table
		$delete_query = "DELETE FROM cart WHERE session_id = '$session'";
		$delete_result = mysql_query($delete_query) or die("<br>delete cart items query failed");

		//-----------------------------------------------------------------------------------------
		//Thank user for order and confirm details
		echo '<form class="user_form">';
			echo " <h3>Thank you for your order $first_name</h3>";

			echo " Your Order Reference Number is: $customer_id<br>";
			echo "The sum of &euro;".$_SESSION['total']." will be deducted from your account<br>";
			
			echo "Your details have been recorded as follows:<br>";
			echo " First name: $first_name <br>";
			echo " Last name: $last_name <br>";
			echo " Address: $address <br>";
			echo " Deliver to: $delivery <br>";
			echo " Charge to card: $credit <br>";		
		echo "</form>";
		
		unset($_SESSION['customer_id']);
		//session_destroy();
?>