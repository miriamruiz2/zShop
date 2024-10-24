<?php 
include 'config.php';
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
	
	<!-- Owl Stylesheets -->
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">	
</head>

<body class="home-page">
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
							   <li class="active"><a href='index.php'><span>INICIO</span></a></li>
							   <li><a href='single.html'><span>ACERCA DE</span></a></li>
							   <li><a href='login.php'><span>ADMINISTRACIÓN</span></a></li>
							   <li class='last'><a href='contact.php'><span>CONTACTO</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>
		
	<!--////////////////////////////////////Container-->
	<section id="container" class="zerogrid">
		<div class="wrap-container">

			<!-----------------content-box-1-------------------->
			<section class="content-box box-1">
				<div class="wrap-box"><!--Start Box-->
					<div id="owl-travel" class="owl-carousel">
						<?php
							try{
								$sql="SELECT nombre, imagen from slides";
								$stmt=$cone->prepare($sql);
								if ($stmt->execute()){
									while ($fila=$stmt->fetch()){
										echo "<div class='item'>";
										echo "<img src='".$fila['imagen']."'/>";
										echo "</div>";
									}
								}
							} catch (PDOException $e){
								die("Error al mostrar datos");
							} catch (Exception $e){
								die("Error de acceso");
							}
						?>
					</div>
				</div>
			</section>
			
			<!-----------------content-box-2-------------------->
			<section class="content-box box-2">
				<div class="wrap-box"><!--Start Box-->
					<div class="row">
						<?php
							try{
							$sql="SELECT id, nombre, imagen from categorias";
							$stmt=$cone->prepare($sql);
								if	($stmt->execute()){
									$estilos=array("col-2-5 box-item","col-3-5 box-item","col-3-5 box-item","col-2-5 box-item","col-1-2 box-item","col-1-2 box-item");
									$colores=array("box-item-image gradient-1", "box-item-image gradient-2", "box-item-image gradient-3", "box-item-image gradient-4", "box-item-image gradient-5", "box-item-image gradient-6");
									$cont=0;
									$cont2=0;
									while ($fila=$stmt->fetch()){
										echo "<div class='{$estilos[$cont++]}'>";
											echo "<a class='box-item-inner' href='productos.php?refer=index&idcat={$fila['id']}'>";
												echo "<div class='{$colores[$cont2++]}' style='background-image: url({$fila['imagen']})'></div>";
												echo "<h3 class='sub-title'>{$fila['id']}</h3>";
												echo "<div class='box-item-detail'>";
													echo "<h2 class='title'><strong>#</strong>{$fila['nombre']}</h2>";
						
							$sql2="SELECT count(*) from productos where idcat=:idcat";
							$stmt2=$cone->prepare($sql2);
								if	($stmt2->execute([":idcat"=>$fila['id']])){
									$total=$stmt2->fetchColumn();
													echo "<p><strong>{$total}</strong> Productos</p>";
								}
												echo "</div>";
											echo "</a>";
										echo "</div>";		
									}	
								}
							} catch (PDOException $e){
								die ("Error al mostrar datos");
							} catch (Exception $e){
								die ("Error de acceso");
							}
						?>
					</div>
				</div>
			</section>
			
			<!-----------------content-box-3-------------------->
			<?php
				try{
					$sql="SELECT * from indefinido";
					$stmt=$cone->prepare($sql);
					if ($stmt->execute()){
						while ($fila=$stmt->fetch()){
							echo "<section class='content-box box-3 box-style-1' style='background:#fff url({$fila['imagen']}) no-repeat 100% 100%; color: #333;'>";
								echo "<div class='row wrap-box'><!--Start Box-->";
									echo "<div class='col-1-2'>";
										echo "<div class='wrap-col'>";
											echo "<div class='box-text'>";
												echo "<h1>{$fila['titulo']}</h1>";
												echo "<p class='lead'>{$fila['texto']}</p>";
						}
					}
				} catch (PDOException $e){
					die("Error al mostrar datos");
				} catch (Exception $e){
					die("Error de acceso");
				}
			?>
	
									
									
												<a class="button button-skin" href="single.html">Leer más</a>
											</div>
										</div>
									</div>
								</div>
							</section>
				
			<!-----------------content-box-5-------------------->
			<section class="content-box box-5 box-style-3">
				<div class="row wrap-box"><!--Start Box-->
					<div class="col-full">
						<div class="box-text">
							<div class="heading">
								<h2>Contacto</h2>
								<span class="intro">Obtenga información y noticias exclusivas para suscriptores</span>
							</div>
							<div class="content">
								<p>Únete a nuestra comunidad de amantes de la moda y descubre un mundo de estilo en zShop</p>
								<div class="subscribe-form">
									<form name="form1" id="subs_form" method="post" action="contact.php">
										<label class="row">
											<div class="wrap-col">
												<input class="button button-skin button-subscribe" type="submit" name="Submit" value="Suscribirse">
											</div>
										</label>
									</form>
								</div>
							</div>
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
	</div>
	
	<!-- Owl Carusel JavaScript -->
	<script src="owlcarousel/owl.carousel.js"></script>
	<script>
	$(document).ready(function() {
	  $("#owl-travel").owlCarousel({
		autoplay:true,
		autoplayTimeout:3000,
		loop:true,
		items : 1,
		nav:true,
		navText: ['<i class="fa fa-chevron-left fa-2x"></i>', '<i class="fa fa-chevron-right fa-2x"></i>'],
		pagination:false
	  });
	});
	</script>
	
</body>
</html>