<?php 
session_start();
if (!isset($_SESSION['identificado'])){
	header("location:login.php");
	die();
}
include 'config.php';

if (isset($_GET['idcat'])){
    $idcat=filter_input(INPUT_GET,'idcat',FILTER_VALIDATE_INT);
    if ($idcat===false || $idcat <= 0){
        echo "<script>alert('Valor no válido para la categoría')</script>";
        echo "<script>window.location.href = 'adm_categorias.php';</script>";
        die();
    } 

    if (isset($_GET['eliminar'])){
			try{
            	$sql="DELETE from categorias where id=:x";
            	$stmt=$cone->prepare($sql);
	            if ($stmt->execute([":x"=>$idcat])){
    	            if ($stmt->rowCount()!=1){
        	            $errores="Se ha producido un error al eliminar la categoría";
                	} else{
						header("location:adm_categorias.php");
					}
           		}
            } catch (PDOException $e){
                die ("Error al eliminar".$e->getMessage());
			} 
    }
}else {
    header("location:adm_categorias.php");
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
        table.tstyle td {
            color: black; /* Color del texto del encabezado */
		}
		.cat-img {
	    	position: absolute;
    		top: 50%;
 		    right: 80px;
		    transform: translateY(-50%);
			max-width: 100%; 
		    max-height: 100%;
		}
	</style>

    <title>Eliminar Categorías</title>
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
                        <?php
                            try{
                                $sql="SELECT * from categorias where id=:x";
                                $stmt=$cone->prepare($sql);
                                if ($stmt->execute([":x"=>$idcat])){
                                    if ($fila=$stmt->fetch()){
                        ?>          
                                        <form action="eliminar_cat.php">
                                            <label for="p">¿Deseas eliminar la categoría "<?=$fila['nombre']?>"?</label>
                                            <input type="hidden" name="idcat" value="<?=$idcat?>">
                                            <center><input type="submit" class="button button-skin" name="eliminar" value="Eliminar"/></center>
                                        </form><br><br>
										<img width='200' height='200' class="cat-img" src="<?=$fila['imagen']?>"/>

                                        <?=isset($errores) ? $errores:""?>
                                        <a href="adm_categorias.php">Cancelar</a>
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
				<div class="bottom-footer">
				</div>
			</div>
		</footer>
	</div>

        
</body>
</html>