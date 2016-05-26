
<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
 ?>
 
 <?php
// -----------------------------------------------------------------------------
// Generates the user form and processes.
// The form checks for errors and is sticky
// -----------------------------------------------------------------------------

	if (isset($_REQUEST['button'])) // submit was clicked
	{
	   process_form();
	}
	else // display form for first time
	{
	   display_form_page('');
	}
?>

<?php
// Display the form page and the error message
// An empty error message indicates valid data
function display_form_page($error)
{
	$self = $_SERVER['PHP_SELF'];
	$first_name = isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : '';
	$last_name = isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : '';
	$address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
	$delivery = isset($_REQUEST['delivery']) ? $_REQUEST['delivery'] : '';
	$credit = isset($_REQUEST['credit']) ? $_REQUEST['credit'] : '';

	?>

	<div class="user_form">	
		<form action="<?php echo $self ?>" method="POST" id="inputForm">
		<h2>
			Please complete the Customer Order Form
		</h2>

		<h4 id="errorMessage">
		<?php
			if ($error)
			{
			   echo "$error <br>";
			}
		?>
		</h4>	

		<p>
			First  name: <input class="input" type="text" name="firstname" value="<?php echo $first_name?>">
		</p>

		<p>
			Last name: <input class="input" type="text" name="lastname" value="<?php echo $last_name?>">
		</p>

		<p>
			Address: <input class="input" type="text" name="address" value="<?php echo $address?>">
		</p>

		<p>
			Delivery Address: <input class="input" type="text" name="delivery" value="<?php echo $delivery?>">
		</p>

		<p>
			Credit Card No: <input class="input" type="text" name="credit" value="<?php echo $credit?>"
			placeholder="1234-2345-3456-4567 format please">
		</p>

		<p>
			<input type="submit" name="button" id="submit" value="Submit">
			<input type="reset" name="reset" id="reset" value="Clear">
		</p>

		</form>
	</div>
<?php
}
?>


<?php
	function process_form()
	{
	   $error = validate_form();
	   if ($error)
	   {
		  display_form_page($error);
	   }
	   else
	   {
		  process_order();
	   }
	}
?>


<?php
// Return an error string that is empty if there were no errors.
// Otherwise it contains an error message.
function validate_form()
{
   $first_name = trim($_REQUEST['firstname']);
   $last_name = trim($_REQUEST['lastname']);
   $address = trim($_REQUEST['address']);
   $delivery = trim($_REQUEST['delivery']);
   $credit = trim($_REQUEST['credit']);
   $error = '';

   //Check users input is valid using reg-expressions
   $reg_exp = '/^[a-zA-Z\-\']+$/';
   $card_exp = '/^[0-9]{4}\-[0-9]{4}\-[0-9]{4}\-[0-9]{4}$/';

   if (! preg_match($reg_exp, $first_name))
   {
      $error .= "<span class=\"error\">First name is invalid (letters, hyphens, ', only)</span><br>";
   }
   if (! preg_match($reg_exp, $last_name))
   {
       $error .= "<span class=\"error\">Last name is invalid (letters, hyphens, ', only)</span><br>";
   }
   if (strlen($address) == 0)
   {
       $error .= "<span class=\"error\">Address is invalid (letters, hyphens, ', only(whole numbers only)</span><br>";
   }
   if (strlen($delivery) == 0)
   {
       $error .= "<span class=\"error\">Delivert Address is invalid (letters, hyphens, ', only(whole numbers only)</span><br>";
   }
   if (!( preg_match($card_exp, $credit)) ) 
   {
       $error .= "<span class=\"error\">Please use 1111-2222-3333-4444 format</span><br>";
   }
   return $error; 
}
?>

<?php
	function process_order()
	{
		include('include/process_order.php');				
	} //end function process_order	
?>
