<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CITAS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; }

?>

<?php
$fechaCita=$_GET["date"];
?>
<script type="text/javascript">
	<!--
	function valida_envia(){
    //valido el nombre
    var validar=true;
    if (document.formulario.pacientecita.value==0){
    	$("#errorPaciente").html( "<strong> Indique Paciente</strong>" );
    	document.formulario.pacientecita.focus();
    	return false;
    	validar = false;
    } 
    if (document.formulario.horaCita.value.length==0){
    	$("#errorHora").html( "<strong> Debe indicar la hora</strong>" );
    	document.formulario.horaCita.focus();
    	return false;
    	validar = false;
    } 

    return validar;
}

//-->
</script>
<script src="../../js/moment.min.js"></script>
<script src="../../js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap-datepicker3.css">
<h3 class="page-header" align="center">Agendar cita para el día: <?=$fechaCita?>  <span class="glyphicon glyphicon-calendar"></span></h3>
<form class="form-horizontal" role="form" id="Formulario" name="formulario">
	<input type="hidden" name="fechacita" value="<?=$fechaCita?>" />
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

					<option value="<?=$m_paciente_id?>"><?=$m_paciente_nombre?></option>

					<?php  
				}

				?>


			</select>
			
		</div>
		
	</div>

	<div class="container" style="width:80%;">
		<div class="row">
			<label class="control-label col-sm-2" for="pwd">Hora: </label>
			<div class='col-sm-6'>
				<div class="form-group">
					<div class='input-group date' id='datetimepicker3'>
						<input type='text' class="form-control" name="horaCita" />
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-time"></span>
						</span>
					</div>
					<div id="errorHora"></div>
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
				<option value="30">1/2 Hora</option>
				<option value="60">1 Hora</option>
				<option value="90">1 1/2 Horas</option>
				<option value="120">2 Horas</option>
				<option value="150">2 1/2 Horas</option>
				<option value="180">3 Horas</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="margin-left:20px;"> 
		<label class="control-label col-sm-2" for="pwd">Servicio: </label>
		<div class="col-sm-10">
			<div class="checkbox" style="padding-top:2px; padding-bottom:10px;">

				<?php 
				$SQLServicios="SELECT * FROM m_servicios WHERE m_servicio_estatus=1";
				$queryServicios=mysqli_query($link, $SQLServicios);
				$ij=0;
				while ($rowServicios=mysqli_fetch_array($queryServicios)) {
					$m_servicio_id=$rowServicios["m_servicio_id"];
					$m_paciente_nombre=$rowServicios["m_servicio_nombre"];
					$ij++;
					?>
					<label class="radio-inline">
						<input type="radio" name="inlineRadioOptions" <?php if($ij==1){ echo "checked='yes'";} ?> id="inlineRadio1" value="<?=$m_servicio_id?>"> <?=$m_paciente_nombre?>
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
			<textarea id="textarea" class="form-control" style="width:80%;" name="comentarios"></textarea>
		</div>
	</div>





	<div class="form-group"> 
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" id="btn_enviar" class="btn btn-success">Agendar Cita</button>
			<button class="btn btn-warning" data-dismiss="modal" id="btn_cerrar" aria-hidden="true">Cancelar</button>
		</div>
	</div>


</form>
<?php include("../footer.php"); ?>


<script>   
	$(function(){
		$("#btn_enviar").click(function(){

			var validado=valida_envia();
			console.log(validado);
			if (validado) {
				var formData = new FormData($("#Formulario")[0]);

				$.ajax({
					url: "icita.php",
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
			}

			return false;
		});
	});



</script>
