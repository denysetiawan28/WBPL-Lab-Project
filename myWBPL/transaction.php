<?php
	session_start();
$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '' ;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	$date = date("d-m-o");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Minion Fitness | Transaction</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
		<?php include 'include/menu.php';?>
	<div id="bodi">
		<table border="0" cellpadding="0" cellspacing="0" align"center">
			<tr>
				<td><h1>Transaction</h1></td>
			</tr>
			<tr>
				<td align="center">
					<table border="1">
						<tr>
							<td>Transaction ID</td>
							<td>Username</td>
							<td>Product Type</td>
							<td>Product Name</td>
							<td>Quantity</td>
							<td>Price</td>
							<td>Subtotal</td>
							<td>Transaction Date</td>
							<td>Status</td>
							<?php if($role=="admin"){ ?>
							<td>Action</td>
							<?php
								}
							?>
						</tr><?php if($role=="admin"){
							$query=mysql_query("select * from headertransaction");
							while($row=mysql_fetch_array($query)){
						}?>
						<form method="post" >
						  	<input type="hidden" name="prodID" value="<?php echo $row["productID"]; ?>" />
						<tr>
							<td>
								<?php echo $row["transactionID"];?>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
		</table>
		
	</div>
		<br/>
		<br/>
		<div id="Footer">
			<p id="asd">Copyright</p>
		</div>
        
    </div>
</body>
</html>