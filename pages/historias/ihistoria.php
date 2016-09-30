<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$id_paciente=$_GET["ckl"];

if (!control_access("HISTORIA", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }


$idPaciente=$_POST["idPaciente"];



//ANTECEDENTES FAMILIARES

if(!empty($_POST['antecedentes'])) {
	$Delete="DELETE r_antecedentes WHERE r_antecedentes_idPaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$aLista=array_keys($_POST['antecedentes']);
	foreach($aLista as $idAntecedente) {
		$sQuery="INSERT INTO r_antecedentes (r_antecedentes_id, r_antecedentes_idPaciente, r_antecedentes_idAntecedente, 	r_antecedentes_estatus)  VALUES (Null, '$idPaciente', '$idAntecedente', 'true')";
		$resultado=mysqli_query($link, $sQuery); 
	};
}

//DATOS CLÍNICOS

if(!empty($_POST['datocC'])) {
	$Delete="DELETE r_datosClinicos WHERE r_datosClinicos_idpaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$aLista=array_keys($_POST['datocC']);
	foreach($aLista as $idDatosC) {
		$sQuery="INSERT INTO r_datosClinicos (r_datosClinicos_id, r_datosClinicos_idpaciente, r_datosClinicos_idDatoC, r_datosClinicos_estatus)  VALUES (Null, '$idPaciente', '$idDatosC', 'true')";
		$resultado=mysqli_query($link, $sQuery); 
	};
}

 //HABITOS PSICOLÓGICOS

if(!empty($_POST['HabitosPs'])) {
	$Delete="DELETE r_habitosPsicologicos WHERE r_habitosPsicologicos_idPaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$aLista=array_keys($_POST['HabitosPs']);
	foreach($aLista as $idHabitosPs) {
		$sQuery="INSERT INTO r_habitosPsicologicos (r_habitosPsicologicos_id, r_habitosPsicologicos_idPaciente, r_habitosPsicologicos_idhabitoPsicologico, r_habitosPsicologicos_estatus, r_habitosPsicologicos_veces)  VALUES (Null, '$idPaciente', '$idHabitosPs', 'true', 0)";
		$resultado=mysqli_query($link, $sQuery); 
	};
}

 //ASPECTOS PSICOLÓGICOS

if(!empty($_POST['AspectosPs'])) {
	$Delete="DELETE r_aspectosPsicologicos WHERE r_aspectosPsicologicos_idPaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$aLista=array_keys($_POST['AspectosPs']);
	foreach($aLista as $idAspectPs) {
		$sQuery="INSERT INTO r_aspectosPsicologicos (r_aspectosPsicologicos_id, r_aspectosPsicologicos_idPaciente, r_aspectosPsicologicos_idAspecto, r_aspectosPsicologicos_estatus)  VALUES (Null, '$idPaciente', '$idAspectPs', 'true')";
		$resultado=mysqli_query($link, $sQuery); 
	};
}


//EXPLORACIÓN FISICA

if(!empty($_POST['grupExpFisica'])) {
	$Delete="DELETE r_exploracion_fisica WHERE r_exploracionFisica_idpaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$TipoCuerpo=$_POST['grupExpFisica'];
	$sQuery="INSERT INTO r_exploracion_fisica (r_exploracionFisica_id, r_exploracionFisica_idpaciente, r_exploracionFisica_idtipo, r_exploracionFisica_estatus)  VALUES (Null, '$idPaciente', '$TipoCuerpo', 'true')";
	$resultado=mysqli_query($link, $sQuery); 
}


//BIOTIPO


if(!empty($_POST['grupBiotipoRel'])) {
	$Delete="DELETE FROM r_biotipo_paciente WHERE r_biotipo_idPaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$Biotipo=$_POST['grupBiotipoRel'];
	$sQuery="INSERT INTO r_biotipo_paciente (r_biotipo_id, r_biotipo_idPaciente, r_biotipo_idBiotipo, r_biotipo_estatus)  VALUES (Null, '$idPaciente', '$Biotipo', 'true')";
	$resultado=mysqli_query($link, $sQuery); 
}

//TRATAMIENTOS Y RECOMENDACIONES


if(!empty($_POST['tipoTratamiento'])) {

	$Delete="DELETE FROM m_tratamiento WHERE m_tratamiento_idPaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$tipoTratamiento=$_POST["tipoTratamiento"];
	$contraindicaciones=$_POST["contraindicaciones"];
	$alteraciones=$_POST["alteraciones"];
	$pronostico=$_POST["pronostico"];

	$sQuery="INSERT INTO m_tratamiento (m_tratamiento_id, m_tratamiento_idPaciente, m_tratamiento_tipo, m_tratamiento_contraindicaciones, m_tratamiento_alteraciones, m_tratamiento_pronosticco)  VALUES (Null, '$idPaciente', '$tipoTratamiento', '$contraindicaciones', '$alteraciones', '$pronostico')";
	$resultado=mysqli_query($link, $sQuery); 
}


//ANTROPOMETRIA

if(!empty($_POST['antropos'])) {
	$Delete="DELETE FROM r_antopometria WHERE r_antopometria_idPaciente='$idPaciente'";
	$QueryDelete=mysqli_query($link, $Delete);
	$aLista=array_keys($_POST['antropos']);

	 $tot = count($_POST["antropos"]);
	 for ($i = 0; $i < $tot; $i++){
	 	$texto= $_POST["antropos"][$i];
		$CordenadaX= $_POST["x"][$i];
		$CordenadaY= $_POST["y"][$i];
		$sQuery="INSERT INTO r_antopometria (r_antopometria_id, r_antopometria_idPaciente, r_antopometria_cordenadaX, r_antopometria_cordenadaY, r_antopometria_texto)  VALUES (Null, '$idPaciente', '$CordenadaX', '$CordenadaY', '$texto')";
		$queryss=mysqli_query($link, $sQuery);

	}
	
}


//INESTICISMO

if(!empty($_POST['idInesticismo'])) {
	$Delete="DELETE FROM r_inesticismo WHERE r_inesticismo_idPaciente='$idPaciente'";
	$QueryDeleteInes=mysqli_query($link, $Delete);
	$aLista=array_keys($_POST['idInesticismo']);
	foreach($aLista as $iId) {
		$inesticismoDetalle=$_POST['inesticismoDetalle'][$iId];
		$sQuery="INSERT INTO r_inesticismo (r_inesticismo_id, r_inesticismo_idPaciente, r_inesticismo_idInesticismo, r_inesticismo_detalle)  VALUES (Null, '$idPaciente', '$iId', '$inesticismoDetalle')";
		$resultado=mysqli_query($link, $sQuery); 
	};
}


/*echo "<script language='JavaScript'>document.location.href='agregar.php?ckl=$idPaciente&ms=1';</script>";*/




?>

<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert">&times;</a> 
	<strong>Exitoso!</strong> Los datos han sido actualizados satisfactoriamente. 
</div>