<?php 
	session_start();
	include 'include/function.php';
	if (empty($_SESSION["user"]))  { 
header("Location: index.php");
exit();} 
	
	
	if(!empty($_SESSION["cart"]))
	{
	   	$transId = getNextTransId();
		if($transId<=0)$transId=1;
		insertTransactionHeader($transId,$_SESSION['user'],"pending");
		foreach ($_SESSION["cart"] as $record => $row) {   
            // insert data transaksi detail
            insertTransactionDetail($transId, $record, $row);
        }
        unset($_SESSION['cart']); // hapus session cart
    }
    header("Location:cart.php"); // redirect ke halaman list cart
	
	
?>