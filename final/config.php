<?php
/** Connection setup 
* $db_database  = jsonform
* $db_host = localhost
* $db_user = root
* $db_pass = No Password 
*/


	$db_database  = 'jsonform';
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';

// Connecting to database server using details
$link = mysql_connect($db_host, $db_user, $db_pass);
if (!$link)
{
    die('Not connected : ' . mysql_error());
}

// Select Database 
$db_selected = mysql_select_db($db_database, $link);
if (!$db_selected) 
{
    die ('Can\'t use '.$db_database.' : ' . mysql_error());
}
?>