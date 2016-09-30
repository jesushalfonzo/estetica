<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$idcordenada=$_GET["idCordenada"];

if (!control_access("HISTORIA", 'ELIMINAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }


$SQL="DELETE FROM r_antopometria WHERE r_antopometria_id='$idcordenada'";
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