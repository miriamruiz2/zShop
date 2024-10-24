<?php 
include 'config.php';
session_start();
    if (!isset($_SESSION['identificado'])){
        header("location:login.php");
        die();
    }
	
if (isset($_POST['aceptar'])){
	$cat= array(
		"Camisetas" => 1, 
		"Camisas" => 2,
		"Vestidos" => 3,
		"Sudaderas" => 4, 
		"Leggings" => 5 ,
		"Pijamas" => 6
	);
	$categoria=filter_input(INPUT_POST, 'categoria', FILTER_VALIDATE_INT);
	if (!in_array($categoria, $cat)){
		$errores['categoria'] = "Debes introducir un producto correcto";
	}
	$nombre=htmlspecialchars(trim(filter_input(INPUT_POST,"nombre")));
	if ($nombre==""){
		$errores['nombre'] = "Introduce un nombre";
	}
    $detalle=htmlspecialchars(trim(filter_input(INPUT_POST, 'detalle')));
    if ($detalle=="") {
        $errores['detalle'] = "Introduce una descripción de producto";
    }
    $precio=htmlspecialchars(trim(filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT)));
    if ($precio=="") {
        $errores['precio'] = "Introduce un precio";
    }

	if (!isset($errores)){
		try {
			$sql="INSERT into productos (idcat, nombre, detalle, precio, fecalta) VALUES (:idcat, :nombre, :detalle, :precio, CURDATE())";
			$stmt=$cone->prepare($sql);
			if ($stmt->execute([":idcat"=>$_POST['categoria'], ":nombre"=>$_POST['nombre'],":detalle"=>$_POST['detalle'], ":precio"=>$_POST['precio']]));
			$mensaje= "Producto añadido";
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
        table.tstyle td {
            color: black;
		}
		select {display:block;width:100%;color:#222;border:1px solid #d1d1d1;padding:15px;margin: 5px 0 20px 0;font-size: 15px;}

	</style>
    <title>Alta Productos</title>
</head>
<body class="sub-page">
	<div class="wrap-body">
		
		<header class="main-header">
			<div class="zerogrid">
				<div class="row">
					<div class="col-1-3">
						<a class="site-branding" href="index.php">
							<img src="images/logo.png"/>	
						</a>
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
                        <form method="post" action="alta_productos.php">
                            <label for="categoria">Categoría</label>
                            <select name="categoria" id="categoria">
                            <?php
                                try {
                                    $sql="SELECT * from categorias";
                                    $stmt=$cone->prepare($sql);
                                    if ($stmt->execute()) {
                                        while ($fila=$stmt->fetch()) {
                                            echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
                                        }
                                    }
                                } catch (PDOException $e) {
                                    echo $stmt->debugDumpParams();
                                    die("Error de conexión" . $e->getMessage());
                                }
                            ?> 
                            </select>
                            <?= isset($errores['categoria']) ? $errores['categoria'] : ""?><br><br>

                            <label for="nombre">Nombre</label>
							<input type="text" name="nombre" value="<?=isset($_POST['nombre']) && isset($errores) ? $_POST['nombre'] :''?>">
							<?= isset($errores['nombre']) ? $errores['nombre'] : ""?><br>
							
                            <label for="detalle">Descripción</label>
							<input type="text" name="detalle" value="<?=isset($_POST['detalle']) && isset($errores) ? $_POST['detalle'] :''?>">
							<?=isset($errores['detalle']) ? $errores['detalle'] : ''?><br>

                            <label for="precio">Precio</label>
                            <input type="text" name="precio" value="<?=isset($_POST['precio']) && isset($errores) ? $_POST['precio'] :''?>">
                            <?=isset($errores['precio']) ? $errores['precio'] : ''?><br>
							<?php echo isset($mensaje) ? $mensaje : ''; ?>
                            <center><input type="submit" class="button button-skin" name="aceptar" value="Añadir"/></center>
                        </form><br><br>
						<a href="adm_productos.php">Volver</a>

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