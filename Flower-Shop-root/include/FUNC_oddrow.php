<?php	
/*
 *   B00064428 Daragh Walshe	April 2014
 *   Web Applications		    Assignment_2
 */	
	
// A function to give rows a different html class for styling
function oddrow(){
	$odd = ' class="oddrow" ';
	$even = ' class="evenrow" ';	
	global $counter;

	if($counter%2 == 0){
		echo $odd;
		}
	else{
		echo $even;
		}
	}
	//--------------------------------------------------------------
	
	?>
	
	