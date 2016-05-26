
<?php

/*	 
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */
 
 //This page is used to bounce out from the cart table and back again
 //allowing us to redraw the page on submit of an item change in the cart
 //mainly for item deletes so our page stays consistent with database cart
 //I know it's javascript, but this is an area we didn't really cover. !!
 //It causes the information in the headers to be cleared
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
	
	<script type="text/javascript">
		function reloadDoc(returnAddress){
		  location.assign(returnAddress);
		  }
	</script>
	
		<meta charset="utf-8">		
		<title>bounce</title>
	</head>

	<body>
		<script type="text/javascript">
			reloadDoc(returnAddress);
		</script>	
	</body>
	
</html>


<?php
/*
	<script type="text/javascript">
		function reloadDoc(){
		  location.assign("cart.php");
		  }
	</script>
*/
?>

