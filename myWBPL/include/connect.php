<?php
	
	$db=mysql_connect("localhost","root","");
	if (!$db) {
      die('Could not connect: ' . mysql_error());
  	}
  $dbb = mysql_select_db('minion', $db);

	
?>