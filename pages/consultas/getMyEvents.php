<?php session_start();?>
<?php
$hoy=date("Y-m-d", time());
$SQL="SELECT m_consulta_idUsuario, m_consulta_id, m_consulta_fecha, m_consulta_tipo, m_consulta_fecha, m_consulta_duracion, m_paciente_nombre, m_paciente_id, m_servicio_nombre, m_consulta_hora FROM m_consultas, m_servicios, m_pacientes WHERE m_consultas.m_consulta_estatus='A' AND m_servicios.m_servicio_id=m_consultas.m_consulta_tipo AND m_pacientes.m_paciente_id=m_consultas.m_consulta_idUsuario AND m_consulta_fecha >='$hoy'";
$query=mysqli_query($link, $SQL);
$numero=mysqli_num_rows($query);
$i=0;
while ($row=mysqli_fetch_array($query)) {
	$m_consulta_idUsuario=$row["m_consulta_idUsuario"];
	$m_consulta_id=$row["m_consulta_id"];
	$m_consulta_fecha=$row["m_consulta_fecha"];
	$m_paciente_nombre=$row["m_paciente_nombre"];
	$m_servicio_nombre=$row["m_servicio_nombre"];
	$m_consulta_hora=$row["m_consulta_hora"];
 	$m_consulta_duracion=$row["m_consulta_duracion"]*60;
 	$horasumada=strtotime($m_consulta_hora)+$m_consulta_duracion;
	$horaFin=date("H:i:s",$horasumada);
	$exportJson.="{
		title: '$m_paciente_nombre',
		start: '".$m_consulta_fecha."T".$m_consulta_hora."',
		end: '".$m_consulta_fecha."T".$horaFin."', 
		url: 'javascript:editarCita($m_consulta_id);',

	}";
	$i++;
	if ($i<$numero) {
		$exportJson.=",";
	}


}
echo $exportJson;

?>