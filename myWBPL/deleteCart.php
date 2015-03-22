<?php 
	session_start();
	include 'include/function.php';
	include 'include/connect.php';
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '' ;
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';
	
	if(!empty($_REQUEST["hdnProdId"]))
   {
       unset($_SESSION["cart"][$_REQUEST["hdnProdId"]]); // hapus session untuk cart yang dihapus
   }
   header("Location: cart.php"); // redirect ke list cart
?>