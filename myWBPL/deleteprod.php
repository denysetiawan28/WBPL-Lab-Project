<?php 
	include 'include/connect.php';
	
	$idprod = $_GET['id'];
	$query = "delete from msproduct where productID = $idprod";
	//echo $query;
	mysql_query($query);
	header("Location:product.php");
?>

