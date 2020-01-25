<?php error_reporting(E_ALL); ini_set('display_errors', 1); // DO NOT MODIFY THIS LINE ?> 
<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<div class="report">Saving the form data to the database table. In script tma02_savedata.php</div>
<?php
if (!empty($_POST))
{
	if (isset($webdata['editid'] )) {echo "<h2>editid is set</h2>";}
	if (!empty($webdata['editid'] )){echo "<h2>editid is not empty</h2>";}
	
	if (isset($webdata['editid'] ) && !empty($webdata['editid'] )){
		$sql = "UPDATE $mytable SET firstname = ? , lastname= ? , email = ?  WHERE id = ? ";
		?>
		<div class="report">Using SQL to save form: <?php echo $sql ?></div>
		<?php
		$stmt = mysqli_prepare($dbhandle, $sql );
		mysqli_stmt_bind_param($stmt, 'ssss', $webdata['firstname'], $webdata['lastname'], $webdata['email'], $webdata['editid']);
		
	}else{
	$sql = "INSERT INTO $mytable (firstname, lastname, email, bookingreference) VALUES (?,?,?,?)";
	?>
		<div class="report">Using SQL to save form: <?php echo $sql ?></div>
		<?php
	$stmt = mysqli_prepare($dbhandle, $sql );
	mysqli_stmt_bind_param($stmt, 'ssss', $webdata['firstname'], $webdata['lastname'], $webdata['email'], $webdata['bookingreference']);
	
} 
	/* execute prepared statement */
	mysqli_stmt_execute($stmt);
	printf("%d row(s) changed <h2>Data Saved</h2>\n", mysqli_stmt_affected_rows($stmt));
	/* close statement and connection */
	mysqli_stmt_close($stmt);
}
?>
<div class="report">Data has been saved. In script tma02_savedata.php</div>
