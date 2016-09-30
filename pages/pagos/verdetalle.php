<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("PAGOS", 'VER')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }

?>

<?php
$idPaquete=$_GET["ckl"];
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


<h3 class="page-header" align="center">Detalles de coutas <span class="glyphicon glyphicon-euro"></span></h3>
<!--<form class="form-horizontal" role="form" id="Formulario" name="formulario">-->
<div class="form-horizontal">
	<input type="hidden" name="idpaciente" value="<?=$idPaciente?>" />
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

	
	

	<div class="container" style="width:80%;">
		<div class="row">
			<label class="control-label col-sm-2" for="pwd">Fecha: </label>
			<div class='col-sm-6'>
				<div class="form-group">
					<div class="input-group"> 
						<input type="text" class="form-control" value="<?php echo date("d-m-Y", strtotime($m_paquete_fecha));?>" name="conceptoPaquete" style="width:80%" readonly="true"></span>

					</div>
				</div>
			</div>

			
		</div>
		
	</div>


	<div id="mensajesX"s></div>
	<div class="col-lg-6" style="width:100%">
		<div class="panel panel-default">
			<div class="panel-heading">
				Abonos Recibidos<span class="glyphicon glyphicon-sort-by-attributes-alt">
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Fecha Abono</th>
								<th>Cantidad</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$SqlAbonos="SELECT * FROM m_paquete_abonos WHERE m_paquete_abono_idPaquete ='$idPaquete' ORDER BY m_paquete_abono_fecha DESC";
							$queryAbonos=mysqli_query($link, $SqlAbonos);
							$i=0;
							while ($rowAbonos=mysqli_fetch_array($queryAbonos)) {
								$m_paquete_abono_id=$rowAbonos["m_paquete_abono_id"];
								$m_paquete_abono_fecha=$rowAbonos["m_paquete_abono_fecha"];
								$m_paquete_abono_cantidad=$rowAbonos["m_paquete_abono_cantidad"];
								$i++;
								?>

								<tr id="Caja<?=$m_paquete_abono_id?>">
									<td><?=$i?></td>
									<td><?php echo date("d-m-Y", strtotime($m_paquete_abono_fecha));?></td>
									<td><?php echo aBolivares($m_paquete_abono_cantidad);?></td>
									<td> <?php if (control_access("PAGOS", 'ELIMINAR')) { ?>
										<button type="button" class="btn btn-danger btn-xs btn-borrar" id="btn_borrar" data-id="<?=$m_paquete_abono_id?>" data-title="Seguro que desea Eliminar?" data-trigger="focus" data-on-confirm="deleteAbono" data-toggle="confirmation" data-btn-ok-label="Confirmar" data-btn-cancel-label="Cancelar!" data-placement="top" >
											<span class="glyphicon glyphicon-trash"></span>
											<span <i title="Eliminar abono"> </i>Eliminar</span>
										</button>
										<?php } ?></td>

									</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>

			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button class="btn btn-primary" data-dismiss="modal" id="btn_cerrar" aria-hidden="true">Salir</button>
				</div>
			</div>

		</div>
		<!--</form>-->
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
					//location.reload();

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
		<script>

		$('[data-toggle=confirmation]').confirmation();

		function deleteAbono(){
			var id = $(this).data('id');
			$.get("borrarabono.php", {idabono: id}, function(respuesta){
  			$($("#mensajesX").html(respuesta)).fadeIn( "slow" );
  			$( "#Caja"+id  ).slideUp();
  			setTimeout(function() { $(".alert").alert('close');}, 2000);
  })
		};
		$(".alert-dismissable").click(function (e) {
			$(this).fadeOut('slow');
		});
		</script>
		<?php
		function aBolivares( $monto ) {
			return(number_format( $monto, 2, ",", "." ) );
		}
		?>