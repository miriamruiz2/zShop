<?php
 session_start();
 if (!isset($_SESSION['identificado'])){
	 header("location:login.php");
	 die();
 }
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Formulario Productos</title>
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
	<style>
		.btn-modificar {
    		background-color: #098F8E;
    		color: white;
  		}
		.btn-eliminar {
    		background-color: #f44336;
    		color: white;
  		}
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
							   <li><a href='single.html'><span>ACERCA DE</span></a></li>
							   <li class="active"><a href='login.php'><span>ADMINISTRACIÓN</span></a></li>
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
			<div class="contact-form">
				<label class="row">
					<div class="col-1-3">
                    	<div class="t-left">
							<?php
								try {
									$sql="SELECT imagen, nombre from usuarios";
									$stmt=$cone->prepare($sql);
									if ($stmt->execute()){
										while ($fila=$stmt->fetch()){
											echo "<img width='80' height='80' src='".$fila['imagen']."'/>";
											echo "<span style='color: grey;'>" . $fila['nombre'] . "</span>";
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
					<div class="col-1-3">
                        <div class="t-center">
                            <h3>PRODUCTOS</h3>
                        </div>
					</div>
					<div class="col-1-3">
						<div class="t-right">
							<a href="salir.php">Cerrar sesion</a>
						</div>					
					</div>
				</label>
				<label class="row">
					<div class="wrap-col">
						<div class="t-center">
							<table class="tstyle">
								<tr>
									<th>Producto</th>
									<th>Acciones</th>
								</tr>
								<?php
									try {
										$sql="SELECT * from productos";
										$stmt=$cone->prepare($sql);
										if ($stmt->execute()){
											while ($fila=$stmt->fetch()){
												echo "<tr>";
													echo "<td>{$fila['nombre']}</td>";
													echo "<td><a href='mod_productos.php?id={$fila['id']}&idcat={$fila['idcat']}' class='btn-modificar'>Modificar</a>";
														echo "<a href='eliminar_producto.php?id={$fila['id']}' class='btn-eliminar'>Eliminar</a></td>";
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
				</label>
				<form id="prodform" action="alta_productos.php">
					<div class="t-center">
                        <input class="button button-skin" type="submit" name="alta" value="Alta">
                    </div>
				</form>
			</div>
		</div>
	</section>

	<!--////////////////////////////////////Footer-->
	<footer>
		<div class="zerogrid">
			<div class="bottom-footer"></div>
		</div>
	</footer>
	</div>        
</body>
</html>