<?php
//requiere la conexion
require_once 'conexion.php';

//trae datos del formulario
$nombrea=$_POST['nombrea'];
$correoe=$_POST['correoe'];
$comentario=$_POST['comentario'];


    //valida que el usuario hizo click en el boton
    if (isset($_POST['envrespuesta']))
    {

    
//inser datos en una tabla de la db
    $sql=$cnnPDO->prepare("INSERT INTO blog
        (nombrea, correoe, comentario) VALUES
        (:nombrea, :correoe, :comentario)");

    //asignar las variables a los campos de la tabla
    $sql->bindParam(':nombrea',$nombrea);
    $sql->bindParam(':correoe',$correoe);
    $sql->bindParam(':comentario',$comentario);

    //Ejecutar la variable $sql
    $sql->execute();
    unset($sql);
    unset($cnnPDO);

     //datos para el correo

    header ("location:blog.php");
}
?>
