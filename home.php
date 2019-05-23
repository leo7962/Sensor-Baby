<html>
	<head>
		<title>
			Home
		</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
        <style>
	      @import url('https://fonts.googleapis.com/css?family=Montserrat');
	    </style>
	</head>
	<?php
		session_start();
		if($_SESSION['user']){
		}
		else{
			header("location:index.php");
		}
		$user = $_SESSION['user'];
	?>
	<body>
		<a href="logout.php" class="inputback">
			Cerrar sesión
		</a>
		<h1>
			Home
		</h1>
		<h2>Hola <?php Print "$user"?>!</h2>
		<table>
			<tr>
				<th>
					Usuario
				</th>
				<th>
					Contraseña
				</th>
			</tr>
			<?php
				$link = mysqli_connect("localhost", "root", "", "parcial") or die($link);
				$query = mysqli_query($link, "Select * from users"); // SQL Query
				while($row = mysqli_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center">'. $row['username'] . "</td>";
						Print '<td align="center">'. $row['password'] . "</td>";
					Print "</tr>";
				}
			?>
		</table>
	</body>
</html>