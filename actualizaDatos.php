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
    if ($final>$parcial) {
        if ($susti>$parcial) {
            $promedio=($practica+$final+$susti)/3;
        }else{
            $promedio=($practica+$parcial+$final)/3;
        }
    }else{
        if ($susti>$final) {
            $promedio=($practica+$parcial+$susti)/3;
        }else{
            $promedio=($practica+$parcial+$final)/3;
        }
    }
    if ($promedio>=10.5) {
        $estado="01";
    }else{
        $estado="02";
    }
    $sql="UPDATE Tbl_notas_alumno SET PPracticas='$practica', ExamenParcial='$parcial', ExamenFinal='$final', ExamenSusti='$susti',Promedio='$promedio',Estado='$estado' WHERE IDMatricula='$matricula' AND IDCO='$cursooperativo'";
    echo $result=$mysqli->query($sql) or trigger_error($mysqli->error);
 ?>