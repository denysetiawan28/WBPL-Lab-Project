<?php 
	include 'connect.php';
	session_start();
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '' ;
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	$date = date("d-m-o");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Minion Fitness | Update Product</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
    	<div id="Header">
        	<div class="Menu">
        		<table width="100%">
        			<tr><td><a href="index.php">Home</a></td>
        				<td><a href="product.php"> Product</a></td>
        				<?php if ($role=="") {						
						?>
						<td><a href="register.php">Register</a></td>
						<?php }?>
        				<td><a href="testimoni.php">Testimony</a></td>
        				<?php
        				if($role=="member"){
        					?>
        					<td><a href="cart.php">Cart</a></td>
        				<?php
						}
        				?>
        				<?php 
        				if($role=="admin"){
        					?>
        					<td><a href="managemember.php">Manage Member</a></td>
        				<?php
						}
        				?>
        				<?php if($role=="member"||$role=="admin"){?>
        				<td><a href="profile.php">Profile</a></td>
        				<td><a href="transaction.php">Transaction</a></td>
        				<td><a href="logout.php">Logout</a></td>
        				<?php } ?>
        			</tr>
        		</table>
            </div>
            
        </div>
         <div id="bodi">
        	<table>
        		<?php
	        		$tam = $_REQUEST['id'];
	        		$query = "select * from msproduct where productID= '".$tam."'";
					//echo $query;
					$result = mysql_query($query);
					$ambil = mysql_fetch_array($result);
	        	?>
        		<form method="post" enctype="multipart/form-data">
        			<tr>
        				<td>Product Name</td>
        				<td>
        					<input type="hidden" name="id_product" value="<?php echo $_POST['id']; ?>" />
        					<input size="45px" type="text" name="txtprodName" maxlength="30" value="<?php if (isset($_POST['txtprodName'])) { echo htmlspecialchars($_POST['txtprodName']); } else echo $ambil['productName'];?>"/> 
        				</td>
        			</tr>
        			<tr>
        				<td>Product Price</td>
        				<td>
        					<input size="45px" type="text" name="txtprodPrice" maxlength="30" value="<?php if (isset($_POST['txtprodPrice'])) echo htmlspecialchars($_POST['txtprodPrice']); else echo $ambil['productPrice']; ?>" />
								
        				</td>
        			</tr>
        			<tr>
        				<td>Product Stock</td>
        				<td>
        					<input size="45px" type="text" name="txtprodStock" maxlength="30" value="<?php if (isset($_POST['txtprodStock'])) echo htmlspecialchars($_POST['txtprodStock']); else echo $ambil['productStock'];?>"/>
        					
        				</td>
        			</tr>
        			<tr>
        				<td>Product Description</td>
        				<td>
        					<textarea name="txtprodDesc" rows="6" cols="35" maxlength="160" style="resize:none"><?php echo $ambil['productDesc']; ?></textarea>
        				</td>
        			</tr>
        			<tr>
        				<td>
        					<?php 
        						if (!empty($_POST['sent']) && $_POST['sent'] == 1) 
        						{
									$Tamperror = "";
									
									if (empty($_POST['txtprodName'])) 
									{
										$Tamperror = "Product name cannot empty";		
									}
									else if (strlen($_POST['txtprodName']) < 3 || strlen($_POST['txtprodName']) > 50 ) 
									{
										$Tamperror = "Product name length must be 3 to 50 character";
									}
									else if (ctype_digit($_POST['txtprodPrice'] ) == 0) 
									{
										$Tamperror = "Product price must be in digit";
									}
									else if (intval($_POST['txtprodPrice']) < 0 || intval($_POST['txtprodPrice']) >= 2147483647)
									{
										$Tamperror = "Product price must be larger than zero or more than 2147483647";
									}
									else if(empty($_POST['txtprodPrice']))
									{
										$Tamperror = "Product price cannot empty";
									}
									else if (ctype_digit($_POST['txtprodStock']) == 0) 
									{
										$Tamperror = "Product stock must be in digit";
									}
									else if (intval($_POST['txtprodStock']) < 0 || intval($_POST['txtprodStock']) >= 2147483647)
									{
										$Tamperror = "Product stock must be larger than zero or more than 2147483647";
									}
									else if(empty($_POST['txtprodDesc']))
									{
										$Tamperror = "Product description must be filled";	
									}
									else if(strlen($_POST['txtprodDesc']) < 5 || strlen($_POST['txtprodDesc']) > 160)
									{
										$Tamperror = "Product description must between 5 - 160 characters";
									}
									else
									{
										$name = $_POST['txtprodName'];
										$price = $_POST['txtprodPrice'];
										$stok = $_POST['txtprodStock'];
										$desc = $_POST['txtprodDesc'];
										$queryUpdate = "update msproduct set  productName='".$name."',productPrice='".$price."',productStock='".$stok."',productDesc='".$desc."' where productID = '".$tam."'";
										//echo $queryUpdate;
										mysql_query($queryUpdate);
										header("Location:product.php");
									}
									
							?>
							
        				</td>
        			</tr>
        			<tr>
        				<td colspan="2">
        					<?php
        							if (strlen($Tamperror) > 0) echo $Tamperror;
								}
        					?>
        				</td>	
        			</tr>
        			<tr>
        				<td>
        					<input type="hidden" name="sent" value="1"/>
        					<input type="submit" value="Submit"/>
        				</td>
        			</tr>
        			
        		</form>
        	</table>
            
            
            
            
        </div>
        
  </div>
</body>
</html>