<?php
define('ISITSAFETORUN', TRUE); //each required file needs code to prevent it running if it cannot detect this.
$webdata = array();
$mytable = "TT284zx489579"; //set a variable for the database table
$mytitle = 'Erehwon Guest House zx489579 ';
$mycss   = "tma02_.css"; //set a variable for the css file
$myjs    = "tma02_.js"; //set a variable for the js file
$valid   = TRUE; //set flag for errors in form
require 'tma02_head.php'; //the header information
echo "<h1>$mytitle</h1>"; //insert the h1 title
?>
<label for="reporta" class="showhide">Show Hide: Report on script actions</label>
<input type="checkbox" id="reporta" value="button" style="display:none;" />
<div class="report">tma02_coreadmin.php is running</div>
<?php
require "tma02_mydatabase.php"; // database name, user, password
require "tma02_dbconnect.php"; // script to connect to database
require "tma02_setuparray.php"; // set up empty array to match the database table
require 'tma02_formdata.php'; //add the script to process form input
$testfordata = array_filter($webdata);
if (!empty($testfordata))
  {
  if (!empty($webdata['action']))
    {
?>
		<div class="report">In script tma02_coreadmin.php $webdata['action']  holds the value: <?php
    echo $webdata['action'];
?>
		</div>
<?php
    if ($webdata['action'] == 'save')
      {
      require "tma02_validatedata.php";
?>
			<div class="report">In script tma02_coreadmin.php $valid  holds the value: <?php
      echo $valid;
?>			</div>
<?php
      if ($valid)
        {
        require "tma02_savedata.php"; //script to save new data to the form
        } //$valid
      } //$webdata['action'] == 'save'
    if ($webdata['action'] == 'confirmdelete')
      {
      require "tma02_deletedata.php"; //script to delete data from the form
      } //$webdata['action'] == 'confirmdelete'
    } //!empty($webdata['action'])
  require "tma02_form.php"; //add the input form
  require "tma02_displayalldata.php"; //script to display all data from the form
  require "tma02_searchandsort.php";
  if (!empty($webdata['action']))
    {
    if ($webdata['action'] == "search")
      {
      require "tma02_selectrowtoedit.php";
      } // we only need to display search results if data has been submitted from the search form.
    } //!empty($webdata['action'])
  } //!empty($testfordata)
echo '<div class="report">tma02_coreadmin.php has completed all actions</div>';
require 'tma02_foot.php'; //footer to end html document
?>
