<?php error_reporting(E_ALL); ini_set('display_errors', 1); // DO NOT MODIFY THIS LINE ?> 
<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<div class="report">Start of tma02_validatedata.php</div>
<p class="report">This script will validate data on the server.</p>
<?php
$formerror['firstname'] = '';
$formerror['lastname'] = '';
$formerror['email'] = '';
$formerror['bookingreference'] = '';
$valid = TRUE ; // set a variable to true at the start. If we find and error change it to false. At the end if there are any error messages, return the form and data and messages, but don't save.
//$firstname = $webdata['firstname'];
if (isset($webdata['firstname'] )) {
if (!preg_match("/^[a-zA-Z ]{1,30}$/",$webdata['firstname'])) {
  $formerror['firstname'] = '<span class="warn" >Not valid on server: Only letters and white space allowed </span>'; 
  //echo "Only letters and white space allowed";
  $valid = FALSE ;
}}
if (isset($webdata['lastname'] )) {
if (!preg_match("/^[a-zA-Z ]{1,30}$/",$webdata['lastname'])) {
  $formerror['lastname'] = '<span class="warn" >Not valid on server: Only letters and white space allowed</span>'; 
  $valid = FALSE;
}}

if (isset($webdata['email'] )) {
if (!filter_var($webdata['email'], FILTER_VALIDATE_EMAIL)) {
	$formerror['email'] = '<span class="warn" >Not valid on server: invalid email format</span>';
  //echo "Invalid email format"; 
  $valid = FALSE;
}}

if (isset($webdata['bookingreference'] )) {
if (!(preg_match("/^[ACT]{3}-[1-2]{1}[0-9]{3}$/",$webdata['bookingreference']) || preg_match("/^[ABQ]{3}-[1-2]{1}[0-9]{3}$/",$webdata['bookingreference']) || preg_match("/^[ADE]{3}-[1-2]{1}[0-9]{3}$/",$webdata['bookingreference']))) {
  $formerror['bookingreference'] = '<span class="warn" >Not valid on server: Only valid format allowed </span>'; 
  $valid = FALSE;
}}
?>
<div class="report">End of tma02_validatedata.php   $valid holds the value:<?php echo $valid ?> </div>
