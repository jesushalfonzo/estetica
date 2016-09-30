<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CLIENTES", 'ELIMINAR')) {  exit(0); }
?>
<?php
$idpaciente=$_GET["idpaciente"];
$SQL="DELETE FROM m_pacientes WHERE m_paciente_id='$idpaciente'";
$query=mysqli_query($link, $SQL);

if($query){
	echo"<div class='alert alert-success alert-dismissable' role='alert' data-dismiss='alert'><button type='button' class='close' aria-hidden='true'>&times;</button><strong>Exitoso</strong>, el paciente ha sido borrado</div>";
}
else{
	echo"<div class='alert alert-danger alert-dismissable' role='alert' data-dismiss='alert'><button type='button' class='close' aria-hidden='true'>&times;</button><strong>ERROR!</strong>, el paciente No ha sido borrado</div>";

}
?>