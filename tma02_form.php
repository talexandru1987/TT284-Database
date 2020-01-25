<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<div class="report">Generating an input form to match the columns in the table <?php echo $mytable ?> . In script tma02_form.php</div>
<?php
//setup an empty data array to match form fields
$section="";
$thisquery = "SHOW COLUMNS FROM $mytable";
$result = mysqli_query( $dbhandle, $thisquery ) or die (" Could not action the query " . $thisquery );
while ($myrow = mysqli_fetch_array($result)) {
	
	
	$row[ $myrow[0] ] = ""; //create an empty array value for each column in database
}
?>
<div class="report">Check first to see if we are editing an existing record. Note we should also authenticate the user before we permit edit or update of any record.</div>
<?php
if(!$valid){echo "<h1>Errors in form - message from server</h1>";}
//if($valid){echo "<h1>No errors in form - message from server</h1>";}
if( !empty($webdata['action'])){
if($webdata['action'] == 'save'){
	$webdata['editid'] ="";
}}

if( !empty($webdata['editid'])){
	$sql = "SELECT id, firstname, lastname , email FROM $mytable WHERE id = ?" ;
	if ($stmt = $dbhandle->prepare($sql)) {

		$stmt->bind_param("s", $webdata['editid']);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
}}

if($webdata['action'] == 'delete'){
	?>
	<div class="report">Action to delete has been confirmed.In script tma02_form.php</div>
	<h2>Confirm delete this existing data record</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  name = "tt284guestformdelete<?php echo $row["id"]; ?>" >
	<input type="hidden" name= "editid" id= "editid" value="<?php echo $row["id"]; ?>" >
	<input type="hidden" name= "action" id= "confirmdelete" value="confirmdelete" >
	<p class="delete"><label for="submitdelete">DELETE: <?php echo $row["id"] . "  " .htmlspecialchars($row["firstname"]). "  " . htmlspecialchars($row["lastname"]) ;?></label><input type="submit" class="delete" name="submitdelete" id="submitdelete" value="Confirm Delete:  <?php echo $row["id"] . "  " .htmlspecialchars($row["firstname"]). "  " . htmlspecialchars($row["lastname"]) ;?>"></p>
	</form>
	<?php
}

elseif($webdata['action'] == 'edit'){
				
				?>
					<div class="report">Action to edit has been confirmed.In script tma02_form.php</div>
					 <h2>Edit an existing data record</h2>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  name = "tt284guestformdelete<?php echo $row["id"]; ?>" >
					<input type="hidden" name= "editid" id= "editid" value="<?php echo $row["id"]; ?>" >
					<input type="hidden" name= "action" id= "action" value="delete" >
					<p><label for="delete">Delete: </label><input type="submit" name="delete" id="delete" value="Delete Record:  <?php echo $row["id"] . "  " .htmlspecialchars($row["firstname"]). "  " . htmlspecialchars($row["lastname"]) ;?>"></p>
					</form>
					
<?php					
				}	
					
					
}
else{ 
	if ($valid ){
	?>
	
	<p> </p>
	<label for="sectionb" class="showhide">Show Hide: Enter a new record</label>
	<input type="checkbox" id="sectionb" value="button" style="display:none;"/>
	<section id="bsection">
	<h3>Data Entry Form</h3>
	 <?php
	 $section="</section>";
	}
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  name = "tt284guestform<?php echo $row["id"]; ?>" onsubmit="return validate()">
	<label for="firstname">First name: </label>
	<input type="text" name="firstname" id="firstname" required maxlength="30" minlength="1" value="<?php if ($valid){echo htmlspecialchars($row["firstname"]);}
	else{echo htmlspecialchars($webdata["firstname"]);} ?>" onchange="fieldcheck(this.id)">
	<span id="fbfirstname">  
	</span><?php if (!$valid){echo $formerror["firstname"]  ;} ?>
	<p><label for="lastname">Last name: </label>
	<input type="text" name="lastname" id="lastname" required maxlength="30" minlength="1" value="<?php if ($valid){echo htmlspecialchars($row["lastname"]);}
	else{echo htmlspecialchars($webdata["lastname"]);} ?>" onchange="fieldcheck(this.id)">
	<span id="fblastname">  </span>
	<?php if (!$valid){echo $formerror["lastname"]  ;} ?></p>
	<p><label for="email">Email: </label>
	<input type="text" name="email" id="email"   maxlength="50" minlength="4" value="<?php if ($valid){echo htmlspecialchars($row["email"]); }else{echo htmlspecialchars($webdata["email"]);}?>" onchange="fieldcheck(this.id)">
	<span id="fbemail">  </span><?php if (!$valid){echo  $formerror["email"]  ;} ?></p>
	<p><label for="bookingreference">Booking Reference: </label>
	<input type="text" name="bookingreference" id="bookingreference" required maxlength="8" minlength="8" value="<?php if ($valid){echo htmlspecialchars($row["bookingreference"]);}
	else{echo htmlspecialchars($webdata["bookingreference"]);} ?>" onchange="fieldcheck(this.id)">
	<span id="fbbookingreference">  </span>
	<?php if (!$valid){echo $formerror["bookingreference"]  ;} ?></p>
	<p><label for="submit">Submit: </label>
	<input type="submit" name="submit<?php echo $row["id"]; ?>" id="submit<?php echo $row["id"]; ?>" value="Check and Submit from <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"></p>
	<input type ="hidden" name = "editid" id= "editid" value = "<?php if ($valid){echo $row["id"];}else{echo $webdata["id"];} ?>" >
	<input type ="hidden" name = "action" id= "action" value = "save" >
</form>
<?php
echo $section;
?>

