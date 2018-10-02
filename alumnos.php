<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
	header("Location: index.php");
}
$IDCO=$_GET['IDCO'];
$Curso=$_GET['Curso'];
$Docente=$_GET['Docente'];
$sqlM="SELECT na.IDMatricula AS matricula,na.IDCO AS idco,mc.IDAlumno AS ida,mc.IDCarrera AS carrera,CONCAT(a.Nombres,' ',a.Apellido_paterno,' ',a.Apellido_materno) AS alumno,na.PPracticas AS practica,na.ExamenParcial AS parcial,na.ExamenFinal AS final,na.ExamenSusti AS susti,na.Promedio AS promedio,na.Estado AS estado FROM ((Tbl_notas_alumno AS na INNER JOIN Tbl_matricula_carrera AS mc ON na.IDMatricula=mc.IDMatricula)INNER JOIN Tbl_alumno AS a ON mc.IDAlumno=a.IDAlumno) WHERE na.IDCO='$IDCO'";
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
	<!-- <link rel="stylesheet" href="css/estilos.css"> -->
	<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Ultra" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<!-- <script src="librerias/jquery-3.2.1.min.js"></script> -->
	<script src="librerias/alertifyjs/alertify.js"></script>
  	<script src="librerias/select2/js/select2.js"></script>
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
	<h3><?php echo $Curso?></h3>
	<h4><?php echo $Docente?></h4>
	<div style="display:flex;justify-content: flex-end;">
        <a href="cursos.php" class="btn btn-primary">Regresar</a>
    </div>
	<br>
    <div class="row table-responsive">
        <table class="display" id="mitabla" style="font-size:1vw;">
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
            <?php while ($rowM=$resultadoM->fetch_array(MYSQLI_ASSOC)) {
				$datos=	$rowM['matricula']."||".
						$rowM['idco']."||".
						$rowM['ida']."||".
						$rowM['carrera']."||".
						$rowM['alumno']."||".
						$rowM['practica']."||".
						$rowM['parcial']."||".
						$rowM['final']."||".
						$rowM['susti']."||".
						$rowM['promedio']."||".
						$rowM['estado'];
			?>
                <tr>
                    <td><?php echo $rowM['ida']?></td>
					<td><?php echo $rowM['carrera']?></td>
                    <td><?php echo $rowM['alumno']?></td>
					<td><?php echo $rowM['practica']?></td>
					<td><?php echo $rowM['parcial']?></td>
					<td><?php echo $rowM['final']?></td>
					<td><?php echo $rowM['susti']?></td>
					<td><?php echo $rowM['promedio']?></td>
					<td><?php if($rowM['estado']=='01'){echo "<span class='glyphicon glyphicon-ok'></span";}else{echo "<span class='glyphicon glyphicon-remove'></span";}?></td>
                    <td><button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"></button></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Modal para edicion de datos -->
<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content">
    		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Actualizar notas</h4>
      		</div>
			<div class="modal-body">
				<input type="text" hidden="" id="matricula" name="matricula">
				<input type="text" hidden="" id="cursooperativo" name="cursooperativo">  
				<label>Nombre</label>
				<input type="text" name="" id="nombre" class="form-control input-sm" readonly>
				<label>PPracticas</label>
				<input type="number" name="practica" id="practica" class="form-control input-sm" step="any">
				<label>EParcial</label>
				<input type="number" name="parcial" id="parcial" class="form-control input-sm" step="any">
				<label>EFinal</label>
				<input type="number" name="final" id="final" class="form-control input-sm" step="any">
				<label>ESustitutorio</label>
				<input type="number" name="susti" id="susti" class="form-control input-sm" step="any">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
			</div>
    	</div>
	</div>
</div>
<script type="text/javascript">
	function agregaform(datos){
		d=datos.split('||');
		$('#matricula').val(d[0]);
		$('#cursooperativo').val(d[1]);
		$('#nombre').val(d[4]);
		$('#practica').val(d[5]);
		$('#parcial').val(d[6]);
		$('#final').val(d[7]);
		$('#susti').val(d[8]);
	}
	function actualizaDatos(){
		matricula=$('#matricula').val();
		cursooperativo=$('#cursooperativo').val();
		practica=$('#practica').val();
		parcial=$('#parcial').val();
		final=$('#final').val();
		susti=$('#susti').val();
		cadena= "matricula=" + matricula +
				"&cursooperativo=" + cursooperativo + 
				"&practica=" + practica +
				"&parcial=" + parcial +
				"&final=" + final +
				"&susti=" + susti;
		$.ajax({
			type:"POST",
			url:"actualizaDatos.php",
			data:cadena,
			success:function(r){
				if(r==1){
					alert("Actualizado con exito :)");
					location.reload(true);
				}else{
					alert("Fallo el servidor :(");
				}
			}
		});
	}
	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#actualizadatos').click(function(){
			actualizaDatos();
		});
	});
</script>
</body>
</html>