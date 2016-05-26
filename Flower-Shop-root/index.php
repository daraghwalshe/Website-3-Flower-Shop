

<?php
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
	session_start();
	require_once('include/db_connect.php');
	include('include/INC_default_nav_style.php');

	$page_title = 'Home Page';
	$homeLinkStyle = 'id="thispage"';
	$page_css = 'catalogNew.css';	
	include('include/header.php');
	include('include/side.php');
?>

<?php
	//The name of the database to connect to.
	$db_link = db_connect("project");
	
	// create the SQL query
	$query = "select * from products order by rand() limit 3";
	
	// execute the query
	$result = @mysql_query( $query )
	or die( "Could not execute SQL query" );
?>
	<br>
	<table class="smallTable">
		<tr>
			<th colspan="2">
				<strong>Our Random Sample:</strong>
			</th>			
		</tr>	
	
<?php	
	
	// A function to give rows a different html class for styling
	include('include/FUNC_oddrow.php');

	// loop through the three random products & display in a HTML table
	// display the image as a hyperlink
	while ($row = mysql_fetch_array( $result) )
	{
?>
			<tr<?php oddrow();$counter+=1 ?>>
				<td rowspan="3" id="img_data">
					<a href="detailProduct.php?product_id=<?php echo $row["product_id"];?>"> <!--  vvvvvvvvvv  -->
					<img width="120" height="140" src="images/<?php echo $row["image"];?>"> 
					</a>
				</td>			
				<td>
					Name:&nbsp;<?php echo $row["name"]; ?>
				</td>
			</tr>
			<tr<?php oddrow();$counter+=1 ?>>
				<td>
					Height:&nbsp;<?php echo $row["height"];?>cm
				</td>
			</tr>
			<tr<?php oddrow();$counter+=1 ?>>
				<td>
					Price:&nbsp;&euro;<?php echo number_format($row['price'], 2); ?>
				</td>
			</tr>
<?php
	} // end loop
?>
		</table>
<?php
	include('include/footer.php');
?>

