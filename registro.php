<html>
	<head>
		<title>
			Registro de usuarios
		</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
      @import url('https://fonts.googleapis.com/css?family=Montserrat');
    </style>
	</head>
	<body>
		<a href="index.php" class="inputback">
			Volver...
		</a>
		<h1>
			Registro de usuarios
		</h1>
		<br>
		<form action="registro.php" method="POST">
           Ingrese usuario: <input type="text" name="username" required="required" /> <br/>
           Ingrese contraseña: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Registrar"/>
           <a href="login.php">
            Ir a inicio de sesión
          </a>
    </form>
    <img class="img-back" src="https://www.kupilskazal.ru/upload/profile/b77543752fc51766de4707d5578ced0c.jpg">
	</body>
</html>

<?php
$link = mysqli_connect("localhost", "root", "", "parcial") or die($link);

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = mysqli_real_escape_string($link, $_POST['password']);

  echo "El usuario ingresado es: ". $username . "<br/>";
  echo "La contraseña ingresada es: ". $password;

  $bool = true;
  $query = mysqli_query($link, "Select * from users"); 
  while($row = mysqli_fetch_array($link, $query)) 
  {
    $table_users = $row['username']; 
    if($username == $table_users) 
    {
      $bool = false; 
      Print '<script>alert("El usuario está en uso!");</script>'; 
      Print '<script>window.location.assign("registro.php");</script>'; 
    }
  }
  if($bool) 
  {
    mysqli_query($link, "INSERT INTO users (username, password) VALUES ('$username','$password')"); 
    Print '<script>alert("Registrado exitosamente!");</script>'; 
    Print '<script>window.location.assign("registro.php");</script>'; 
  }
}
?>