
<?php

/*	
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 *
 *   Header file for the Shopping pages of Brilliant Bulbs online shop project
 */
?>

<!DOCTYPE html>
	<html lang="en">
	<head>	

	<script type="text/javascript">
	function reloadDoc(returnAddressIn){
	  location.assign(returnAddressIn);
	  }
	</script>

		<meta charset="utf-8">		
		<title><?php echo $page_title; ?></title>
		<style>
			@import "css/<?php echo $page_css ?>";
			@import "css/footer.css";
		</style>
	</head>

 <img src="images/leaves.jpg" alt="background image" id="bg_img">

<div id="wrapper">

	<img width="16" src="images/pollen.png" class="headImg" alt="flower image">	
	<h1 class="headerTxt">Brilliant Bulbs</h1>
	<img width="16" src="images/pollen.png"  class="headImg" id="headImgRight" alt="flower image">

<!--  ********************  Nav Bar  ********************-->	
	<nav>
		<ul>
			<li role="link">
				<a href="index.php"<?php echo $homeLinkStyle ?>>Home Page</a> <!--note was:   id="thispage"  -->
			</li>
			<li role="link">
				<a href="catalog.php"<?php echo $catalogLinkStyle ?>>Catalog</a>
			</li>
			<li role="link">
				<a href="cart.php"<?php echo $cartLinkStyle ?>><?php echo $back_to ?>Shopping Cart</a>
			</li>
			<li role="link">
				<a href="checkout.php"<?php echo $checkoutLinkStyle ?>>Checkout</a>
			</li>
			<li role="link">
				<a href="about.php"<?php echo $aboutLinkStyle ?>>About</a>
			</li>
		</ul>
	</nav>

