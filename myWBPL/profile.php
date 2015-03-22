<?php 
	include 'include/connect.php';
	//include 'captcha.php';
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
<title>Minion Fitness | Profile</title>
<link href="home.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="Container">
    	<?php
    		include 'include/menu.php';
    	?>
         <div id="bodi">
        	<table align="center" class="produk">
        		<?php
	        		$tam = $_SESSION['user'];
	        		
	        		$query = "select * from msuser where username= '".$tam."'";
					//echo $query;
					$result = mysql_query($query);
					$ambil = mysql_fetch_array($result);
	        	?>
        		<form method="post" action="profile.php">
        			<tr>
        				<td colspan="2" align="center">Update Your Data</td>
        			</tr>
        			<tr>
        				<td>First Name</td>
        				<td>
        					<input size="45px" type="text" name="fname" maxlength="30" value="<?php echo $ambil['first_name']; ?>"/> 
        				</td>
        			</tr>
        			<tr>
        				<td>Last Name</td>
        				<td>
        					<input size="45px" type="text" name="lname" maxlength="30" value="<?php echo $ambil['last_name']; ?>" />
								
        				</td>
        			</tr>
        			<tr>
        				<td>Gender</td>
        				<td>
        					
        					<input type="radio" name="gender" value="Male" id="male" <?php echo ($ambil['gender'] == 'Male') ? "checked" : "" ;?>/><label for="male">Male</label>
        					<input type="radio" name="gender" value="Female" id="female" <?php echo ($ambil['gender'] == 'Female') ? "checked" : "" ;?>/><label for="female">Female</label>
        				</td>
        			</tr>
        			<tr>
        				<td>Address</td>
        				<td>
        					<textarea name="address" cols="35" rows="5" maxlength="160" style="resize: none"><?php echo $ambil['address']; ?></textarea>
        				</td>
        			</tr>
        			<tr>
        				<td>Phone</td>
        				<td>
        					<input size="45px" type="text" name="phone" maxlength="30" value="<?php echo $ambil['phone']; ?>"/>
        				</td>
        			</tr>
        			<tr>
        				<td>Email</td>
        				<td>
        					<input size="45px" type="text" name="email" maxlength="30" value="<?php echo $ambil['email']; ?>"/>
        				</td>
        			</tr>
        			<tr>
        				<td>
        					<?php 
        						if (!empty($_POST['sent']) && $_POST['sent'] == 1) 
        						{
									$tampError = "";
									
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
									else if(empty($_POST['gender']))
									{
										$tampError = "Gender must be chosen";
									}
									else if (strpos($_POST['address'], ' Street ') == 0) 
									{
										$tampError = "Address must contain Street Word, etc : xxxxxxaaaa Street";
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
									else
									{
										$firstname = $_POST['fname'];
										$lastname = $_POST['lname'];
										$gender = $_POST['gender'];
										$address = $_POST['address'];
										$phone = $_POST['phone'];
										$email = $_POST['email'];
										$queryUpdate = "update msuser set  first_name='".$firstname."',last_name='".$lastname."',gender='".$gender."',address='".$address."',phone='".$phone."',email='".$email."' where username = '".$tam."'";
										//echo $queryUpdate;
										mysql_query($queryUpdate);
										header("Location:profile.php");
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
        		<form method="post" action="profile.php">
        			<tr>
        				<td colspan="2">Edit Your Password</td>
        			</tr>
        			<tr>
        				<td>Old Password</td>
        				<td><input maxlength="30" size="45px" type="password" name="oldpass" /></td>
        			</tr>
        			<tr>
        				<td>New password</td>
        				<td><input maxlength="30" size="45px" type="password" name="newpass1" /></td>
        			</tr>
        			<tr>
        				<td>Confirm Password</td>
        				<td><input maxlength="30" size="45px" type="password" name="newpass2" /></td>
        			</tr>
        			<tr>
        				<td>Captcha</td>
        				<td>
        					<?php
								 $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';				
								 $temp;
								 $tampCap = "";
								 
								 for ($i=1; $i <= 6 ; $i++) 
								 { 
									if ($i%2 == 1) $temp = floor(rand(0,10));
									else $temp = $characters[rand(0, strlen($characters) - 1)];
									$tampCap = $tampCap . $temp;
								 }
								 echo $tampCap;
							?>
        				</td>
        			</tr>
        			<tr>
        				<td>Recaptcha</td>
        				<td><input maxlength="30" size="45px" type="text" name="recaptcha" /></td>
        			</tr>
        			<tr>
        				<td>
        					<?php 
        					if (!empty($_POST['sent2']) && $_POST['sent2'] == 1) 
							{
								$tamp = $tampCap;
								$tampError2 = "";
								if ($_POST['oldpass'] != md5($ambil['password'])) 
								{
									$tampError2 = "Old password must be same with your current password";
								}
								else if (empty($_POST['oldpass'])) 
								{
									$tampError2 = "Old password must be filled";
								}
								else if (empty($_POST['newpass1'])) 
								{
									$tampError2 = "New password must be filled";
								}
								else if (strlen($_POST['newpass1']) < 5 || strlen($_POST['newpass1']) > 20) 
								{
									$tampError2 = "New password length must between 5 - 20 character";
								}
								else if (ctype_alnum($_POST['newpass1']) == 0) 
								{
									$tampError2 = "New password must contain alphabet and numeric";
								} 
								else if ($_POST['newpass1'] != $_POST['newpass2']) 
								{
									$tampError2 = "Confirm password must match with new password";
								}
								else if (empty($_POST['newpass2'])) 
								{
									$tampError2 = "Confirm password must be filled";
								}
								else if (empty($_POST['recaptcha'])) 
								{
									$tampError2 = "Recaptcha must be filled";
								}
								else if (strcmp($_POST['recaptcha'], $tampCap) < 0) 
								{
									//echo $_POST['recaptcha']."</br>";
									//echo $tamp;
									$tampError2 = "Recaptcha  did not match with captcha";
								}
								else
								{
									
									$password = $_POST['newpass2'];
									$queryUpdate = "update msuser set  password= md5('".$password."') where username = '".$tam."'";
									echo $queryUpdate;
									mysql_query($queryUpdate);
									header("Location:profile.php");
								}
							?>	
							
        				</td>
        			</tr>
        			<tr>
        				<td colspan="2">
        					<?php
        						if (strlen($tampError2) > 0) echo $tampError2;
							}
        					?>
        				</td>
        			</tr>
        			<tr>
        				<td colspan="2">
        					<input type="hidden" name="sent2" value="1"/>
        					<input type="submit" value="Submit"/>
        				</td>
        			</tr>
        			
        		</form>
        	</table>
            
            
            
            
        </div>
        
  </div>
</body>
</html>