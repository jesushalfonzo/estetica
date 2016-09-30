<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$id_paciente=$_GET["ckl"];

if (!control_access("PAGOS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }


$idPaquete=$_POST["idPaquete"];
$abono=str_replace(',','',$_POST["abono"]);


if($abono!="0"){
	$SQLAbono="INSERT INTO m_paquete_abonos(m_paquete_abono_id, m_paquete_abono_idPaquete, 	m_paquete_abono_fecha,m_paquete_abono_cantidad) VALUES (Null, '$idPaquete', Now(), '$abono')";

	$queryAbono=mysqli_query($link, $SQLAbono);
}

if($queryAbono){

	?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>Exitoso!</strong> Abono agregado satisfacturiamente
	</div>
	<?php
}
else{
	echo "Error al guardar";

	?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>Exitoso!</strong> Error al guardar los datos
	</div>

	<?php } ?>