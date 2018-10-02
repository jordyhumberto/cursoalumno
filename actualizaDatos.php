<?php 
	session_start(); //Inicia una nueva sesión o reanuda la existente
    require 'conexion.php'; //Agregamos el script de Conexión
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
	$matricula=$_POST['matricula'];
	$cursooperativo=$_POST['cursooperativo'];
	$practica=$_POST['practica'];
	$parcial=$_POST['parcial'];
	$final=$_POST['final'];
    $susti=$_POST['susti'];
    $sql="UPDATE Tbl_notas_alumno SET PPracticas='$practica', ExamenParcial='$parcial', ExamenFinal='$final', ExamenSusti='$susti' WHERE IDMatricula='$matricula' AND IDCO='$cursooperativo'";
    echo $result=$mysqli->query($sql) or trigger_error($mysqli->error);
 ?>