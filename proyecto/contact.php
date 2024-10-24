<?php
// Free html5 templates : http://www.zerotheme.com
include "config.php";
if(isset($_POST['submit'])){
	$name=htmlspecialchars(filter_var($_POST['name']));
	$email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$message=htmlspecialchars(filter_var($_POST['message']));
	$subject=htmlspecialchars(filter_var($_POST['subject']));

	$to = "example@gmail.com";
	$subject = "Nuevo mensaje de $name";
	$message = " Name: " . $name ."\r\n Email: " . $email . "\r\n Message:\r\n" . $message;
	 
	$from = "$email";
	$headers = "From:" . $from . "\r\n";
	$headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n"; 
	 
	if(mail($to,$subject,$message,$headers)){
		$text = "<span style='color:blue; font-size: 35px; line-height: 40px; margin: 10px;'>Tu mensaje ha sido enviado correctamente!</span>";
	} else{
		$text = "<span style='color:red; font-size: 35px; line-height: 40px; magin: 10px;'>Error! Inténtalo de nuevo.</span>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>zShop</title>
	<meta name="description" content="Free Responsive Html5 Css3 Templates | Zerotheme.com">
	<meta name="author" content="http://www.Zerotheme.com">
	
    <!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
	================================================== -->
  	<link rel="stylesheet" href="css/zerogrid.css">
	<link rel="stylesheet" href="css/style.css">
	
	<!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/menu.css">

	<!-- jQuery Core Javascript -->
	<script src="js/jquery.min.js"></script>
	<script src="js/script.js"></script>
	
	<!-- Owl Carousel Assets -->
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet">
</head>

<body>
	<div class="wrap-body">
		<header class="main-header">
			<div class="zerogrid">
				<div class="row">
					<div class="col-1-3">
						<a class="site-branding" href="index.php">
							<img src="images/logo.png"/>	
						</a><!-- .site-branding -->
					</div>
					<div class="col-2-3">
						<!-- Menu-main -->
						<div id='cssmenu' class="align-right">
							<ul>
							   <li><a href='index.php'><span>INICIO</span></a></li>
							   <li><a href='single.html'><span>ACERCA DE</span></a></li>
							   <li><a href='login.php'><span>ADMINISTRACIÓN</span></a></li>
							   <li class="active"><a href='contact.php'><span>CONTACTO</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>
		
	<!--////////////////////////////////////Container-->
	<section id="container" class="zerogrid">
		<div class="wrap-container">
			<!-----------------Content-Box-------------------->
			<section class="content-box">
				<div class="row wrap-box"><!--Start Box-->				
					<!--Start Map-->
					<div id="map" style="height: 450px;"></div>
					<!--End Map-->			
					<div class="contact-form">
						<h3 class="t-center">Formulario de Contacto</h3>			
						<!--Warning-->
						<center><?php echo $text;?></center>
						<!---->
						<div id="contact_form">
							<form name="form1" id="ff" method="post" action="contact.php">
								<label class="row">
									<div class="col-1-3">
										<div class="wrap-col">
											<input type="text" name="name" id="name" placeholder="Introduce tu nombre" required="required" />
										</div>
									</div>
									<div class="col-1-3">
										<div class="wrap-col">
											<input type="email" name="email" id="email" placeholder="Introduce tu email" required="required" />
										</div>
									</div>
									<div class="col-1-3">
										<div class="wrap-col">
											<input type="text" name="subject" id="subject" placeholder="Asunto" required="required" />
										</div>
									</div>
								</label>
								<label class="row">
									<div class="wrap-col">
										<textarea name="message" id="message" class="form-control" rows="4" cols="25" required="required"
										placeholder="Mensaje"></textarea>
									</div>
								</label>
								<center><input class="button button-skin" type="submit" name="submit" value="Enviar"></center>
							</form>
						</div>
					</div>
				</div>
			</section>	
		</div>
	</section>
		
	<!--////////////////////////////////////Footer-->
	<footer>
		<div class="zerogrid">
			<div class="wrap-footer">
				<div class="row">
					<div class="col-1-3 col-footer-1">
						<div class="wrap-col">
							<h3 class="widget-title">Sobre nosotros</h3>
							<p>En zShop, nos enorgullece presentar una cuidada selección de prendas de alta calidad y últimas tendencias, diseñadas para realzar tu individualidad y celebrar tu amor por la moda.</p>
							<p>Explora nuestro catálogo en línea y sumérgete en la moda que te hace sentir único.</p>
						</div>
					</div>
					<div class="col-1-3 col-footer-2">
						<div class="wrap-col">
							<h3 class="widget-title">Últimos articulos</h3>
							<ul>
								<?php
									try {
										$sql="SELECT * from productos order by fecalta desc limit 4";
										$stmt=$cone->prepare($sql);
										if ($stmt->execute()){
											while ($fila=$stmt->fetch()){
												echo "<li>{$fila['nombre']}</li>";
											}
										}
									} catch (PDOException $e){
										die("Error al mostrar datos");
									} catch (Exception $e){
										die("Error de acceso");
									}
								?>
							</ul>
						</div>
					</div>
					<div class="col-1-3 col-footer-3">
						<div class="wrap-col">
							<h3 class="widget-title">Donde encontrarnos</h3>
							<div class="row">
								<address>
									<strong>MURCIA ESPAÑA</strong>
										<br>
										Murcia
										<br>
										Caravaca
										<br>
										Mula
								</address><br>
								<p>
									<strong>Horario de apertura:</strong>
										<br>
										Lunes - Viernes: 9:00 - 21:00
										<br>
										Sabados: 9:00 - 2:00
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bottom-footer">
				<div class="bottom-social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-instagram"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-google-plus"></i></a>
					<a href="#"><i class="fa fa-pinterest"></i></a>
					<a href="#"><i class="fa fa-vimeo"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-youtube"></i></a>
				</div>
				<div class="copyright">
					Copyright @ - Designed by <a href="https://www.zerotheme.com">ZEROTHEME</a>
				</div>
			</div>
		</div>
	</footer>
	<!-- Google Map -->
	<script>
	  var marker;
	  var image = 'images/map-marker.png';
      function initMap() {
        var myLatLng = {lat: 39.79, lng: -86.14};

		// Specify features and elements to define styles.
        var styleArray = [
          {
            featureType: "all",
            stylers: [
             { saturation: -80 }
            ]
          },{
            featureType: "road.arterial",
            elementType: "geometry",
            stylers: [
              { hue: "#000000" },
              { saturation: 50 }
            ]
          },{
            featureType: "poi.business",
            elementType: "labels",
            stylers: [
              { visibility: "off" }
            ]
          }
        ];
		
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          scrollwheel: false,
		   // Apply the map style array to the map.
          styles: styleArray,
          zoom: 7
        });

        var directionsDisplay = new google.maps.DirectionsRenderer({
          map: map
        });

		// Create a marker and set its position.
        marker = new google.maps.Marker({
          map: map,
		  icon: image,
		  draggable: true,
          animation: google.maps.Animation.DROP,
          position: myLatLng
        });
		marker.addListener('click', toggleBounce);
      }
	  
	  function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7V-mAjEzzmP6PCQda8To0ZW_o3UOCVCE&callback=initMap" async defer></script>
	
	</div>
</body>
</html>