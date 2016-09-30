<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$id_paciente=$_GET["ckl"];

if (!control_access("PAGOS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }


$idPaciente=$_POST["idpaciente"];
$conceptoPaquete=$_POST["conceptoPaquete"];
$valorPaquete=str_replace(',','',$_POST["valorPaquete"]);
$abono=str_replace(',','',$_POST["abono"]);

$SQL="INSERT INTO m_paquetes (m_paquete_id, m_paquete_idPaciente, m_paquete_concepto, m_paquete_valortotal, m_paquete_fecha) VALUES (Null, '$idPaciente', '$conceptoPaquete', '$valorPaquete', Now())";
$query=mysqli_query($link, $SQL);
$lastInsert=mysqli_insert_id($link);

if($abono!="0"){
	$SQLAbono="INSERT INTO m_paquete_abonos(m_paquete_abono_id, m_paquete_abono_idPaquete, 	m_paquete_abono_fecha,m_paquete_abono_cantidad) VALUES (Null, '$lastInsert', Now(), '$abono')";

	$queryAbono=mysqli_query($link, $SQLAbono);
}

if($query){

	?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>Exitoso!</strong> Los datos han sido actualizados satisfactoriamente.
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