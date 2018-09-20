<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
	header("Location: index.php");
}
$sqlM="SELECT m.IDMatricula AS idm,m.IDAlumno AS ida,CONCAT(a.Nombres,' ',a.Apellido_paterno,' ',a.Apellido_materno) AS nombre,s.Descripcion AS semestre,m.IDCarrera AS carrera FROM ((Tbl_matricula_carrera AS m INNER JOIN Tbl_alumno AS a ON m.IDAlumno=a.IDAlumno)INNER JOIN Tbl_semestre AS s ON m.IDSemestre=s.IDSemestre) WHERE s.IDSemestre=79 OR s.IDSemestre=80";
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
                    <th>Matricula</th>
                    <th>IDAlumno</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
                    <th>cursos</th>
                </tr>    
            </thead>
            <tbody>
            <?php while ($rowM=$resultadoM->fetch_array(MYSQLI_ASSOC)) {?>
                <tr>
                    <td><?php echo $rowM['idm']?></td>
                    <td><?php echo $rowM['ida']?></td>
                    <td><?php echo $rowM['nombre']?></td>
                    <td><?php echo $rowM['semestre']?></td>
                    <td><a href="cursos.php?IDMatricula=<?php echo $rowM['idm'];?>&IDCarrera=<?php echo $rowM['carrera'];?>&Nombre=<?php echo $rowM['nombre']; ?>"><span class="glyphicon glyphicon-book"></span></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>