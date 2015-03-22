<?php 
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
<title>Minion Fitness | Home Page</title>
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
        	<div id="SlideShow">
            
            Welcome, <?php echo $user. " ".$date;
			
			?><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.


            </div>
            <?php 
            
            if ($role=="") {
            	
				
            ?>
            
            <div id="Register">
            	<h3>Login</h3>
            	<form method="post" action="loginn.php">
	            		<label>Username</label>
	            		<input type="text" name="txtUserID"
							 value="<?php echo isset($_COOKIE['login']) ? $_COOKIE['login'] : ""; ?>" id="txtUserID" /> 
	            	
	            		<br/>
	            		<label>Password</label>
	            		<input type="password" name="txtUserPass" id="txtUserPass" /> 
	            	
	            		<br/>
	            		<input type="checkbox" name="remember" value="remember" id="check" />Remember Me?
	            	<br/>
	            		<input type="submit" value="Login" id="Login" name="submit" />
	            	
            	</form>
                <?php
				if(isset($_GET['error']))
				{
					echo $_GET['error'];
				}
				?>
            </div>
            <?php }else {
            	
            }
            
            ?>
        </div>
        
        <div id="Footer">
        	<p id="asd">Copyright</p>
        </div>
        
    </div>
</body>
</html>