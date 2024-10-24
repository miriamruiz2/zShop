<?php 
$dsn="mysql:dbname=nombre_base_datos;host=localhost";
$usuario="tu_usuario";
$contrasena="tu_contraseña";

try{
	$cone = new PDO($dsn,$usuario,$contrasena);
} catch (PDOException $e){
	die("Falló la conexión: " . $e->getMessage());
}
?>
