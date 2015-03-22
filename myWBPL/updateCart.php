<?php
session_start();
include 'include/connect.php';
$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '' ;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';
include 'include/function.php';

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	$date = date("d-m-o");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Minion Fitness | Change Cart</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
		<?php include 'include/menu.php';?>
	<div id="bodi">
		<table border="0" width="800px" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td><h2> Update Cart </h2></td>
			</tr>
			<tr>
				<td>
					<?php
						$result=getProduct($_REQUEST['hdnProdId']);
						$prod=mysql_fetch_array($result);
						$qty=$_SESSION['cart'][$_REQUEST['hdnProdId']][0];
					?>
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="hdnProdId" id="hdnProdId" value="<?php echo $_REQUEST['hdnProdId']; ?>"/>
						<table>
							<tr>
								<td align="left">
									Product Type 
								</td>
								<td>:</td>
								<td>
									<label>&nbsp;<?php echo $prod[1]; ?></label>
								</td>
							</tr>
							<tr>
								<td align="left">
									Product Name 
								</td>
								<td>:</td>
								<td>
									<label>&nbsp;<?php echo $prod[2]; ?></label>
								</td>
							</tr>
							
							<tr>
								<td align="left">
									Product Price 
								</td>
								<td>:</td>
								<td>
									<label>&nbsp;<?php echo $prod[3]; ?></label>
								</td>
								<td colspan="3" align="center"> Quantity:</td>
								<td colspan="3" align="center"> <input type="text" name="qty"/></td>
								
							</tr>
							
							<tr>
								<td align="left">
									Product Stock 
								</td>
								<td>:</td>
								<td>
									<label>&nbsp;<?php echo $prod[4]; ?></label>
								</td><td></td>
								<td colspan="3" align="center"><?php
			        								if(!empty($_POST['submit']) && $_POST['submit'] == 1){
			        									$msg='';
														if(empty($_POST['qty'])){
															$msg="Quantity Must be filled";
														}else if(!is_numeric($_POST['qty'])){
															$msg="Quantity Must contain only numbers";
														}
														else if($_POST['qty']>$prod['productStock']){
															$msg="Quantity can not be bigger than stock";
														}else{
															$_SESSION['cart'][$_POST['hdnProdId']]= $_POST['qty'];
															header("location:cart.php");
														}
													if(strlen($msg)>0){
														echo "<br/><div class='errormsg'>" . $msg . "</div>";
													}
		        									}
		        								?></td>
							</tr>
							
							<tr>
								<td align="left">
									Product Description 
								</td>
								<td>:</td>
								<td>
									<label>&nbsp;<?php echo $prod[5]; ?></label>
								</td>
								<td colspan="4" align="center">
									<input type="hidden" name="submit" value="1"/>
									<input type="submit" value="Update" />
									</td>
							</tr>
							
							<tr>
								<td align="left">
									Product Image 
								</td>
								<td>:</td>
								<td>
									&nbsp;<img width="100" height="100" src="img/<?php echo $prod[6]; ?>" />
								</td>
							</tr>
							
							
						</table>
					</form>
				</td>
			</tr>
		</table>
	
	
	</div>
</body>
</html>