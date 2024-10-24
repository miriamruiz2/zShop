<?php
include 'config.php';
session_start();
if (!isset($_SESSION['identificado'])){
    header("location:login.php");
    die();
}

if (isset($_POST['aceptar'])){
	$nombre=htmlspecialchars(trim(filter_input(INPUT_POST,'nombre')));
	if ($nombre==""){
		$errores['nombre'] = "Introduce un nombre";
	}
	if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $nombrearchivo= $_FILES['imagen']['name'];
        if ($_FILES['imagen']['type']!=="image/jpeg"){
			$errores['imagen']="La foto debe ser jpg";
        }
        if (!isset($errores['imagen'])){
            $foto="images/".time()."-".$_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'],$foto);
            }
        } else{
            $errores['imagen']="Introduce una imagen";
    }
	if (!isset($errores)){
		try {
			$cone = new PDO($dsn,$usuario,$contrasena);
			$sql="INSERT into slides (nombre, imagen) VALUES (:nombre, :imagen)";
			$stmt=$cone->prepare($sql);
			if  ($stmt->execute([":nombre"=>$nombre,":imagen"=>$foto]));
			$mensaje= "Slide añadido";
		} catch(PDOException $e){
		die("Error de conexión");
		}
	}	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free Responsive Html5 Css3 Templates | Zerotheme.com">
	<meta name="author" content="http://www.Zerotheme.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		body .wrap-body1 {background-image: url(images/bg3.jpg);background-position: center center;background-repeat: no-repeat;background-attachment: fixed;background-size: cover;color:#fff;position: relative; height: 100vh;}
		.btn-modificar {
    		background-color: #098F8E;
    		color: white;
  		}
		.btn-eliminar {
    		background-color: #f44336;
    		color: white;
  		}
        table.tstyle td {
            color: black; /* Color del texto del encabezado */
		}
	</style>
    <title>Alta Slides</title>
</head>
<body class="sub-page">
	<div class="wrap-body1">
		
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
					<div id="contact_form">
                        <form method="post" enctype="multipart/form-data">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" value="<?=isset($_POST['nombre']) && isset($errores) ? $_POST['nombre'] :''?>"/>
							<?=isset($errores['nombre']) ? $errores['nombre'] : ''?><br>
							<label for="imagen">Imagen</label>
							<input type="file" name="imagen" id="">
							<?=isset($errores['imagen']) ? $errores['imagen'] : ''?> <br>
							<?php echo isset($mensaje) ? $mensaje : ''; ?>
                            <center><input type="submit" class="button button-skin" name="aceptar" value="Añadir"/></center>
                        </form><br><br>
						<a href="adm_slides.php">Volver</a>

					</div>	
				</div>
			</div>
		</section>

		<!--////////////////////////////////////Footer-->
		<footer>
			<div class="zerogrid">
				<div class="bottom-footer">
				</div>
			</div>
		</footer>
	</div>

        
</body>
</html>