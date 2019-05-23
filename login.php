<html>
	<head>
		<title>
			Ingreso de usuarios
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
			Ingreso de usuarios
		</h1>
		<br>
		<form action="checklogin.php" method="POST">
           Ingresar usuario: <input type="text" name="username" required="required"/> <br/>
           Ingresar contraseña: <input type="password" name="password" required="required"/> <br/>
           <input type="submit" value="Iniciar sesión"/>
        </form>
        <img class="img-back" src="https://www.kupilskazal.ru/upload/profile/b77543752fc51766de4707d5578ced0c.jpg">
	</body>
</html>