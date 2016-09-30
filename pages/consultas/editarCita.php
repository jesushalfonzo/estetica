<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CITAS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; }

?>

<?php
$idCita=$_GET["id"];
$SQl="SELECT * FROM m_consultas WHERE m_consulta_id='$idCita'";
$query=mysqli_query($link, $SQl);
$row=mysqli_fetch_array($query);
$m_consulta_idUsuario=$row["m_consulta_idUsuario"];
$m_consulta_fecha=$row["m_consulta_fecha"];
$m_consulta_hora=$row["m_consulta_hora"];
$m_consulta_tipo=$row["m_consulta_tipo"];
$m_consulta_estatus=$row["m_consulta_estatus"];
$m_consulta_duracion=$row["m_consulta_duracion"];
$m_consulta_comentarios=$row["m_consulta_comentarios"];

?>

<script src="../../js/moment.min.js"></script>
<script src="../../js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap-datepicker3.css">
	<h3 class="page-header" align="center">Editar cita  para el día: <?=date("d-m-Y", strtotime($m_consulta_fecha));?>  <span class="glyphicon glyphicon-calendar"></span></h3>
	<form class="form-horizontal" role="form" id="Formulario">
	<input type="hidden" name="idCita" value="<?=$idCita?>" />
		<div class="form-group" style="margin-left:20px;">
			<label class="control-label col-sm-2" for="email">Paciente:</label>
			<div class="col-sm-10">
				<select class="form-control" name="pacientecita"  style="width:80%;">
					<option value="0">Seleccione</option>
					<?php 
					$SQLPacientes="select * FROM m_pacientes WHERE m_paciente_estatus='A'";
					$querypaciente=mysqli_query($link, $SQLPacientes);
					while ($rowpacientes=mysqli_fetch_array($querypaciente)) {
						$m_paciente_id=$rowpacientes["m_paciente_id"];
						$m_paciente_nombre=$rowpacientes["m_paciente_nombre"];

						?>

						<option value="<?=$m_paciente_id?>" <?php if ($m_paciente_id==$m_consulta_idUsuario) { echo "selected";} ?>><?=$m_paciente_nombre?></option>

						<?php  
					}

					?>


				</select>
			</div>
		</div>

<div class="container" style="width:80%;">
    <div class="row">
    <label class="control-label col-sm-2" for="pwd">Fecha: </label>
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='fechacalendar'>
                    <input type='text' class="form-control" value="<?=date("d/m/Y", strtotime($m_consulta_fecha));?>" name="fechacita"  />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {

            	$('#fechacalendar').datetimepicker({
                    format: 'D-MM-YYYY'
                });
             
            });
        </script>
    </div>
</div>

<div class="container" style="width:80%;">
    <div class="row">
    <label class="control-label col-sm-2" for="pwd">Hora: </label>
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" name="horaCita" value="<?=date("g:i:s-a-d/m/Y", strtotime($m_consulta_hora))?> " />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
    </div>
</div>
		<div class="form-group" style="margin-left:20px;">
			<label class="control-label col-sm-2" for="pwd">Duración: </label>
			<div class="col-sm-10"> 
				<select class="form-control" name="duracion"  style="width:80%;">
					<option value="30" <?php if ($m_consulta_duracion==30) { echo "selected";} ?>>1/2 Hora</option>
					<option value="60" <?php if ($m_consulta_duracion==60) { echo "selected";} ?>>1 Hora</option>
					<option value="90" <?php if ($m_consulta_duracion==90) { echo "selected";} ?>>1 1/2 Horas</option>
					<option value="120" <?php if ($m_consulta_duracion==120) { echo "selected";} ?>>2 Horas</option>
					<option value="150" <?php if ($m_consulta_duracion==150) { echo "selected";} ?>>2 1/2 Horas</option>
					<option value="180" <?php if ($m_consulta_duracion==180) { echo "selected";} ?>>3 Horas</option>
				</select>
			</div>
		</div>
		<div class="form-group" style="margin-left:20px;"> 
			<div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">

					<?php 
					$SQLServicios="SELECT * FROM m_servicios WHERE m_servicio_estatus=1";
					$queryServicios=mysqli_query($link, $SQLServicios);
					while ($rowServicios=mysqli_fetch_array($queryServicios)) {
						$m_servicio_id=$rowServicios["m_servicio_id"];
						$m_paciente_nombre=$rowServicios["m_servicio_nombre"];

						?>
						<label class="radio-inline">
							<input type="radio"  name="inlineRadioOptions" id="inlineRadio1" value="<?=$m_servicio_id?>" <?php if ($m_servicio_id==$m_consulta_tipo) { echo "checked='true'";}?> > <?=$m_paciente_nombre?>
						</label>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<div class="form-group" style="margin-left:20px;">
		<label class="control-label col-sm-2" for="pwd">Comentarios: </label>
		<div class="col-sm-10"> 
			<textarea id="textarea" class="form-control" style="width:80%;" name="comentarios"><?=$m_consulta_comentarios?></textarea>
		</div>
	</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" id="btn_enviar" class="btn btn-success">Guardar</button>
				<button class="btn btn-warning" data-dismiss="modal" id="btn_cerrar" aria-hidden="true">Salir</button>
				<button type="btn" id="btn_CancelaCita" data-id="<?=$idCita?>" class="btn btn-danger">Cancelar Cita</button>
			</div>
		</div>

		
	</form>
	<?php include("../footer.php"); ?>


<script>   
	$(function(){
		$("#btn_enviar").click(function(){
			var formData = new FormData($("#Formulario")[0]);
			$.ajax({
				url: "Upcita.php",
				type: 'POST',
				enctype: 'multipart/form-data',
				data: formData,
				async: false,
				success: function (data) {
					$($("#mensajes").html(data)).slideDown("slow");
					$('#btn_cerrar').click();
					location.reload();
				},
				cache: false,
				contentType: false,
				processData: false
			});
			return false;
		});
	});
</script>

<script>   
	$(function(){
		$("#btn_CancelaCita").click(function(){
			var idCitaCancel=$(this).data('id');
			var datax = 'id='+ idCitaCancel; 
			$.ajax({
				url: "calcelCita.php",
				type: 'GET',
				enctype: 'multipart/form-data',
				data: datax,
				async: false,
				success: function (data) {
					$('#btn_cerrar').click();
					$($("#mensajes").html(data)).slideDown("slow");
					setTimeout(function() { $(".alert").alert('close');}, 2000);
					setTimeout(function() { location.reload();}, 2000);
					
				},
				cache: false,
				contentType: false,
				processData: false
			});
			return false;
		});
	});
</script>
