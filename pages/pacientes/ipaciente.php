
<?php session_start();?>

<?php include('../../logeo.php'); 
include("../Common_head.php"); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CLIENTES", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }
header('Content-Type: text/html; charset=iso-8859-1');

$nombre_paciente=$_POST["nombrepaciente"];
$sexopaciente=$_POST["sexopaciente"];
$fnacimiento=date("Y-m-d", strtotime($_POST["fnacimiento"]));
$cedulapaciente=$_POST["cedulapaciente"];
$direccionpaciente=$_POST["direccionpaciente"];
$telefonopaciente=$_POST["telefonopaciente"];
$emailpaciente=$_POST["emailpaciente"];
$fotopaciente = $_FILES['fotopaciente']['name'];
$trozos = explode(".", $fotopaciente); 
$extension = end($trozos);  

$SQL="INSERT INTO m_pacientes (m_paciente_id, m_paciente_nombre, m_paciente_sexo, m_paciente_fechaNacimiento, m_paciente_direccion, m_paciente_cedula, m_paciente_telefono, m_paciente_correo, m_paciente_foto, m_paciente_estatus) VALUES (Null, '$nombre_paciente', '$sexopaciente', '$fnacimiento',  '$direccionpaciente', '$cedulapaciente', '$telefonopaciente', '$emailpaciente', '$fotopaciente', 'A')";
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
	$actualizar="UPDATE m_pacientes SET  m_paciente_foto='$nombre_new' WHERE m_paciente_id='$lastshit'"; 
	$resultado=mysqli_query($link,$actualizar); 
}

?>

<script type="text/javascript">

	function redirect(){
		document.location.href='listarpacientes.php';
	}
</script>

<?php 

if ($subiofoto && $queryguardar) { ?>
<script type="text/javascript">
	redirect();
</script>
<?php }?>