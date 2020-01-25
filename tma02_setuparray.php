<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<div class="report">Setting up an array to match each column in the database table. In script tma02_setuparray.php</div>
<?php
//setup our clean data array to match form fields
$thisquery = "SHOW COLUMNS FROM $mytable";
$result = mysqli_query( $dbhandle, $thisquery ) or die (" Could not action the query " . $thisquery );
while ($row = mysqli_fetch_array($result)) {
	
	//echo "<p>Column: " . $row[0] . "</p>"; //note that there is only one item in each row, so the first item is item zero
	$webdata[ $row[0] ] = ""; //create an empty array value for each column in database
}

?>
<div class="report">The array to match each column in the database table has been created. In script tma02_setuparray.php</div>
