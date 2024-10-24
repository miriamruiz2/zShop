<?php 
session_start();
if (!isset($_SESSION['identificado'])){
	header("location:login.php");
	die();
}
include 'config.php';

if (isset($_GET['idcat'])){
    $idcat=filter_input(INPUT_GET,'idcat',FILTER_VALIDATE_INT);
    $sql = "SELECT COUNT(*) FROM categorias WHERE id = :x";
            $stmt = $cone->prepare($sql);
            $stmt->bindParam(':x', $idcat, PDO::PARAM_INT);
            $stmt->execute();
    if ($idcat===false || $idcat <= 0 || $stmt->fetchColumn()==0){
        echo "<script>alert('Valor no válido para la categoría')</script>";
        echo "<script>window.location.href = 'adm_categorias.php';</script>";
        die();
    }
    
    if (isset($_POST['aceptar'])){
        $nombrecat=htmlspecialchars(trim(filter_input(INPUT_POST,'nombrecat')));
        if ($nombrecat==""){
            $errores['nombrecat']="Debes introducir un nombre";
        }
        if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
            $nombrearchivo= $_FILES['imagen']['name'];
            if ($_FILES['imagen']['type']!=="image/jpeg"){
                $errores['imagen']="La foto debe ser jpg";
            }
            if (!isset($errores['imagen'])){
                $foto="imgcategorias/".time()."-".$_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'],$foto);
            }
        } else{
            $errores['imagen']="Introduce una imagen";
        }
    
        if (!isset($errores)){
                try {
                    $sql="UPDATE categorias set nombre=:nom, imagen=:imagen where id=:x";
                    $stmt=$cone->prepare($sql);
                    if  ($stmt->execute([":nom"=>$_POST['nombrecat'], ":imagen"=>$foto, ":x"=>$idcat])){
                        if  ($stmt->rowCount()!=1){
                            $errores="Se ha producido un error al actualizar la categoría";
                        } else {
                            header("location:adm_categorias.php");
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
	<title>Modificar Categorias</title>
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
            color: black; /* Color del texto del encabezado */
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
                    <?php
                        try {
                            $sql="SELECT * from categorias where id=:x";
                            $stmt=$cone->prepare($sql);
                            if  ($stmt->execute([":x"=>$idcat])){
                                if  ($fila=$stmt->fetch()){
                    ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <label class="row">
									        <div class="col-1-3">
										        <div class="wrap-col">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" name="nombrecat" value="<?=$fila['nombre']?>"/>
                                                    <input type="hidden" name="idcat" value="<?=$idcat?>"/>
                                                    <?=isset($errores['nombrecat']) ? $errores['nombrecat'] : ''?><br>
										        </div>
									        </div>
									        <div class="col-2-3">
										        <div class="wrap-col">
                                                    <label for="imagen">Cambiar imagen</label>
											        <input type="file" name="imagen" id="">
                                                    <?=isset($errores['imagen']) ? $errores['imagen'] : ''?><br>
										        </div>
									        </div>
								        </label>
                                        <div class="t-center">
                                            <img width='300' height='300' src="<?=$fila['imagen']?>"/>
                                        </div>
                                        <div class="t-center">
                                            <input type="submit" class="button button-skin" name="aceptar" value="Aceptar"/>
                                        </div>
                                    </form>            
                    <?php
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