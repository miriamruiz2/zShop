<?php
include 'config.php';

if (!isset($_GET['refer']) || !isset($_GET['idcat'])) {
    header("Location: index.php");
    die();
}

if ($_GET['refer']!=='index') {
    header("Location: index.php");
    die();
}

if (isset($_GET['idcat'])){
$idcat=filter_input(INPUT_GET,'idcat',FILTER_VALIDATE_INT);
$sql = "SELECT COUNT(*) FROM categorias WHERE id = :x";
$stmt = $cone->prepare($sql);
$stmt->bindParam(':x', $idcat, PDO::PARAM_INT);
$stmt->execute();
	if ($idcat===false || $idcat <= 0 || $stmt->fetchColumn()==0){
    	echo "<script>alert('Valor no válido para la categoría')</script>";
    	echo "<script>window.location.href = 'index.php';</script>";
    	die();
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>PRODUCTOS</title>
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

	<style>
        table.tstyle td {
        	color: black;
		}
    </style>
</head>

<body class="sub-page">
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
							   <li class="active"><a href='single.html'><span>ACERCA DE</span></a></li>
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
			<!-----------------Content-Box-------------------->
			<article class="single-post">
				<div class="row wrap-post"><!--Start Box-->
					<div class="entry-header">
                        <?php
                            try {
                                $sql="SELECT * from categorias where id=:x";
                                $stmt=$cone->prepare($sql);
                                if ($stmt->execute([":x"=>$idcat])){
                                    if ($fila=$stmt->fetch()){
										echo "<h1 class='entry-title'>{$fila['nombre']}</h1>";					
					echo "</div>";
					echo "<div class='post-thumbnail-wrap'>";
						echo "<img src='{$fila['imagen']}'>";
					echo "</div>";
                                    }
                                }
                            } catch (PDOException $e){
								die("Error al mostrar datos");
							} catch (Exception $e){
								die("Error de acceso");
							}
                        ?>
						<div class="wrap-col">
							<div class="t-center">
                        		<table class="tstyle">
									<tr>
										<th>Id</th>
										<th>Id categoría</th>
    		                            <th>Nombre</th>
            	                        <th>Detalle</th>
                	                    <th>Precio</th>
                    	                <th>Fecha de alta</th>
									</tr>
	                        <?php
    	                        try {
        	                        $sql="SELECT * from productos where idcat=:x";
            	                    $stmt=$cone->prepare($sql);
                	                if ($stmt->execute([":x"=>$idcat])){
                    	                while ($fila=$stmt->fetch()){
                        	                echo "<tr>";
                            	                echo "<td>{$fila['id']}</td>";
                                	            echo "<td>{$fila['idcat']}</td>";
                                    	        echo "<td>{$fila['nombre']}</td>";
                                        	    echo "<td>{$fila['detalle']}</td>";
                                            	echo "<td>{$fila['precio']}</td>";
                                            	echo "<td>{$fila['fecalta']}</td>";
											echo "</tr>";
										}
			        				}
								} catch (PDOException $e){
									die("Error al mostrar datos");
								} catch (Exception $e){
									die("Error de acceso");
								}
							?>
								</table>
					
						</div>  
					</div>
				</div>
			</article>
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
</body>
</html>