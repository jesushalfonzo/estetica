
<?php session_start();?>

<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
header('Content-Type: text/html; charset=iso-8859-1');
$pacienteid=$_POST["pacienteid"];
$nombre_paciente=addslashes(htmlspecialchars($_POST["nombrepaciente"]));
$sexopaciente=$_POST["sexopaciente"];
$cedulapaciente=$_POST["cedulapaciente"];
$fnacimiento=$_POST["fnacimiento"];
$direccionpaciente=addslashes(htmlspecialchars($_POST["direccionpaciente"]));
$telefonopaciente=$_POST["telefonopaciente"];
$emailpaciente=$_POST["emailpaciente"];
$fotopaciente = $_FILES['fotopaciente']['name'];
$trozos = explode(".", $fotopaciente); 
$extension = end($trozos);  


$SQL="UPDATE m_pacientes SET m_paciente_nombre='$nombre_paciente',  m_paciente_sexo='$sexopaciente', m_paciente_fechaNacimiento='$fnacimiento',   m_paciente_direccion='$direccionpaciente', m_paciente_cedula='$cedulapaciente', m_paciente_telefono='$telefonopaciente', m_paciente_correo='$emailpaciente' WHERE m_paciente_id = '$pacienteid'";



$resultado=mysqli_query($link,$SQL);

if($resultado){
	$queryguardar=true;
}
else {
	$queryguardar=false;

}

$lastshit=mysqli_insert_id($link);
if ($fotopaciente!='')
{
	$carpeta = '../../multimedia/fotos/';
	$nombre_new = 'PACIENTE'.'_'.$cedulapaciente.'.'.$extension;
	$nombre_temporal = 'temporal.jpg';
	
	if (move_uploaded_file($_FILES['fotopaciente']['tmp_name'],$carpeta.$nombre_temporal)){
		$subiofoto=true;
	}else{
		$subiofoto=false;
	}
	
	rename($carpeta.$nombre_temporal, $carpeta.$nombre_new); 
	chmod($carpeta.$nombre_new, 0644);
	$actualizar="UPDATE m_pacientes SET  m_paciente_foto='$nombre_new' WHERE m_paciente_id='$pacienteid'"; 
	$resultado=mysqli_query($link,$actualizar); 
}

?>


<?php 

if ($queryguardar) { ?>

<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert">&times;</a> 
	<strong>Exitoso!</strong> Los datos han sido actualizados satisfactoriamente.
</div>

<?php } else { ?>
<div class="alert alert-error">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<strong>Error!</strong> Ha ocurrido un problema a la hora de guardar su contenido.
</div>
<?php }?>