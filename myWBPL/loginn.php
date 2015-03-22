<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("minion");
	$user=$_POST['txtUserID'];
	$pass=$_POST['txtUserPass'];
	$password = md5($pass);
	
	$query=mysql_query("select * from msuser where username='$user' AND password='$pass'");
	$sukses=mysql_fetch_array($query);
	
	if(mysql_num_rows($query)>0){
		$_SESSION['user']=$user;
		$_SESSION['role']=$sukses['role'];
		if(isset($_POST['remember'])){
			setcookie('login',$user,time()+3600,'/');
		}
		header("location:index.php");
	}else{
		header("location:index.php?error=invalid");	
	}
	
	
?>