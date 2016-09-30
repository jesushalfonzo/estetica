<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("PAGOS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }

?>

<?php
$idPaciente=$_GET["ckl"];
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
<script src="../../js/jquery.maskMoney.js" type="text/javascript"></script>


<h3 class="page-header" align="center">Registrar paquete / compromiso <span class="glyphicon glyphicon-euro"></span></h3>
<form class="form-horizontal" role="form" id="Formulario" name="formulario">
	<input type="hidden" name="idpaciente" value="<?=$idPaciente?>" />
	<div class="form-group" style="margin-left:20px;">
		<label class="control-label col-sm-2" for="email">Paciente:</label>
		<div class="col-sm-10">

			<?php 
			$SQLPacientes="SELECT * FROM m_pacientes WHERE m_paciente_id='$idPaciente'";
			$querypaciente=mysqli_query($link, $SQLPacientes);
			$rowpacientes=mysqli_fetch_array($querypaciente);
			$m_paciente_id=$rowpacientes["m_paciente_id"];
			$m_paciente_nombre=$rowpacientes["m_paciente_nombre"];

			?>

			<input type="text" class="form-control" value="<?=$m_paciente_nombre?>" style="width:80%" placeholder="Apellidos y nombres" readonly="true"></span>



			
		</div>
		
	</div>

	
	
	<div class="form-group" style="margin-left:20px;">
		<label class="control-label col-sm-2" for="pwd">Concepto: </label>
		<div class="col-sm-10"> 
			<input type="text" class="form-control" name="conceptoPaquete" style="width:80%" placeholder="Concepto del pago"></span>
		</div>
	</div>


<div class="container" style="width:80%;">
		<div class="row">
			<label class="control-label col-sm-2" for="pwd">Total: </label>
			<div class='col-sm-6'>
				<div class="form-group">
					<div class="input-group"> 
						<span class="input-group-addon">Bs</span>




						<input type="text" class="" id="valorPaquete" name="valorPaquete" placeholder="Ej: 10.000,00" class="input-group-addon" />
						<script type="text/javascript">$("#valorPaquete").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ''});</script>


					</div>
				</div>
			</div>

			
		</div>
		
	</div>
	
<div class="container" style="width:80%;">
		<div class="row">
			<label class="control-label col-sm-2" for="pwd">Abono: </label>
			<div class='col-sm-6'>
				<div class="form-group">
					<div class="input-group"> 
						<span class="input-group-addon">Bs</span>




						<input type="text" class="" id="abono" name="abono" placeholder="Ej: 10.000,00" class="input-group-addon" />
						<script type="text/javascript">$("#abono").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ''});</script>


					</div>
				</div>
			</div>

			
		</div>
		
	</div>

	<div class="form-group"> 
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" id="btn_enviar" class="btn btn-success">Guardar</button>
			<button class="btn btn-danger" data-dismiss="modal" id="btn_cerrar" aria-hidden="true">Cancelar</button>
		</div>
	</div>


</form>
<?php include("../footer.php"); ?>


<script>   
$(function(){
	$("#btn_enviar").click(function(){

		//var validado=valida_envia();
		//console.log(validado);
		//if (validado) {
			var formData = new FormData($("#Formulario")[0]);

			$.ajax({
				url: "ipaquete.php",
				type: 'POST',
				enctype: 'multipart/form-data',
				data: formData,
				async: false,
				success: function (data) {
					$($("#mensajes").html(data)).slideDown("slow");
					$('#btn_cerrar').click();
					setTimeout(function() { $(".alert").alert('close');}, 2000);
					setTimeout(function() { location.reload();}, 2000);
					//

				},
				cache: false,
				contentType: false,
				processData: false
			});
		//}

		return false;
	});
});



</script>
