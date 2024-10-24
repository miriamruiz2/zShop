<?php 
session_start();
if (!isset($_SESSION['identificado'])){
	header("location:login.php");
	die();
}
include 'config.php';

if (isset($_POST['aceptar'])){
    $titulo=htmlspecialchars(trim(filter_input(INPUT_POST,'titulo')));
    if ($titulo==""){
        $errores['titulo']="Debes introducir un titulo";
    }
    $texto=htmlspecialchars(trim(filter_input(INPUT_POST,'texto')));
    if ($texto==""){
        $errores['titulo']="Debes introducir texto";
    }
    if (strlen($texto)>500){
        $errores['texto']="El texto debe ser más breve";
    }
    if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $nombrearchivo= $_FILES['imagen']['name'];
        if ($_FILES['imagen']['type']!=="image/png"){
            $errores['imagen']="La foto debe ser png";
        }
        if (!isset($errores['imagen'])){
            $foto="images/".time()."-".$_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'],$foto);
        }
    } else{
        $errores['imagen'] = "Introduce una imagen";
    }

    if (!isset($errores)){
            try {
                $sql="UPDATE indefinido set titulo=:titulo, texto=:texto, imagen=:imagen";
                $stmt=$cone->prepare($sql);
                if  ($stmt->execute([":titulo"=>$_POST['titulo'], ":texto"=>$_POST['texto'], ":imagen"=>$foto])){
                    if ($stmt->rowCount()!=1){
                        $errores="Se ha producido un error al actualizar la categoría";
                    } else{
                        header("location:adm_indefinido.php");
                    }
                }
            } catch (PDOException $e){
                die ("Error update".$e->getMessage());
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
	<title>Modificar Indefinido</title>
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
                    <?php
                        try {
                            $sql="SELECT * from indefinido";
                            $stmt=$cone->prepare($sql);
                            if  ($stmt->execute()){
                                if  ($fila=$stmt->fetch()){
                    ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <label class="row">
									        <div class="col-1-3">
										        <div class="wrap-col">
                                                    <label for="titulo">Título</label>
                                                    <input type="text" name="titulo" value="<?=$fila['titulo']?>"/>
                                                    <?=isset($errores['titulo']) ? $errores['titulo'] : ''?><br>
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
                                        <label class="row">
									        <div class="col-1-3">
										        <div class="wrap-col">
                                                    <label for="texto">Texto</label>
                                                    <textarea name="texto" id="" cols="30" rows="10"><?=$fila['texto']?></textarea>
                                                    <?=isset($errores['texto']) ? $errores['texto'] : ''?> <br>
                                                </div>
									        </div>
									        <div class="col-2-3">
										        <div class="wrap-col">
                                                    <img width='300' height='300' src="<?=$fila['imagen']?>"/>
										        </div>
									        </div>
								        </label> 
                                        <div class="t-center">
                                            <input type="submit" class="button button-skin" name="aceptar" value="Aceptar"/>
                                        </div>
                                    </form><br>            
                    <?php
                                }
                            }
                        } catch (PDOException $e){
                            die ("Error al conectar". $e->getMessage());
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
		</div>
	</footer> 
    </div>
</body>
</html>