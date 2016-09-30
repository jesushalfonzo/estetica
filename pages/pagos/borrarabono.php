<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$idAbono=$_GET["idabono"];

if (!control_access("PAGOS", 'ELIMINAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }


$SQL="DELETE FROM m_paquete_abonos WHERE m_paquete_abono_id='$idAbono'";
$query=mysqli_query($link, $SQL);

if($query){
	?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>Exitoso!</strong> El abono ha sido eliminado
	</div>
	<?php
}
else{
	?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>Exitoso!</strong> Error al guardar los datos
	</div>

	<?php } ?>