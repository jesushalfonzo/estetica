<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CITAS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; 

}

$idpaciente=$_POST["pacientecita"];
$duracion=$_POST["duracion"];
$tipo=$_POST["inlineRadioOptions"];
$comentarios=$_POST["comentarios"];
$fechacita=strtotime($_POST["fechacita"]);
$horaCita=strtotime($_POST["horaCita"]);
$horaCita=date("H:i:s", $horaCita);
$fechacita = date("Y-m-d", $fechacita);


$SQLCita="INSERT INTO m_consultas (m_consulta_id, m_consulta_idUsuario, m_consulta_fecha, m_consulta_tipo, m_consulta_estatus, m_consulta_duracion,m_consulta_hora, m_consulta_comentarios) VALUE (Null,'$idpaciente', '$fechacita', '$tipo', 'A', '$duracion', '$horaCita', '$comentarios')";

$queryguardar=mysqli_query($link, $SQLCita);
?>
<?php 

if ($queryguardar) { ?>

<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert">&times;</a> 
	<strong>Exitoso!</strong> La cita han sido agendada satisfactoriamente.
</div>

<?php } else { ?>
<div class="alert alert-error">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<strong>Error!</strong> Ha ocurrido un problema a la hora de guardar su Cita. 
	<?php }?>
