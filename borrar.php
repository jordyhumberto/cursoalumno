<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
    header("Location: index.php");
}
$IDMatricula=$_GET['IDMatricula'];
$IDCO=$_GET['IDCO'];
$IDCarrera=$_GET['IDCarrera'];
$Nombre=$_GET['Nombre'];
$sqlB="DELETE FROM Tbl_notas_alumno WHERE IDMatricula='$IDMatricula' AND IDCO='$IDCO'";
$resultadoB=$mysqli->query($sqlB) or trigger_error($mysqli->error);
$sqlA="DELETE FROM Tbl_cursos_alumno WHERE IDMatricula='$IDMatricula' AND IDCO='$IDCO'";
$resultadoA=$mysqli->query($sqlA) or trigger_error($mysqli->error);
header("Location: cursos.php?IDMatricula=$IDMatricula&IDCarrera=$IDCarrera&Nombre=$Nombre");
?>
