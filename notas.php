<?php
    session_start(); //Inicia una nueva sesión o reanuda la existente
    require 'conexion.php'; //Agregamos el script de Conexión
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
    $IDCO=$_GET['IDCO'];
    $IDMatriula=$_GET['IDMatricula'];
    $Curso=$_GET['Curso'];
    $Docente=$_GET['Docente'];
    $sql="UPDATE Tbl_notas_alumno SET "

?>
