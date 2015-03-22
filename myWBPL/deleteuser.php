<?php
	include 'include/connect.php';
	session_start();
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '' ;
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';
	
	$username = $_GET['id'];
	$query = "delete from msuser where username = '".$username."'";
	//echo $query;
	
	$select = "select * from msuser where role = 'admin'";
	$quer = mysql_query($select);
	$result = mysql_fetch_array($quer);
	//echo $quer;
	if ($role == 'admin') {
		if ($username != $result['username']) 
		{
			mysql_query($query);
			header("Location:managemember.php");
		}
		else 
		{
			header("Location:managemember.php?error=Error 500&Message=You cannot Delete Your self");
		}
	}
	
	
	
?>