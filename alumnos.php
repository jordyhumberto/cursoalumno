<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
	header("Location: index.php");
}
$IDCO=$_GET['IDCO'];
$sqlM="SELECT mc.IDAlumno AS ida,mc.IDCarrera AS carrera,CONCAT(a.Nombres,' ',a.Apellido_paterno,' ',a.Apellido_materno) AS alumno,na.PPracticas AS practica,na.ExamenParcial AS parcial,na.ExamenFinal AS final,na.ExamenSusti AS susti,na.Promedio AS promedio,na.Estado AS estado FROM ((Tbl_notas_alumno AS na INNER JOIN Tbl_matricula_carrera AS mc ON na.IDMatricula=mc.IDMatricula)INNER JOIN Tbl_alumno AS a ON mc.IDAlumno=a.IDAlumno) WHERE na.IDCO='$IDCO'";
$resultadoM=$mysqli->query($sqlM) or trigger_error($mysqli->error);
?>
<html lang="en">
<head>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="universidad, peruana, investigación, investigacion, negocios, upein, UPEIN">
  	<meta name="description" content="UPEIN! - Universidad Peruana de Invesitgacion y Negocios da la bienvenida a sus nuevos estudiantes">
	<title>Upein</title>
    <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<link href="css/jquery.dataTables.min.css" rel="stylesheet">	
	<script src="js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Ultra" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<script>
		$(document).ready(function(){
			$('#mitabla').DataTable({
				"order": [[1, "asc"]],
				"language":{
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"info": "Mostrando pagina _PAGE_ de _PAGES_",
					"infoEmpty": "No hay registros disponibles",
					"infoFiltered": "(filtrada de _MAX_ registros)",
					"loadingRecords": "Cargando...",
					"processing":     "Procesando...",
					"search": "Buscar:",
					"zeroRecords":    "No se encontraron registros coincidentes",
					"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
					},					
				}
			});	
		});	
	</script>
</head>
</head>
<body>
<div class="cuerpo">
	<div class="logout">
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
	<br>
    <div class="row table-responsive">
        <table class="display" id="mitabla">
            <thead>
                <tr>
                    <th>IDAlumno</th>
					<th>Carrera</th>
                    <th>Alumno</th>
					<th>PPrac</th>
					<th>ExParc</th>
					<th>ExFin</th>
					<th>ExSus</th>
					<th>Prom</th>
					<th>Estado</th>
					<th>Ingresar</th>
                </tr>    
            </thead>
            <tbody>
            <?php while ($rowM=$resultadoM->fetch_array(MYSQLI_ASSOC)) {?>
                <tr>
                    <td><?php echo $rowM['ida']?></td>
					<td><?php echo $rowM['carrera']?></td>
                    <td><?php echo $rowM['alumno']?></td>
					<td><?php echo $rowM['practica']?></td>
					<td><?php echo $rowM['parcial']?></td>
					<td><?php echo $rowM['final']?></td>
					<td><?php echo $rowM['susti']?></td>
					<td><?php echo $rowM['promedio']?></td>
					<td><?php echo $rowM['estado']?></td>
                    <td><a href=""><span class="glyphicon glyphicon-book"></span></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>