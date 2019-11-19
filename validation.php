<?php
	session_start();
	
	
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con, 'mobileapp');
	
	$username=$_POST['user'];
	$pass=$_POST['pwd'];
	
	$s=" select * from user where username=' $username' && password='$pass'";
	$result = mysqli_query($con, $s);
	$num= mysqli_num_rows($result);
	if ($num ==1){
		header("location:#homepage");
	}
?>