<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CITAS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; 

}
$idCita=$_POST["idCita"];
$idpaciente=$_POST["pacientecita"];
$duracion=$_POST["duracion"];
$tipo=$_POST["inlineRadioOptions"];
$fechacita=strtotime($_POST["fechacita"]);
$horaCita=strtotime($_POST["horaCita"]);
$horaCita=date("H:i:s", $horaCita);
$fechacita = date("Y-m-d", $fechacita);


$SQLCita="UPDATE m_consultas SET  m_consulta_idUsuario='$idpaciente', m_consulta_fecha='$fechacita', m_consulta_tipo='$tipo', m_consulta_estatus='A', m_consulta_duracion='$duracion',m_consulta_hora='$horaCita' WHERE m_consulta_id='$idCita'";

$queryguardar=mysqli_query($link, $SQLCita);
?>
<?php 

if ($queryguardar) { ?>
<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert">&times;</a> 
	<strong>Exitoso!</strong> La cita han sido actualizada satisfactoriamente.

<?php } else { ?>
<div class="alert alert-error">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<strong>Error!</strong> Ha ocurrido un problema a la hora de guardar su Cita. 
<?php }?>
