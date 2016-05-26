<?php

/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 *
 *   A generic db connection file for usbserver mysql
 *   This file was not written by me
 */

// Insert your own values for host name, user name and password
// and rename this file to db_connect.php and place it in your
// include path (as specified in your php.ini file)

// -----------------------------------------------------------------------------
// This function is common to all the database operations.
// It makes a connection to the database given its name
// and returns a link to the database.
// -----------------------------------------------------------------------------

	function db_connect($db_name)
	{
	   $host_name = "localhost";
	   $user_name = "root";
	   $password = "usbw";

	   $db_link = mysql_connect($host_name, $user_name, $password)
		  or die("Could not connect to $host_name");
	   mysql_select_db($db_name)
		  or die("Could not select database $db_name");
	   return $db_link;
	}
?>