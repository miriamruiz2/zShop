<?php 
session_start();
if (!isset($_SESSION['identificado'])){
	header("location:login.php");
	die();
}
include 'config.php';

if (isset($_GET['id']) && isset($_GET['idcat'])){
    $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
    $idcat=filter_input(INPUT_GET,'idcat',FILTER_VALIDATE_INT);
    $sql = "SELECT COUNT(*) FROM productos WHERE id = :x and idcat = :y";
            $stmt = $cone->prepare($sql);
            $stmt->bindParam(':x', $id, PDO::PARAM_INT);
            $stmt->bindParam(':y', $idcat, PDO::PARAM_INT);
            $stmt->execute();
    if ($id===false || $id <= 0 || $idcat===false || $idcat <= 0 || $stmt->fetchColumn()==0){
        echo "<script>alert('Valor no válido para el producto')</script>";
        echo "<script>window.location.href = 'adm_productos.php';</script>";
        die();
    }

    
    if (isset($_POST['aceptar'])){
        $nombre=htmlspecialchars(trim(filter_input(INPUT_POST,'nombre')));
        if ($nombre==""){
            $errores['nombre']="Debes introducir un nombre";
        }
        $detalle=htmlspecialchars(trim(filter_input(INPUT_POST,'detalle')));
        if ($detalle==""){
            $errores['detalle']="Debes introducir una descripción";
        }
        $precio=filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
        if ($precio==""){
            $errores['precio']="Debes introducir un precio";
        }
        if ($precio <=0){
            $errores['precio']="Debes introducir un precio mayor que cero";
        }
        
        $categoria=filter_input(INPUT_POST, 'categoria', FILTER_VALIDATE_INT);
        $cat=array();
        try {
            $sql="SELECT * from categorias";
            $stmt=$cone->prepare($sql);
            if ($stmt->execute()) {
                while ($fila=$stmt->fetch()) {
                    array_push($cat, $fila['id']);
                }
            }
        } catch (PDOException $e){
            die("Error al mostrar datos");
        } catch (Exception $e){
            die("Error de acceso");
        } 
        if (!in_array($categoria, $cat)){
            $errores['categoria'] = "Debes introducir una categoria correcta";
        }
        
        if (!isset($errores)){
                try {
                    $sql="UPDATE productos set idcat=:idcat, nombre=:nom, detalle=:detalle, precio=:precio, fecalta=CURDATE() where id=:x";
                    $stmt=$cone->prepare($sql);
                    if  ($stmt->execute([":idcat"=>$_POST['categoria'], ":nom"=>$_POST['nombre'], ":detalle"=>$_POST['detalle'], ":precio"=>$_POST['precio'], ":x"=>$id])){
                        if  ($stmt->rowCount()!=1){
                            $errores="Se ha producido un error al actualizar el producto";
                        } else {
                            header("location:adm_productos.php");
                        }
                    }
                } catch (PDOException $e){
                    die ("Error update".$e->getMessage());
                }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Modificar Productos</title>
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
        body .wrap-body1 {background-image: url(images/bg3.jpg);background-position: center center;background-repeat: no-repeat;background-attachment: fixed;background-size: cover;color:#fff;position: relative; height: 100vh;}
        table.tstyle td {
            color: black;
		}
        select {display:block;width:100%;color:#222;border:1px solid #d1d1d1;padding:15px;margin: 5px 0 20px 0;font-size: 15px;}
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
				<div id="contact_form">
                    <form method="post">
                        <?php
                            try {
                                $sql="SELECT * from productos where id= :x";
                                $stmt=$cone->prepare($sql);
                                if  ($stmt->execute([":x"=>$id])){
                                    while ($fila=$stmt->fetch()){
                                        $idcatproducto=$fila['idcat'];         
                        ?>
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" value="<?=$fila['nombre']?>"/>
                                        <input type="hidden" name="id" value="<?=$id?>"/>
                                        <?=isset($errores['nombre']) ? $errores['nombre'] : ''?> <br>

                                        <label for="detalle">Descripción</label>
                                        <input type="text" name="detalle" value="<?=$fila['detalle']?>"/>
                                        <?=isset($errores['detalle']) ? $errores['detalle'] : ''?> <br>

                                        <label for="precio">Precio</label>
                                        <input type="text" name="precio" value="<?=$fila['precio']?>"/>
                                        <?=isset($errores['precio']) ? $errores['precio'] : ''?> <br>
                        <?php
                                    }
                                }
                            } catch (PDOException $e){
                                die ("Error al conectar". $e->getMessage());
                            }
                        ?>            
                                        <label for="">Categoría</label>
                                        <select name="categoria" id="categoria">                
                        <?php                             
                            try {
                                $sql="SELECT * from categorias";
                                $stmt=$cone->prepare($sql);
                                if  ($stmt->execute()){
                                    while ($fila=$stmt->fetch()){
                                        $selected = ($idcatproducto == $fila['id']) ? "selected" : "";
                        ?>        
                                        <option value="<?=$fila['id']?>" <?= $selected ?>><?=$fila['nombre']?></option>                                        
                        <?php
                                    }
                                }
                            } catch (PDOException $e){
                                die("Error al mostrar datos");
                            } catch (Exception $e){
                                die("Error de acceso");
                            } 
                        ?>                            
                                        </select>
                                        <?=isset($errores['categoria']) ? $errores['categoria'] : ''?> <br>
                                        <div class="t-center">
                                            <input type="submit" class="button button-skin" name="aceptar" value="Aceptar">
                                        </div>
                    </form>
				</div>		
			</div>
		</div>
	</section>

	<!--////////////////////////////////////Footer-->
	<footer>
		<div class="zerogrid">
			<div class="bottom-footer"></div>
            <div class="bottom-footer"></div>
		</div>
	</footer> 
    </div>
</body>
</html>