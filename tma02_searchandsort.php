<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<p> </p>
<div class="report">In script tma02_searchandsort.php</div>
<label for="sectionc" class="showhide">Show Hide: Search Form</label>
<input type="checkbox" id="sectionc" value="button" style="display:none;"/>
<section id="csection">
	<h3>Form to select which column should be searched, and how it should be sorted.</h3>
<div class="report">We will reuse our code to get the columns for the table, create dropdowns for these? or a search box for each?</div>
<h2>Search the Table <?php echo $mytable; ?> </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  name = "searchtt284guestform" >
<?php
$myselect='<label for="sortby">Select column to be sorted: </label><select name ="sortby" id="sortby" ><option value="lastname" selected >Sort By ? </option>';
$thisquery = "SHOW COLUMNS FROM " . $mytable ;// This is the SQL instruction
$result = mysqli_query( $dbhandle, $thisquery ) or die (" Could not action the query " . $thisquery );
while ($row = mysqli_fetch_array($result)) {
	?>
	<label for="searchcolumn<?php echo $row[0]; ?>"><?php echo $row[0]; ?>:</label><input type="text" name="searchcolumn<?php echo $row[0]; ?>" id="searchcolumn<?php echo $row[0]; ?>"  maxlength="10" minlength="0" value="" ><br />
	<?php
	$myselect = $myselect . '<option value="'.$row[0].'">'.$row[0].'</option>';
}
$myselect = $myselect .'</select>';

echo $myselect ;

?>
					Ascending: <input type="radio" name="sortdirection" id="ASC" value="ASC" CHECKED > 
					 Descending: <input type="radio" name="sortdirection" id="DESC" value="DESC"><br />
<p><label for="submit">Submit: </label><input type="submit" name="submitss" id="submitss" value="Search"></p>
<input type="hidden" name="action" value="search" >
</form>
</section>
<div class="report">End of script tma02_searchandsort.php</div>
