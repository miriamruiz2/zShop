<?php
session_start();
if (isset($_SESSION['identificado'])){
	header("location:backend.php");
	die();
}

include 'config.php';   

if (isset($_POST['aceptar'])){
    $login=htmlspecialchars(trim(filter_input(INPUT_POST,'login')));
    $pass=htmlspecialchars(trim(filter_input(INPUT_POST,'password')));

    try {
        $sql="SELECT nombre, password from usuarios where login = :login";
        $stmt=$cone->prepare($sql);
        if ($stmt->execute([":login"=>$login])){
            if ($fila=$stmt->fetch()){
                    if (password_verify($pass, $fila['password'])){
                        $_SESSION['identificado']=$fila['nombre'];
                        header("location:backend.php");
                        die();
                    } else{
                        $errores="Error de identificación (Contraseña incorrecta)";
                    }     
            } else{
                $errores="Error de identificación (Usuario no encontrado)";
            }
        } else{
            $errores="Error de identificación (Consulta no ejecutada)";
        }

    } catch (PDOException $e){
        die("Falló la conexión: " . $e->getMessage());
    } catch(Exception $e){
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Login</title>
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
		.btn-modificar {
    		background-color: #098F8E;
    		color: white;
  		}
		.btn-eliminar {
    		background-color: #f44336;
    		color: white;
  		}
	</style>
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
					<form action="login.php" method="post">
                    	<label for="login">Nombre de usuario:</label>
                        <input type="text" id="login" name="login" required>

                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>

                        <center><input type="submit" class="button button-skin" name="aceptar" value="Iniciar Sesión"/></center>
						<?=isset($errores) ? $errores : ""?>
					</form><br><br>  
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