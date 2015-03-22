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
<title>Cart | My Cart</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
		<?php include 'include/menu.php';?>
	<div id="bodi">
		<table border="0" width="500px" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<h2><strong>My Cart</strong></h2>
				</td>
			</tr>
			<tr>
				<td align="center">
					<table border="1" class="produk" cellpadding="5" cellspacing="0">
						<tr>
							<td>No</td>
							<td>Product Type</td>
							<td>Image</td>
							<td>Name</td>
							<td>Price</td>
							<td>Quantity</td>
							<td>Subtotal</td>
							<td>Status</td>
							<td>Action</td>
						</tr>
						<?php
							$total=0;
							if(!empty($_SESSION["cart"])) {
			                $num = 1;   
			                foreach ($_SESSION["cart"] as $record => $row) { // tampilkan isi shopping cart                           
			                $result = getProduct($record); // ambil detail product dari database
			                $product = mysql_fetch_array($result);        
			                $total = $total + intval($product[3]) * intval($row); // hitung grand total
			                echo $row;
			                echo "<tr><td>" . $num . "</td>";
			                echo "<td>" . $product[1] . "</td>";
							echo "<td>" 
			                
						?>
						    <img width="100" height="100" src="<?php echo 'img/' . $product[6]; ?>"/>
			          	<?php
			              	echo "</td>";
			              	echo "<td>" . $product[2] . "</td>";
			              	echo "<td>" . number_format($product[3]) . "</td>";
			              	echo "<td>" . number_format($row) . "</td>";
			              	echo "<td align='right'>" . number_format(intval($product[3]) * intval($row)) . "</td>";
			              	echo "<td>" . "Pending" . "</td>";
							echo "<td>";            
			          	?>          
			               	<form method="post" action="updateCart.php">
			                <input type="hidden" name="hdnProdId" value="<?php echo $record; ?>"/>
			                <input type="submit" value="Update"/>
			               	</form>
			               	<form method="post" action="deleteCart.php">
			                <input type="hidden" name="hdnProdId" value="<?php echo $record; ?>"/>
			                <input type="submit" value="Remove"/>
			               	</form>
			          	<?php                           
			              	echo "</tr>";
			              	$num = $num + 1;
			              	}
		            	}    else {
		            		?>
			            		<tr>
						            <td colspan="9" align="center">  
						              Your cart is empty
						            </td>
					         	</tr>
		            		<?php
		            	}        
		         	 ?>
		         	 <tr>
			            <td colspan="9" align="right">  
			              <?php echo "Total : " . number_format($total); ?>
			            </td>
			          </tr>
			          
			          <tr>
				          <td colspan="9" align="center">
				          <?php if ($role=="member") { ?>
				          	<form method="post" action="buyProduct.php">
			                <input type="submit" value="Check out"/>
			               	</form>
				          <?php } ?>
				          </td>
				      </tr>    
			          </table>
			          </td>
					</table>
					
				</td>
				
			</tr>
		</table>
	</div>
	</div>
        <br/>
		<br/>
		<div id="Footer">
			<p id="asd">Copyright</p>
		</div>
        
    </div>
</body>
</html>