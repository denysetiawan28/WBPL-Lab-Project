<?php 
	include 'include/connect.php';
	
	$id = $_GET['id'];
	$query = "delete from mstestimoni where testimoniID = $id";
	//echo $query;
	mysql_query($query);
	header("Location:testimoni.php");
?>

