<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<div class="report">the flag $webdata['action'] is equal to search. In script tma02_selectrowtoedit.php</div>
<p>The data from the table</p>

<table>
<?php
$testfordata = array_filter( $webdata );
if (!empty($testfordata)){
	$sortdirection = 'ASC';
	if ($webdata['sortdirection'] == 'DESC' ) { $sortdirection = 'DESC'; }// must not use values from the form directly in the SQL to prevent injection attack.
	$sortby = 'lastname';
	if ($webdata['sortby'] == 'firstname') {$sortby = 'firstname';}
	if ($webdata['sortby'] == 'email') {$sortby = 'email';}

$firstname= "%".$webdata['searchcolumnfirstname']."%";
$lastname= "%".$webdata['searchcolumnlastname']."%";
$email ="%".$webdata['searchcolumnemail']."%" ;
$editid = $webdata['searchcolumnid'];
if (!empty($webdata['searchcolumnid'] )){ 
	$sql = "SELECT id, firstname, lastname , email FROM $mytable WHERE id = ? ";} 
	else {

$sql = "SELECT id, firstname, lastname , email FROM $mytable WHERE firstname LIKE ? AND lastname LIKE ? AND email LIKE ? ORDER BY $sortby $sortdirection";}
if ($stmt = $dbhandle->prepare($sql)) {
if (!empty($webdata['searchcolumnid'] )){
	$stmt->bind_param("s",$editid ); }
	else{
	$stmt->bind_param("sss",$firstname,$lastname,$email);}
	
$stmt->execute();
$result = $stmt->get_result();
var_dump($result);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	?>
        <tr><td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  name = "selecttt284guestform<?php echo $row["id"]; ?>" >
        <label for="submit<?php echo $row["id"]; ?>"> Edit: </label></td><td> 
        <input type="hidden" name="editid" value="<?php echo $row["id"]; ?>">
        <input type="hidden" name="action" value="edit">
        <input type="submit" name="submit" value="  <?php echo $row["id"]; ?>  ">
        </form>
        </td><td> Name: "<?php echo htmlspecialchars($row["firstname"]). " " . htmlspecialchars($row["lastname"]); ?>"</td><td> email= "<?php echo htmlspecialchars($row["email"]); ?>"</td></tr>
        
        
        <?php
    }}
} else {
    echo "0 results";
}

?>
</table>




