<?php error_reporting(E_ALL); ini_set('display_errors', 1); // DO NOT MODIFY THIS LINE ?> 
<?php define('ISITSAFETORUN', TRUE); // flag to be tested by all required pages before they run. ?>
<!doctype html>
<head>
  <title>Delete a table from the Database</title>
</head>
<body>
<h1>tma02_delete-a-table.php</h1> 
<?php 
echo"<p>This line confirms that PHP is running on this server</p>";
?>
<h2>Now connect to the database server</h2>
<p> This uses the file tma02_mydatabase.php which you need to have added your credentials to.</p>
<p> These details are on the welcome page of your server</p>
<?php
require "tma02_mydatabase.php";
//connect to this host
$dbhandle = mysqli_connect( $hostname, $username, $password ) or die( "Failed - Unable to connect to MariaDB - check username and password in mydatabase.php. These details are on the welcome page of your server");
echo "<p>Success - Connected to MariaDB</p>"
?>
<h2>Now select the specific database</h2>
<?php
// define name of table to delete
$tabletodelete ="TT284zx489579";
//select a database to work with
$selected = mysqli_select_db(  $dbhandle, $mydatabase ) or die("Failed - Unable to connect to " . $mydatabase . ".  Check database name in mydatabase.php" );
echo "<p>Success - Connected to MariaDB database " . $mydatabase . "</p>"
?>
<h2>Now let's see what is in the database</h2>
<?php
$thisquery = "SHOW TABLES FROM " . $mydatabase ;// This is the SQL instruction
$result = mysqli_query( $dbhandle, $thisquery )   // This sends the query to the database
               or die (" Could not execute the query " . $thisquery );  //if it fails we report the error and stop
// Now we have been given an array containing the tables so iterate over that array and display each
while ($row = mysqli_fetch_array($result)) {
	echo "<p>Table: {$row[0]}</p>"; //note that there is only one item in each row, so the first item is item zero
}
?>
<h2>Delete a specified table</h2>

<?php   

// sql to delete table
$sql = "DROP TABLE $tabletodelete";

// Send request to database and report outcome
if (mysqli_query($dbhandle, $sql)) {
    echo "Table $tabletodelete deleted";
} else {
    echo "Error deleting table $tabletodeleted: " . mysqli_error($dbhandle);
}

mysqli_close($dbhandle);
?>
</body>
</html>


