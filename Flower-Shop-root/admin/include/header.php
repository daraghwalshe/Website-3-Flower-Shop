
<?php

/*	 
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 *
 *   Header file for the Admin pages of Brilliant Bulbs online shop project
 */
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">		
		<title><?php echo $page_title; ?></title>
		<style>
			@import "../css/<?php echo $page_css ?>";
			@import "../css/adminFoot.css";
		</style>
	</head>

 <img src="../images/flowers.jpg" alt="background image" id="bg_img">

<div id="wrapper">

	<img width="16" src="../images/cogFolder.png" class="headImg" alt="flower image">	
	<h1 class="headerTxt">Brilliant Bulbs Admin</h1>
	<img width="16" src="../images/yellowFlower.png"  class="headImg" id="headImgRight" alt="flower image">

<!--  ********************  Nav Bar  ********************-->	
	<nav>
		<ul>
			<li>
				<a href="display.php"<?php echo $displayLinkStyle ?>>Display</a> <!--note was:   id="thispage"  -->
			</li>
			<li>
				<a href="insert.php"<?php echo $insertLinkStyle ?>>Insert</a>
			</li>
			<li>
				<a href="update.php"<?php echo $updateLinkStyle ?>>Update</a>
			</li>
			<li>
				<a href="delete.php"<?php echo $deleteLinkStyle ?>>Delete</a>
			</li>
			<li>
				<a href="logout.php"<?php echo $logoutLinkStyle ?>>Logout</a>
			</li>
		</ul>
	</nav>

