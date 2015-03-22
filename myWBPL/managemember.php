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
<title>Minion Fitness | Manage Member</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
    	<?php
    		include 'include/menu.php';
    	?>
        
        <div id="bodi">
        		<table width="550px" align="center"  class="produk">
					<?php
					$no = 2;
					$hal = 1; 
					
					if (isset($_GET['page']))
					{
						$hal = $_GET['page'];
					}
					if($hal < 1) $hal = 1;
					
					$off = ($hal-1) * $no;
					$query="";
					
						$query = "select * from msuser order by username asc limit ".$off.",".$no;
					
					
					$hasil = mysql_query($query);
					
					
					while($row = mysql_fetch_array($hasil))
					{
						?>
							<tr>
			        			<td><img src="imgUser/<?php echo $row['image'];?>" width="150" height="150"/></td>
			        			<td> 
			        				<table >
			        					<?php?>
			        					<tr>
			        						<td>Full Name : </td>
			        						<td><?php echo $row['first_name'].' '.$row['last_name'];?> </td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Username : </td>
			        						<td><?php echo $row['username'];?> </td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Gender : </td>
			        						<td><?php echo $row['gender'];?></td>
			        					</tr>
			        					
			        					<tr>
			        						<td>Phone : </td>
			        						<td><?php echo $row['phone'];?>
			        						</td>
			        					</tr>
			        					<tr>
			        						<td>Email : </td>
			        						<td><?php echo $row['email'];?>
			        						</td>
			        					</tr>
			        					
			        					<?php if ($role=='admin') 
			        					{
										?>
			        					<tr>
			        						<td>
			        							<a href="deleteuser.php?id=<?php echo $row['username']; ?>">Delete</a> 
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
					
				
						$query = "select count(*) as a from msuser";
					
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
        	<p id="asd">Copyright</p>
        </div>
        
    </div>
</body>
</html>