<?PHP
if(!defined('ISITSAFETORUN')) {
// This provides protection against file being called directly - if it is, ISITSAFETORUN will not be defined
   die('This file does no useful work alone'); // and so this warning message will be issued
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" >
        <title> <?php echo $mytitle ?> </title>
        <script src ="<?php echo $myjs ?>" ></script>
        <link rel="stylesheet" href="<?php echo $mycss ?>">
    </head>
    <body>
