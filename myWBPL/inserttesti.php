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
<title>Minion Fitness | Add New Testimony</title>
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
        		<form action="inserttesti.php" method="post" >
        			<tr>
        				<td colspan="2" align="center">Testimony</td>
        			</tr>
        			<tr>
        				<td colspan="2"><textarea name="txtTesti" maxlength="160" cols="35" rows="5" style="resize: none"></textarea>
        			</tr>
        			<tr>
        				<td>
        					<?php
        					if (!empty($_POST['sent']) && isset($_POST['sent'])) 
        					{
        						$tampError = "";
        						if (empty($_POST['txtTesti'])) 
        						{
									$tampError = "Testimony cannot empty";
								}
								else if (strlen($_POST['txtTesti']) < 5 || strlen($_POST['txtTesti']) > 160) 
								{
									$tampError = "Testimony must contain between 5 - 160 characters";
								}
								else 
								{
									$message = $_POST['txtTesti'];
									$user = $_SESSION['user'];
									//echo $user;
									$query = "insert into mstestimoni (username,message) values ('".$user."','".$message."')";
									//echo $query;
									mysql_query($query);
								}
								
        					?>
        				</td>
        			</tr>
        			<tr>
        				<td colspan="2">
        					<?php
								if (strlen($tampError) > 0) echo $tampError;
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