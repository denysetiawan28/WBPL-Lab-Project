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
<title>Minion Fitness | Register</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
    	<?php
    		include 'include/menu.php';
    	?>
        
        <div id="bodi">
        	<div id="bodiReg">
	        	<form method="post" enctype="multipart/form-data">
	        		<table class="produk" align="center">
	        			<tr>
	        				<td colspan="2">Registration</td>
	        			</tr>
	        			
	        			<tr>
	        				<td>First Name</td>
	        				<td><input size="45px" maxlength="20" type="text" name="fname" value="<?php if(isset($_POST['fname'])) {echo htmlspecialchars($_POST['fname']); } ?>"/>
	        					</td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Last Name</td>
	        				<td><input size="45px" maxlength="20" type="text" name="lname" value="<?php if(isset($_POST['lname'])) {echo htmlspecialchars($_POST['lname']); } ?>"/>
	        				</td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Username</td>
	        				<td><input size="45px" maxlength="20" type="text" name="txtuname" value="<?php if(isset($_POST['txtuname'])) {echo htmlspecialchars($_POST['txtuname']); } ?>"/>
	        				</td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Password</td>
	        				<td><input size="45px" maxlength="20" type="password" name="password1" /></td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Reenter Password</td>
	        				<td><input size="45px" maxlength="20" type="password" name="password2" /></td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Gender</td>
	        				<td>
	        					<input type="radio" id="male" name="gender" value="Male" /> <label for="male">Male</label> 
		        				<input type="radio" id="female" name="gender" value="Female" /> <label for="female">Female</label> 
		        			</td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Address</td>
	        				<td><textarea cols="35" rows="5" name="address"><?php if(isset($_POST['address'])){echo htmlspecialchars($_POST['address']);}?></textarea>
	        					
	        			</tr>
	        			
	        			<tr>
	        				<td>Phone</td>
	        				<td><input size="45px"  maxlength="20" type="text" name="phone" value="<?php if(isset($_POST['phone'])) {echo htmlspecialchars($_POST['phone']); } ?>"/>
	        				</td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Email</td>
	        				<td><input size="45px"  type="text" name="email" value="<?php if(isset($_POST['email'])) {echo htmlspecialchars($_POST['email']); } ?>"/>
	        				</td>
	        			</tr>
	        			
	        			<tr>
	        				<td>Image</td>
	        				<td><input type="file" name="userImage" /></td>
	        			</tr>
	        			
	        			<tr>
	        				<td colspan="2"><input type="checkbox" name="check" value="check" id="cek"/><label for="cek">Are you agree?</label></td>
	        			</tr>
	        			
	        			<tr>
	        				<td colspan="2">
	        				<?php
	        				if (!empty($_POST['sent']) && $_POST['sent'] ==1) 
	        				{
								$userExist = $_POST['txtuname'];
								$query = "select username from msuser where username='".$userExist."'";
								$result = mysql_query($query);
								
	        					$tampError = "";
								$ext = "";
	        					if (empty($_POST['fname'])) 
	        					{
									$tampError = "First name must be filled";
								}
								else if (strlen($_POST['fname']) < 3 || strlen($_POST['fname']) > 20) 
								{
									$tampError = "First name lenght must between 3 or 20 character";
								}	
								else if (ctype_alpha($_POST['fname']) == 0) 
								{
									$tampError = "First name only contain alphabet";
								}
								elseif (empty($_POST['lname'])) 
	        					{
									$tampError = "Last name must be filled";
								}
								else if (strlen($_POST['lname']) < 3 || strlen($_POST['lname']) > 20) 
								{
									$tampError = "Last name lenght must between 3 or 20 character";
								}	
								else if (ctype_alpha($_POST['lname']) == 0) 
								{
									$tampError = "Last name only contain alphabet";
								}
								else if (empty($_POST['txtuname'])) 
	        					{
									$tampError = "User name must be filled";
								}
								else if (strlen($_POST['txtuname']) < 3 || strlen($_POST['txtuname']) > 20) 
								{
									$tampError = "User name lenght must between 5 or 20 character";
								}
								else if (mysql_num_rows($result) > 0) 
								{
									$tampError = "Your username has been taken";
								}	
								
								else if (empty($_POST['password1'])) 
								{
									$tampError = "Password must be filled";
								}
								else if (ctype_alnum($_POST['password1']) == 0)
								{
									$tampError = "Password must contain alphabet and numbers";
								}
								else if(strlen($_POST['password1']) < 5 ||strlen($_POST['password1']) > 20)
								{
									$tampError = "Password length must between 5 - 20 character";
								}
								else if (empty($_POST['password2'])) 
								{
									$tampError = "Reenter Password must be filled";
								}
								else if (ctype_alnum($_POST['password2']) == 0)
								{
									$tampError = "Reenter Password must contain alphabet and numbers";
								}
								elseif ($_POST['password1'] != $_POST['password2']) 
								{
									$tampError = "Reenter Password must be same";
								}
								else if(empty($_POST['gender']))
								{
									$tampError = "Gender must be chosen";
								}
								else if (strpos($_POST['address'], ' Street ') <= 0) 
								{
									$tampError = "Address must contain Street Word, etc : xxxxxaaaa Street";
								}
								else if (strlen($_POST['address']) < 6 || strlen($_POST['address']) > 50) 
								{
									$tampError = "Address length must between 6 - 50 character";
								}
								else if (empty($_POST['address']))
								{
									$tampError = "Address must be filled";
								}
								else if (empty($_POST['phone']))
								{
									$tampError = "Phone cannot empty";
								}
								else if (ctype_digit($_POST['phone']) == 0) 
								{
									$tampError = "Phone must contain only number";
								}
								else if (empty($_POST['email']))
								{
									$tampError = "Phone cannot empty";
								}
								else if (strpos($_POST['email'], '@') == 0)
								{
									$tampError = "Must be a valid email format like 'minion@yahoo.com'";
								}
								else if (strpos($_POST['email'], '.') == 0)
								{
									$tampError = "Must be a valid email format like 'minion@yahoo.com'";
								}
								else if (substr_count($_POST['email'], '@') > 1)
								{
									$tampError = "Must be a valid email format like 'minion@yahoo.com'";
								}
								else if(empty($_FILES['userImage']['name']))
								{
									$tampError = "You havent select your image'";
								}
								else if(empty($_POST['check']))
								{
									$tampError = "You haven reach agreement with us";
								}
								else if (!empty($_FILES['userImage'])) 
								{
										$ext = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
										$fileExt = array("jpg","jpeg","png","gif");
										
										if ($_FILES['userImage']['type'] != 'image/jpg' && $_FILES['userImage']['type'] != 'image/jpeg' 
										 && $_FILES['userImage']['type'] != 'image/png' && $_FILES['userImage']['type'] != 'image/gif'
										 || $_FILES['userImage']['size'] !=	 2500000  && !in_array($ext, $fileExt)) 
										{
											$Tamperror = "File extension must be in 'jpg / jpeg / png / gif'";
										}
										else 
										{
											$firstname = $_POST['fname'];
											$lastname = $_POST['lname'];
											$username = $_POST['txtuname'];
											$password = $_POST['password2'];
											$gender = $_POST['gender'];
											$address = $_POST['address'];
											$phone = $_POST['phone'];
											$email = $_POST['email'];
											$role = 'member';
											
											$query = "insert into msuser values ('".$firstname."','".$lastname."','".$username."',md5('".$password."'),'".$gender."','".$address."','".$phone."','".$email."','".$username.".".$ext."','".$role."')";
											echo $query;
											mysql_query($query);
											move_uploaded_file($_FILES["userImage"]["tmp_name"], dirname(__FILE__) . '/'. "imgUser/" . $_POST['txtuname'] . '.' . $ext);
											header("location:index.php");
										}
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
	        			
	        			<tr>
	        				<td colspan="2">
	        				<input type="hidden" name="sent" value="1"/>
	        				<input type="submit" name="submit" value="submit" /></td>
	        			</tr>
	        		</table>
        		</form>
        	</div>
        </div>
        
        <div id="Footer">
        	Copyright
        </div>
        
    </div>
</body>
</html>