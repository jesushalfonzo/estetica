<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$idpaquete=$_GET["idpaquete"];

if (!control_access("PAGOS", 'ELIMINAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }


$SQL="DELETE FROM m_paquetes WHERE m_paquete_id='$idpaquete'";
$query=mysqli_query($link, $SQL);
$query=true;

if($query){
	?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>Exitoso!</strong> El paquete ha sido eliminado
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