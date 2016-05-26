
<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
	include('include/INC_default_nav_style.php');
	require_once("include/db_connect.php");
	
	$page_title = 'Search';
	$aboutLinkStyle = 'id="thispage"';
	$page_css = 'catalogNew.css';	
	include('include/header.php');	
	include('include/side.php');
?>

	<h1>
		You may search for products from this page
	</h1>
	<div class="smallBody">

<?php		
	if (isset($_REQUEST['submit'])) // submit was clicked
	{
		process_form();
	}
	else // display form for first time
	{
		display_form_page('');
	}	
?>	

<?php
// Display the form along with any errors
// If there are no errors then the error string will be empty
function display_form_page($error)
{
	$self = $_SERVER['PHP_SELF'];
	$search_by = isset($_REQUEST['search_by']) ? $_REQUEST['search_by'] : '';
	$search_by = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
?>


<?php
	//A function to loop through the error array
	//displaying each error on a new line of an ordered list
	if ($error)
	{
?>
	<h4 id="error_title">The following form entries are incorrect or incomplete:</h4>

	<ul class="search_error">
		<?php foreach($error as $err){ ?>
		<span >
		<li>
			<?php echo $err; }?>
		</li>
		</span>
	</ul>
<?php
	}
?>

		<form action="#" method="post" id="searchForm">
			<table>
				<tr>
					<td>
						<input type="radio" name="search_by" value="product_id" <?php check($search_by, "product_id")?>>
						Product ID
					</td>
					<td>
						<input type="radio" name="search_by" value="name" <?php check($search_by, "name")?>>
						Name
					</td>
					<td>
						<input type="radio" name="search_by" value="colour" <?php check($search_by, "colour")?>>
						Colour
					</td>
					<td>
						<input type="radio" name="search_by" value="blooming" <?php check($search_by, "blooming")?>>
						Blooms in
					</td>
					<td>
						<input type="radio" name="search_by" value="height" <?php check($search_by, "height")?>>
						Height
					</td>
					<td>
						<input type="radio" name="search_by" value="soil" <?php check($search_by, "soil")?>>
						Soil Type
					</td>
					<td>
						<input type="radio" name="search_by" value="hardiness" <?php check($search_by, "hardiness")?>>
						Hardiness
					</td>
					<td>
						<input type="radio" name="search_by" value="price" <?php check($search_by, "price")?>>
						Price
					</td>
				</tr>
				
				<tr>
					<td colspan="8">
					&nbsp;
					<input type="text" name="search" size="30">
					</td>
				</tr>
				
				<tr>
					<td colspan="8">
						<input type="Submit" value="Search" name="submit" class="button">
						<input type="Reset" value="Clear fields" name="reset" class="button">
					</td>
				</tr>
				
			</table>
		</form>
	</div>
<?php
} //end display form
?>



<?php
	// If $group has the value $val then check this radio button
	function check($group, $val)
	{
	   if ($group === $val)
	   {
		  echo 'checked = "checked"';
	   }
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
		  display_output_page();
	   }
	}
?>

<?php
// If there are erors this function will put each new error
// as a new element of an array, to display back to the user.
function validate_form()
{
	if(!(empty($_REQUEST["search_by"]))){
	   $search_by = $_REQUEST["search_by"];
	   }
	$search = trim($_REQUEST['search']);

	$error = '';
	if (! isset($search_by))
	{
	  $error[] =  "Please select the heading to search under<br>";
	}
	if (strlen($search) == 0)
	{
	  $error[] =  "Please enter a search term<br>";
	}		
	return $error;
}
?>


<?php
	//---------------------------------------------------------------------------------------
	//A function to display the output page to the user
	function display_output_page()
	{
		require_once("include/db_connect.php");
		$db_link = db_connect("project");				//debug:
		$search_by = trim($_REQUEST['search_by']);		//echo "Search heading: " .$search_by;
		$search = trim($_REQUEST['search']);			//echo "Search term: " .$search. "<br>";
		
	//put the users results table together
	$search_query = "SELECT * FROM products WHERE $search_by LIKE '%$search%'" ;	//echo $search_query;
	$search_result = mysql_query($search_query) or die("<br>search query failed ");
	$num_matches = mysql_num_rows($search_result);//echo "number of finds:" . $num_matches;

	echo "<table>";
	echo "<th colspan='9'>Search Results :$num_matches matches found</th>";
	echo "<tr>
				<td>Image</td>
				<td>Product ID</td>
				<td>Name</td>
				<td>Colour</td>
				<td>Blooms in:</td>
				<td>Height</td>
				<td>Soil Type</td>
				<td>Hardiness</td>
				<td>Price</td>		 
		 </tr>";

		while ($row = mysql_fetch_array($search_result))
		{
			echo "<tr border=1>";		
				echo "<td>
					<a href='detailProduct.php?product_id=".$row['product_id']."'>
					<img width='50' height='50' src='images/".$row['image']."'> 
					</a>
				</td>";
						
				echo "<td>".$row['product_id']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['colour']."</td>";
				echo "<td>".$row['blooming']."</td>";
				
				echo "<td>".$row['height']."</td>";
				echo "<td>".$row['soil']."</td>";
				echo "<td>".$row['hardiness']."</td>";
				echo "<td>&euro;".number_format($row['price'], 2)."</td>";				
			echo "</tr>";
		}

	echo"</table>";		
	
	} //end display_output_page

	//---------------------------------------------------------------------
	//mysql_close();
	include('include/footer.php');
?>

