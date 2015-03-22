<?php 
	include 'include/connect.php';
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
<title>Minion Fitness | Add New Product</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
    	<?php
    		include 'include/menu.php';
    	?>
            
        </div>
         <div id="bodi">
        	<table class="produk" align="center">
        		<form action="insertprod.php" enctype="multipart/form-data" method="post" >
        			<tr>
        				<td colspan="2" align="center">
        					Insert Product
        				</td>
        			</tr>
        			
        			<tr>
        				<td>Product Type</td>
        				<td>
        					<select name="tipe">
	        					<option value="Besi">Besi</option>
	        					<option value="Plastik">Plastik</option>
        					</select>
        				</td>
        			</tr>
        			<tr>
        				<td>Product Name</td>
        				<td>
        					<input size="45px" type="text" name="txtprodName" maxlength="30" value="<?php if(isset($_POST['txtprodName'])) echo htmlspecialchars($_POST['txtprodName']);?>"/> 
        				</td>
        			</tr>
        			<tr>
        				<td>Product Price</td>
        				<td>
        					<input size="45px" type="text" name="txtprodPrice" maxlength="30" value="<?php if (isset($_POST['txtprodPrice'])) echo htmlspecialchars($_POST['txtprodPrice']);?>" />
								
        				</td>
        			</tr>
        			<tr>
        				<td>Product Stock</td>
        				<td>
        					<input size="45px" type="text" name="txtprodStock" maxlength="30" value="<?php if (isset($_POST['txtprodStock'])) echo htmlspecialchars($_POST['txtprodStock']);?>"/>
        					
        				</td>
        			</tr>
        			<tr>
        				<td>Product Description</td>
        				<td>
        					<textarea name="txtprodDesc" rows="6" cols="35" maxlength="160" style="resize:none"></textarea>
        				</td>
        			</tr>
        			<tr>
        				<td>Product Image</td>
        				<td>
        					<input type="file" name="prodImage" maxlength="50"/>
        				</td>
        			</tr>
        			<tr>
        				<td>
        					<?php 
        						if (!empty($_POST['sent']) && $_POST['sent'] == 1) 
        						{
									$Tamperror = "";
									$ext = "";
									
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
									else if (empty($_FILES['prodImage']['name'])) 
									{
										$Tamperror = "Product image must be choose";
									}
									else if (!empty($_FILES['prodImage']['name']))
									{
										$ext = pathinfo($_FILES['prodImage']['name'], PATHINFO_EXTENSION);
										$fileExt = array("jpg","jpeg","png","gif");
										
										if ($_FILES['prodImage']['type'] != 'image/jpg' && $_FILES['prodImage']['type'] != 'image/jpeg' 
										 && $_FILES['prodImage']['type'] != 'image/png' && $_FILES['prodImage']['type'] != 'image/gif'
										 || $_FILES['prodImage']['size'] !=	 2500000  && !in_array($ext, $fileExt)) 
										{
											$Tamperror = "File extension must be in 'jpg / jpeg / png / gif'";
										}
										else 
										{
											$tipe = $_POST['tipe'];
											$name = $_POST['txtprodName'];
											$price = $_POST['txtprodPrice'];
											$sto = $_POST['txtprodStock'];
											$desc = $_POST['txtprodDesc'];
											$query = "insert into msproduct(productID,productType, productName,productPrice,productStock,productDesc,productImage) 
											values ('','".$tipe."','".$name."','".$price."','".$sto."','".$desc."','".$name.".".$ext."')";
											//echo $query;
											mysql_query($query);
											move_uploaded_file($_FILES["prodImage"]["tmp_name"], dirname(__FILE__) . '/'. "img/" . $_POST['txtprodName'] . '.' . $ext);
											header("Location:product.php");
										}
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