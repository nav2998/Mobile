<?php
	session_start();
	
	
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con, 'mobileapp');
	
	$name=$_POST['fname'];
	$last=$_POST['lname'];
	$username=$_POST['users'];
	$pass=$_POST['pwds'];
	
	$s=" select * from user where username=' $username'";
	$result = mysqli_query($con, $s);
	$num= mysqli_num_rows($result);
	if ($num ==1){
		echo "username already taken";
	}else{
		$reg =" insert into user(fname,lname,username,password) values ('$name', '$last', '$username', '$pass')";
		mysqli_query($con, $reg);
		echo "Registration Successful";
	}
?>