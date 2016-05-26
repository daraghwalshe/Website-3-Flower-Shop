
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

	$page_title = 'Display';
	$displayLinkStyle = 'id="thispage"';
	
	$page_css = 'admin.css';
	include('include/header.php');	
?>	


<?php
	
	//connect to the database
	require_once("include/db_connect.php");
	//The name of the database to connect to
	$db_link = db_connect("project");
	
	// create the SQL query and execute
	$query = "select * from products order by product_id";
	$result = @mysql_query( $query )or die( "Could not execute SQL query" );	
?>
		<br>
		<table id="display_table">
			<tr>
				<th>
					<strong> Image:</strong> 
				</th>				
				<th>
					<strong> Item No:</strong>
				</th>
				<th>
					<strong> Name: </strong>
				</th>
				<th>
					<strong> Colour:</strong>
				</th>
				<th>
					<strong> Flowering in: </strong>
				</th>
				<th class="widen">
					<strong> Height:</strong>
				</th>
				<th >
					<strong> Soil:&nbsp; </strong>
				</th>
				<th>
					<strong> Hardiness:</strong> 
				</th>				
				<th class="widen">
					<strong> Price:</strong>
				</th>	
			</tr>	
	
<?php	
	// A function to give rows a different html class for styling
	include('../include/FUNC_oddrow.php');

	// loop through all records & display in a HTML table
	while ($row = mysql_fetch_array( $result) )
	{
?>
			<tr <?php oddrow(); ?> >
				<td>
					<a href="detailProduct.php?product_id=<?php echo $row['product_id']; ?>">
					<img width="50" height="50" src="../images/<?php echo $row['image'];?>"> 
					</a>
				</td>				
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
			</tr>
			<?php $counter+=1; ?>

	<?php
	} // end loop
	?>
		</table>

<?php
	include('../include/footer.php');
?>

