<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CITAS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; 

}
$idCita=$_GET["id"];
$SqlCancel="UPDATE m_consultas SET m_consulta_estatus='C' WHERE m_consulta_id='$idCita'";
$query=mysqli_query($link, $SqlCancel);



if ($query) {

 ?>

<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert">&times;</a> 
	<strong>Exitoso!</strong> La cita han sido cancelada correctamente.
</div>

<?php } else { ?>
<div class="alert alert-error">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<strong>Error!</strong> Ha ocurrido un problema
<?php }?>
