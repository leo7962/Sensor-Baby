<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "", "parcial") or die($link);
	$username = mysqli_real_escape_string($link, $_POST['username']);
	$password = mysqli_real_escape_string($link, $_POST['password']);
	
	$query = mysqli_query($link, "SELECT * from users WHERE username='$username'"); 
	$exists = mysqli_num_rows($query); 
	$table_users = "";
	$table_password = "";
	if($exists > 0) 
	{
		while($row = mysqli_fetch_assoc($query)) 
		{
			$table_users = $row['username']; 
			$table_password = $row['password']; 
		}
		if(($username == $table_users) && ($password == $table_password)) 
		{
			if($password == $table_password)
			{
				$_SESSION['user'] = $username; 
				header("location: Social_rider.php"); 
			}
		}
		else
		{
			Print '<script>alert("Contraseña incorrecta!");</script>'; 
			Print '<script>window.location.assign("login.php");</script>'; 
		}
	}
	else
	{
		Print '<script>alert("Usuario incorrecto!");</script>'; 
		Print '<script>window.location.assign("login.php");</script>'; 
	}
?>