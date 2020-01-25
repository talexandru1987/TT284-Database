<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<div class="report">In script tma02_formdata.php Collecting data from $_POST.</div>
<p><label for="sectiona" class="showhide">Show Hide: Data sent to form</label></p>
<input type="checkbox" id="sectiona" value="button" style="display:none;" />
<section id="asection">
<?php
echo "<h3>Checking POST data</h3>";
if (!empty($_POST))
{
    foreach ($_POST as $key => $value)
    {
		if ( is_array( $value )){ //multiple checkboxes are sent as an array
			echo "<hr /><p>Checking checkbox data</p>";
			foreach ($value as $cbkey => $cbvalue) //extract checkbox values
			{
				echo "<p>Key = {$key} Array= {$cbkey}  Value= {$cbvalue} </p>";
				$webdata[$key.$cbkey] = $cbvalue; //create a separate key for each checkbox item to store in our own array
			}
		} else{
        echo "<p>Key = {$key}  Value= {$value} </p>";
        $webdata[$key] = $value;
		}
    }
} else{
	echo "<p>No POST data</p>";
	$webdata['none'] = 'none';
}
?>
</section>
<div class="report">In script tma02_formdata.php Any data has been collected from $_POST. The data has been copied to our $webdata[] array</div>
