<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("PAGOS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }

?>

<?php
$idPaquete=$_GET["ckl"];
?>
<script type="text/javascript">
<!--
function valida_envia(){
    //valido el nombre
    var validar=true;
    if ((document.formulario.abono.value==0)  || (document.formulario.abono.value=="")){
    	$("#error").html( "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error!</strong> Debe ingresar una cantidad</div>" );
    	document.formulario.abono.focus();
    	setTimeout(function() { $(".alert").alert('close');}, 2000);
    	return false;
    	validar = false;
    } 

    return validar;
}



//-->
</script>
<script src="../../js/jquery.maskMoney.js" type="text/javascript"></script>


<h3 class="page-header" align="center">Agregar Abono a deuda<span class="glyphicon glyphicon-euro"></span></h3>
<form class="form-horizontal" role="form" id="Formulario" name="formulario">

	<input type="hidden" name="idPaquete" value="<?=$idPaquete?>" />
	<div class="form-group" style="margin-left:20px;">
		<label class="control-label col-sm-2" for="email">Concepto:</label>
		<div class="col-sm-10">

			<?php 
			$SQLPaquete="SELECT * FROM m_paquetes WHERE m_paquete_id='$idPaquete'";
			$querypaquete=mysqli_query($link, $SQLPaquete);
			$rowpaquete=mysqli_fetch_array($querypaquete);
			$m_paquete_concepto=$rowpaquete["m_paquete_concepto"];
			$m_paquete_valortotal=$rowpaquete["m_paquete_valortotal"];
			$m_paquete_fecha=$rowpaquete["m_paquete_fecha"];

			?>

			<input type="text" class="form-control" value="<?=$m_paquete_concepto?>" style="width:80%" readonly="true"></span>



			
		</div>
		
	</div>

	
	
<div id="error"></div>
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
			<button type="button" id="btn_enviar" class="btn btn-success">Abonar</button>
			<button class="btn btn-danger" data-dismiss="modal" id="btn_cerrar" aria-hidden="true">Cancelar</button>
		</div>
	</div>
</form>

<script>   
$(function(){
	$("#btn_enviar").click(function(){

		var validado=valida_envia();
		console.log(validado);
		if (validado) {
			var formData = new FormData($("#Formulario")[0]);

			$.ajax({
				url: "iabono.php",
				type: 'POST',
				enctype: 'multipart/form-data',
				data: formData,
				async: false,
				success: function (data) {
					$($("#mensajes").html(data)).slideDown("slow");
					$('#btn_cerrar').click();
					setTimeout(function() { $(".alert").alert('close');}, 2000);
					setTimeout(function() { location.reload();}, 2000);
					

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
