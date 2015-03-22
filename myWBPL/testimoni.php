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
<title>Minion Fitness | Testimony</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
    	<?php
    		include 'include/menu.php';
    	?>
        
        <div id="bodi">
        	<table>
        		<form action="testimoni.php" method="post">
        		<tr>
        			<td>
        			<select name="tipe">
        				<option value="username">Username</option>
        				<option value="message">Message</option>
        			</select>
        			</td>
        			<td><input type="text" name="txtSearch" /></td>
        			<td><input type="submit" value="Search" name="search" /></td>
        		</tr>	
        		</form>
        	</table>
        	
        	
        	<table width="550px" align="center"  class="produk">
							<?php if ($role=='admin' || $role =='member') 
							{
							?>
			        			<tr>
			        				<td><a href="inserttesti.php">Insert comment</a></td>
			        			</tr>
			        		<?php
							}
			        		?>
			        		
							<?php
        			$search = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';
        			$tipe = isset($_POST['tipe']) ? $_POST['tipe'] : 'Message';
					$no = 2;
					$hal = 1; 
					if (isset($_GET['page']))
					{
						$hal = $_GET['page'];
					}
					if($hal < 1) $hal = 1;
					
					$off = ($hal-1) * $no;
					$query="";
					//$stock = ($role=='') ? 'and productStock > 0' : '' ;
					
					$query = "select * from mstestimoni where ".$tipe." like '%".$search."%' order by date desc limit ".$off.",".$no;
					
					$hasil = mysql_query($query);
					
					if (mysql_num_rows($hasil) == 0) {
						echo "Tidak ada hasil";
					}
					
					while($row = mysql_fetch_array($hasil))
					{
						?>
							<tr>
			        			<td> 
			        				<table >
			        					<?php?>
			        					<tr>
			        						<td>Date :</td>
			        						<td><?php echo $row['date']; ?></td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Username : </td>
			        						<td><?php echo $row['username'];?></td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Testimoni :</td>
			        						<td><?php echo $row['message'];?></td>
			        					</tr>
			        					
			        					<?php if ($role=='admin') {
											
										?>
			        					<tr>
			        						<td>
			        							<a href="deltesti.php?id=<?php echo $row['testimoniID']; ?>">Delete</a>
			        						</td>
			        					</tr>
			        					<?php
										}
			        					?>
		        				</table>
		        			</td>
		        		</tr>
		        		<tr><td colspan="2">
		        		<?php
					}
					
				
						$query = "select count(*) as a from mstestimoni where ".$tipe." like '%".$search."%' order by date desc";
					
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
        
        <div id="Footer">
        	Copyright
        </div>
        
    </div>
</body>
</html>
        		
