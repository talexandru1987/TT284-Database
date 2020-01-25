<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<div class="report">Delete one row of data:   <?php echo $webdata['editid'] ?>  from the table <?php echo $mytable ?> . In script tma02_deletedata.php</div>
<?php
if (!empty($_POST))
{
	
	if (isset($webdata['editid'] )){
		$sql = "DELETE FROM  $mytable  WHERE id = ? ";
		
		$stmt = mysqli_prepare($dbhandle, $sql );
		mysqli_stmt_bind_param($stmt,'s',$webdata['editid']);
		
	
	/* execute prepared statement */
	mysqli_stmt_execute($stmt);
	printf("%d Row deleted.\n", mysqli_stmt_affected_rows($stmt));
	/* close statement and connection */
	mysqli_stmt_close($stmt);
}}
?>
<div class="report">One row of data has been deleted from the table. In script tma02_deletedata.php</div>
