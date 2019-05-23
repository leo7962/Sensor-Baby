<!DOCTYPE html>
<html>
<head>
  <title>Social riders</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style_2.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php
session_start();
if($_SESSION['user']){
}
else{
  header("location:index.php");
}
$id = "";
$user = $_SESSION['user'];
$nombre = "";
$apellido = "";
$segundo_nombre = "";
$correo = "";
$fecha_nacimiento = "";
$fecha_registro = "";
$ciudad_nacimiento = "";
$pais_nacimiento = "";
$religion = "";
$imagen = "";

$link = mysqli_connect("localhost", "root", "", "parcial") or die($link);
$query = mysqli_query($link, "Select * from users where username='$user'"); // SQL Query
if($row = mysqli_fetch_array($query))
{
  $id = $row['id_user'];
  $nombre = $row['nombre'];
  $apellido = $row['apellido'];
  $segundo_nombre = $row['segundo_nombre'];
  $correo = $row['correo'];
  $fecha_nacimiento = $row['fecha_nacimiento'];
  $fecha_registro = $row['fecha_registro'];
  $ciudad_nacimiento = $row['ciudad_nacimiento'];
  $pais_nacimiento = $row['pais_nacimiento'];
  $religion = $row['religion'];
  $imagen = $row['imagen_user'];
}else{
  Print '<script>alert("NO entró!");</script>'; 
}
$fecha_nacimiento = date('d-m-Y', strtotime($fecha_nacimiento));
$fecha_registro = date('d-m-Y', strtotime($fecha_registro));
?>
<body>

  <!-- Navbar -->      
  <div class="w3-top navbar">
    <div class="w3-bar w3-black w3-card-2" style="width: 100%; height: 48px;">
    </div>
    <div class="w3-bar w3-black" style="position: fixed; top: 1px; background-color: rgba(0, 0, 0, 0) !important;">
      <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu">
        <i class="fa fa-bars"></i>
      </a>
      <a href="#home" class="w3-bar-item w3-button w3-padding-large" style="padding-left: 0px!important; padding-top: 0px !important; padding-bottom:0px !important; width: 7%;">
        <img src="https://www.kupilskazal.ru/upload/profile/b77543752fc51766de4707d5578ced0c.jpg" style="height: 50px; margin-bottom: -3px !important;">
      </a>
      <a href="#Notificaciones" class="w3-bar-item w3-button w3-padding-large w3-hide-small">TUS NOTIFICACIONES</a>
      <a href="#Profile" class="w3-bar-item w3-button w3-padding-large w3-hide-small">TU PERFIL</a>
      <a href="#Motorcycles" class="w3-bar-item w3-button w3-padding-large w3-hide-small">TUS LOCALIZADORES</a>
      <a href="#tour" class="w3-bar-item w3-button w3-padding-large w3-hide-small">TUS EVENTOS</a>    
      <a href="#map" class="w3-bar-item w3-button w3-padding-large w3-hide-small">UBICACIÓN</a>
      <div class="w3-dropdown-hover" style="display: flex;">
        <button class="w3-padding-large w3-button" title="More">MÁS <i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-bar-block" style="height: 46px;">
          <a href="#contact" class="w3-bar-item w3-button" style="height: 46px; padding-left: 50px; padding-top: 10px;">Ayuda</a>
        </div>
      </div>
      <div class="w3-dropdown-hover w3-hide-small navbar-right">
        <button id="end_session" class="w3-padding-large w3-button btn btn-info btn-lg" title="More">
          <span class="glyphicon glyphicon-user"></span>
          &nbsp;
          <?php Print "$nombre"?> <?php Print "$apellido"?>!
          &nbsp;
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4 navbar-login">
          <div class="row">
            <div class="col-lg-4">
              <p class="text-center">
                <?php Print "<img class='icon-size img-circle img-responsive' src='$imagen'>"?>                    
              </p>
            </div>
            <div class="col-lg-8">
              <p class="text-left"><strong><?php Print "$nombre"?> <?php Print "$apellido"?></strong></p>
              <p class="text-left small"><?php Print "$correo"?></p>
              <p class="text-left">
                <a href="#Profile" class="btn btn-primary btn-block btn-sm">Actualizar Datos</a>
              </p>
            </div>
          </div>
        </div>
        <div class="w3-dropdown-content w3-bar-block w3-card-4 navbar-login navbar-login-session">
          <div class="row">
            <div class="col-lg-12">
              <p>
                <a href="logout.php" class="btn btn-danger btn-block">Cerrar Sesion</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="navbar w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
    <a href="#Notificaciones" class="w3-bar-item w3-button w3-padding-large">TUS NOTIFICACIONES</a>
    <a href="#Profile" class="w3-bar-item w3-button w3-padding-large">TU PERFIL</a>
    <a href="#Motorcycles" class="w3-bar-item w3-button w3-padding-large">TUS LOCALIZADORES</a>
    <a href="#tour" class="w3-bar-item w3-button w3-padding-large">TUS EVENTOS</a>
    <a href="#map" class="w3-bar-item w3-button w3-padding-large">UBICACIÓN</a>
  </div>

  <!-- Page content -->
  <div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- Automatic Slideshow Images -->
    <div id="home" class="mySlides w3-display-container w3-center">
      <!-- <img src="http://www.supermoto8.net/images/article/d8e8e3c7ad0627907a5116fe7410cd9e1.jpg" style="width:100%"> -->
      <img src="https://blossomstation.files.wordpress.com/2014/08/blossom_center_microwave.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
        <h3>¡Controla!</h3>
        <p><b>Cada uno de tus sensores.</b></p>
      </div>
    </div>
    <div class="mySlides w3-display-container w3-center">
      <img src="https://www.lefax.de/static/media/images/upload/Content_Visual_706x353/content_visual_706x353_0021_3.3.1.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
        <h3>¡Revisa!</h3>
        <p><b>A tu bebé en cualquier momento.</b></p>
      </div>
    </div>
    <div class="mySlides w3-display-container w3-center">
      <img src="https://pbs.twimg.com/media/Du-0kkQWsAE3lis.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
        <h3>¡Comparte!</h3>
        <p><b>El estado de tu bebé a cualquier familiar.</b></p>
      </div>
    </div>

    <!-- The Popup Section -->
    <div class="w3-container w3-content w3-center w3-padding-64 w3-black" style="max-width:100%" id="Notificaciones">
      <h2 class="w3-wide">TUS NOTIFICACIONES</h2>
      <div class="w3-row w3-padding-100">
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Espera!</strong> Tu localizador se va a apagar, deberías cargarlo.
        </div>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Cuidado!</strong>
          <?php
          if($_SESSION['user']){
          }
          else{
            header("location:index.php");
          }
          $user = $_SESSION['user'];
          $link = mysqli_connect("localhost", "root", "", "parcial") or die($link);
          $query = mysqli_query($link, "Select * from bikes join users on bikes.id_user = users.id_user where username='$user' limit 1"); // SQL Query
          while($row1 = mysqli_fetch_array($query))
          {
            Print " Tu localizador de <a href='#Motorcycles'' class='alert-link' onclick='myFunction()'>".$row1['marca']." ".$row1['referencia']."</a> puede estar requiriendo cambio de aceite.";
          }
          ?>
        </div>
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Atención!</strong> Tu bebé tiene cita médica el lunes 24 de mayo.
        </div>
      </div>
    </div>

    <!-- The Profile Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1000px" id="Profile">
      <div class="container w3-center">
        <div class="row">
          <div class="col-md-7">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="w3-wide">TU PERFIL</h2>
                <p class="w3-opacity"><i>I love my baby!</i></p>
              </div>
              <div class="panel-body">
                <div class="box box-info">
                  <div class="box-body">
                    <div class="col-sm-6">
                      <div  align="center">
                        <?php Print "<img alt='User Pic' src='$imagen' id='profile-image1' class='img-circle img-responsive'>"?>  

                        <input id="profile-image-upload" class="hidden" type="file">
                        <div class="sub-img">Click aquí para cambiar la imagen de perfil</div><!--Upload Image Js And Css-->
                      </div>
                      <br>
                      <!-- /input-group -->
                    </div>
                    <div class="col-sm-6">
                      <span><h4 style="color:#d63333;"><?php Print "$nombre"?> <?php Print "$apellido"?></h4></span>
                      <span>Mamá responsable <span class="glyphicon glyphicon-ok-sign"></span></span>
                    </div>
                    <div class="clearfix"></div>
                    <hr style="margin:5px 0 5px 0;">
                    <div class="col-sm-5 col-xs-6 tital " >Primer Nombre:</div><div class="col-sm-7 col-xs-6 "><?php Print "$nombre"?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >Segundo Nombre:</div><div class="col-sm-7"><?php Print "$segundo_nombre"?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >Apellido:</div><div class="col-sm-7"><?php Print "$apellido"?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >Fecha de Registro:</div><div class="col-sm-7"><?php Print "$fecha_registro"?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >Fecha de Nacimiento:</div><div class="col-sm-7"><?php Print "$fecha_nacimiento"?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >Lugar de Nacimiento:</div><div class="col-sm-7"><?php Print "$ciudad_nacimiento"?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >País de Nacimiento:</div><div class="col-sm-7"><?php Print "$pais_nacimiento"?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >Religión:</div><div class="col-sm-7"><?php Print "$religion"?></div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
            </div>
          </div>
          <script>
            $(function() {
              $('#profile-image1').on('click', function() {
                $('#profile-image-upload').click();
              });
            });
          </script>
        </div>
      </div>
    </div>

    <!-- The Motorcycle Section -->
    <div class="w3-container w3-content w3-center w3-padding-64 w3-black" style="max-width:100%" id="Motorcycles">
      <h2 class="w3-wide">TUS LOCALIZADORES</h2>
      <div class="w3-row w3-padding-100">
        <?php
        if($_SESSION['user']){
        }
        else{
          header("location:index.php");
        }
        $user = $_SESSION['user'];
        $link = mysqli_connect("localhost", "root", "", "parcial") or die($link);
          $query = mysqli_query($link, "Select * from bikes join users on bikes.id_user = users.id_user where username='$user'"); // SQL Query
          while($row2 = mysqli_fetch_array($query))
          {
            Print "<div class='w3-third'>";
            Print "<p class='moto-title'>".$row2['marca']." ".$row2['referencia']."</p>";
            Print "<a href='?LED=ON'>";
            Print "<img src='".$row2['imagen_bike']."' class='img-circle w3-margin-bottom' alt='Bike 1' style='width:60%'>";
            Print "</a>";
            Print "<br>";
            Print "<br>";
            Print "<a href='?LED=OFF'>";
            Print "<img src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Button_Icon_Red.svg/1024px-Button_Icon_Red.svg.png' class='img-circle w3-margin-bottom' alt='Bike 1' style='width:10%'>";
            Print "</a>";
            Print"</div>";
          }
          ?>
        </div>
      </div>

      <!-- The Tour Section -->
      <div id="tour">
        <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
          <h2 class="w3-wide w3-center">TUS EVENTOS</h2>
          <p class="w3-opacity w3-center"><i>Recuerda separar tus entradas!</i></p><br>

          <ul class="w3-ul w3-border w3-white w3-text-grey">
            <li class="w3-padding">Septiembre <span class="w3-tag w3-red w3-margin-left">Agotado</span></li>
            <li class="w3-padding">Octubre <span class="w3-tag w3-red w3-margin-left">Agotado</span></li>
            <li class="w3-padding">Noviembre <span class="w3-badge w3-right w3-margin-right">3</span></li>
          </ul>

          <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
            <div class="w3-third w3-margin-bottom">
              <img src="https://www.w3schools.com/w3images/newyork.jpg" alt="New York" style="width:100%" class="w3-hover-opacity">
              <div class="w3-container w3-white">
                <p><b>New York</b></p>
                <p class="w3-opacity">Vie 27 Nov 2019</p>
                <p>
                  Concierto de rock especializado para bebés.
                </p>
                <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Separar tiquetes</button>
              </div>
            </div>
            <div class="w3-third w3-margin-bottom">
              <img src="https://www.w3schools.com/w3images/paris.jpg" alt="Paris" style="width:100%" class="w3-hover-opacity">
              <div class="w3-container w3-white">
                <p><b>Paris</b></p>
                <p class="w3-opacity">Sab 28 Nov 2019</p>
                <p>
                  Semana del bebé en Paris: Reunión de los más influenciadores en el tema.
                </p>
                <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Separar tiquetes</button>
              </div>
            </div>
            <div class="w3-third w3-margin-bottom">
              <img src="https://www.w3schools.com/w3images/sanfran.jpg" alt="San Francisco" style="width:100%" class="w3-hover-opacity">
              <div class="w3-container w3-white">
                <p><b>San Francisco</b></p>
                <p class="w3-opacity">Dom 29 Nov 2019</p>
                <p>
                  ¿Cómo ser el MEJOR papá? Reúnete con el conferencista más anhelado en el tema: Paul Hattaway.
                </p>
                <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Separar tiquetes</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Ticket Modal -->
      <div id="ticketModal" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-4">
          <header class="w3-container w3-teal w3-center w3-padding-32">
            <span onclick="document.getElementById('ticketModal').style.display='none'"
            class="w3-button w3-teal w3-xlarge w3-display-topright">X</span>
            <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Tiquetes</h2>
          </header>
          <div class="w3-container">
            <p><label><i class="fa fa-shopping-cart"></i> Tiquetes, $15.000 por persona</label></p>
            <input class="w3-input w3-border" type="text" placeholder="¿Cuántas?">
            <p><label><i class="fa fa-user"></i>Enviar a</label></p>
            <input class="w3-input w3-border" type="text" placeholder="Ingresa email">
            <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right">SEPARAR<i class="fa fa-check"></i></button>
            <button class="w3-button w3-red w3-section" onclick="document.getElementById('ticketModal').style.display='none'">Cerrar <i class="fa fa-remove"></i></button>
            <p class="w3-right">¿Necesitas <a href="#" class="w3-text-blue">ayuda?</a></p>
          </div>
        </div>
      </div>

      <!-- Add Google Maps -->
      <div id="map"></div>
      <!-- Replace the value of the key parameter with your own API key. -->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9nVgT6a23BAWQ5aPKABl8ravbcFBbiWw&callback=initMap"></script>

      <script>
        var customLabel = {
          restaurant: {
            label: 'R'
          },
          bar: {
            label: 'B'
          }
        };

        function initMap() {
                  var map = new google.maps.Map(document.getElementById('map'), {
                      center: new google.maps.LatLng(-33.863276, 151.207977),
                      zoom: 12
                  });
                  var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://drive.google.com/open?id=0B7rfxcSTC5fpRHdJc1N4MWotOTg', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }

        function downloadUrl(url, callback) {
          var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

          request.onreadystatechange = function() {
            if (request.readyState == 4) {
              request.onreadystatechange = doNothing;
              callback(request, request.status);
            }
          };

          request.open('GET', url, true);
          request.send(null);
        }

        function doNothing() {}
      </script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

<!-- The Contact Section -->
<div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
  <h2 class="w3-wide w3-center">CONTACTO</h2>
  <p class="w3-opacity w3-center"><i>Tienes alguna idea? Déjanos un mensaje!</i></p>
  <div class="w3-row w3-padding-32">
    <div class="w3-col m6 w3-large w3-margin-bottom">
      <i class="fa fa-map-marker" style="width:30px"></i> Bogotá, CO<br>
      <i class="fa fa-phone" style="width:30px"></i> Teléfono: +57 3105486900<br>
      <i class="fa fa-envelope" style="width:30px"> </i> Email: admon@controlbaby.com<br>
    </div>
    <div class="w3-col m6">
      <form action="/action_page.php" target="_blank">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Nombre" required name="Nombre">
          </div>
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
          </div>
        </div>
        <textarea class="w3-input w3-border" type="text" placeholder="Mensaje" required name="Mensaje"></textarea>
        <button class="w3-button w3-black w3-section w3-right" type="submit">ENVIAR</button>
      </form>
    </div>
  </div>
</div>

<!-- End Page Content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p class="w3-medium">Patrocinado por UMB</p>
</footer>

<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
   x[i].style.display = "none";
 }
 myIndex++;
 if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
setTimeout(carousel, 4000);
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    // Initialize Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Add smooth scrolling to all links in navbar + footer link
    $(".navbar a, div div div a, footer a[href='#myPage']").on('click', function(event) {

      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {

        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 900, function(){

          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });

    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
  $(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, div div div a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>

</body>
</html>
