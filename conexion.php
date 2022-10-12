<?php 
$db_host = 'mysql:dbname=db_psicologo;host=localhost';
$usuario = 'root';
$clave= '';


try { 
  $cnnPDO = new PDO($db_host, $usuario, $clave);
} catch (PDOException $e) {
	
	echo "<div class ='alert alert-warning alert-dismissible fade show' role='alert'>
	<strong><h4>Ha surgido un error!</strong><br> datalle:<br>." . $e->getMessage()."
	</div>";

}

?>