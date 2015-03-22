<?php 
	session_start();
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '' ;
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';
	include 'include/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	$date = date("d-m-o");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Minion Fitness | Product</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
    	<?php
    		include 'include/menu.php';
    	?>
        
        <div id="bodi">
        	<table align="center">
        		<form action="product.php" method="post">
        		<tr>
        			<td>
        			<select name="tipe">
        				<option value="productType">Product Type</option>
        				<option value="productName">Product Name</option>
        			</select>
        			</td>
        			<td><input type="text" name="txtSearch" /></td>
        			<td><input type="submit" value="Search" name="search" /></td>
        		</tr>	
        		</form>
        	</table>
        		
						<table width="550px" align="center"  class="produk">
							<?php if ($role=='admin') {
											
										?>
			        					<tr>
			        						<td>
			        							<a href="insertprod.php">Insert</a> 
			        							
			        						</td>
			        						
			        					</tr>
			        					<?php
										}
			        					?>
							<?php
        			$search = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';
        			$tipe = isset($_POST['tipe']) ? $_POST['tipe'] : 'productName';
					$no = 2;
					$hal = 1; 
					
					if (isset($_GET['page']))
					{
						$hal = $_GET['page'];
					}
					if($hal < 1) $hal = 1;
					
					$off = ($hal-1) * $no;
					$query="";
					$stock = ($role=='') ? 'and productStock > 0' : '' ;
					
						$query = "select * from msproduct where ".$tipe." like '%".$search."%'  ".$stock." limit ".$off.",".$no;
					
					
					$hasil = mysql_query($query);
					
					if (mysql_num_rows($hasil) == 0) {
						echo "Tidak ada hasil";
					}
					while($row = mysql_fetch_array($hasil))
					{
						?>
						<form method="post">
						<input type="hidden" name="prodID" value="<?php echo $row['productID']; ?>"/>
			        		<tr>
			        			<td><img src="img/<?php echo $row['productImage'];?>" width="150" height="150"/></td>
			        			<td> 
			        				<table >
			        					<?php?>
			        					<tr>
			        						<td>Product Type :</td>
			        						<td>
			        							<?php 
			        								echo $row['productType'];
			        							?>
			        						</td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Product Name :</td>
			        						<td>
												<?php 
			        								echo $row['productName'];
			        							?>
											</td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Price :</td>
			        						<td>
			        							<?php 
			        								echo $row['productPrice'];
			        							?>
			        						</td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Stock :</td>
			        						<td>
			        							<?php 
			        								echo $row['productStock'];
			        							?>
			        						</td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Description : </td>
			        						<td>
												<?php 
			        								echo $row['productDesc'];
			        							?>
											</td>
			        					</tr>
			        					<?php if ($role=='admin') {
											
										?>
			        					<tr>
			        						<td>
			        							
			        							<a href="updateprod.php?id=<?php echo $row['productID']; ?>">Update</a> 
			        							<a href="deleteprod.php?id=<?php echo $row['productID']; ?>">Delete</a> 
			        						</td>
			        						
			        					</tr>
			        					<?php
										}
			        					?>
			        					<?php if ($role=='member' && $row['productStock'] > 0) {
											
										?>
			        					<tr>
			        						<td>
			        							Qty : <input type="text" name="qty" id="qty" />
			        						</td>
			        						
			        						<td>
			        							<?php
			        								if(!empty($_POST['submit']) && $_POST['submit'] == 1){
			      							$msg='';
														if(empty($_POST['qty'])){
															$msg="Quantity Must be filled";
														}else if(!is_numeric($_POST['qty'])){
															$msg="Quantity Must contain only numbers";
														}
														else if($_POST['qty']>$row['productStock']){
															$msg="Quantity can not be bigger than stock";
														}else{
															$_SESSION['cart'][$_POST['prodID']]=$_POST['qty'];
															
														}
													if(strlen($msg)>0){
														echo "<br/><div class='errormsg'>" . $msg . "</div>";
													}
		        									}
		        								?>
			        						</td>
			        					</tr>
			        					<tr>
			        						<td>
			        							<input type="hidden" name="submit" value="1">
			        							<input type="submit" value="add to cart" name="addtocart"/>
			        						</td>
			        					</tr>
			        					</form>
		        					<?php
										}
			        					?>
		        				</table>
		        			</td>
		        		</tr>
		        		<tr><td colspan="2">
		        		<?php
					}
					
				
						$query = "select count(*) as a from msproduct where ".$tipe." like '%".$search."%' ".$stock."";
					
					$result = mysql_query($query);
					
					$rowd = mysql_fetch_array($result);
					$b = $rowd['a'];
					
					$max = ceil($b / $no);
					$cetak = "";
					
					
					$balik = $_SERVER['PHP_SELF'];
					for($page = 1 ; $page <= $max ; $page++)
					{
						if ($page == $hal) 
						{
							$cetak .= " $page ";
						}
						else 
						{
							$cetak .= " <a href=\"$balik?page=$page\">$page</a> ";
						}
						
					}
					echo $cetak;
        		?>
        		</td></tr>
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