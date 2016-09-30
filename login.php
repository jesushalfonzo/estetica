<?php session_start();?>
<?php
error_reporting(E_ALL);
include('extras/conectar.php');
$link=Conectarse();
$fechacompleta=date('Y-m-d H:i:s');	
$login=$_POST["login"];
$password=$_POST["password"];
$nombre_completo="";
$m_roles_id="";
$usuario_id="";
if($password!=""){
	$passwordEncrip=md5($password); 
}

if($password==""){
	$passwordEncrip=md5(''); 
}
$ipcliente=getRealIP($_SERVER['REMOTE_ADDR']);

//PARA VERIFICAR SI ESTA ENTRE LA LISTA DE LOS PERMITIDOS

 $SQLValidar="SELECT * FROM m_usuario, m_grupo, m_permiso WHERE  m_usuario_login='".mysqli_real_escape_string($link,$login)."' AND m_usuario_password= '".mysqli_real_escape_string($link,$passwordEncrip)."' and m_usuario_status='A' LIMIT 0,1";



$queryvalidar=mysqli_query($link, $SQLValidar);


$permitido=mysqli_num_rows($queryvalidar);
$resultado=mysqli_fetch_array($queryvalidar);
$m_grupo_id=$resultado["m_grupo_id"];
$nombre_usuario=$resultado["m_usuario_nombre"];
$apellido_usuario=$resultado["m_usuario_apellido"];
$usuario_id=$resultado["m_usuario_id"];
$nombre_completo=utf8_encode($nombre_usuario." ".$apellido_usuario);

/*if($permitido==0){ echo "<script language='JavaScript'>document.location.href='index.php?ckl=NO';</script>"; exit(0); }*/

//FIN



if ($permitido >0){
   ini_set('session.gc_maxlifetime',7200);   
   $_SESSION["RnVM4n3jAdor3s"]= 'm4n3j4d0rRnV';
   $_SESSION['usuarioL0g3ad0']=$login;
   $_SESSION['nombreUSUcmpleto']=$nombre_completo;
   $_SESSION["1dusuar10"]=$usuario_id;
   
   $SQLBitacora="INSERT INTO bitacora_acceso VALUES (Null, '$login', 'ACCESO PERMITIDO', '$ipcliente', '$fechacompleta')";
   $query=mysqli_query($link, $SQLBitacora);

   $SQL_Permisos="SELECT m_seccion.m_seccion_id, m_seccion.m_seccion_nombre, m_acciones.m_acciones_nombre, m_acciones.m_acciones_id, m_permiso_status
   FROM m_seccion, m_acciones, m_permiso
   WHERE m_permiso.m_grupo_id = '$m_grupo_id'
   AND m_seccion.m_seccion_id = m_permiso.m_seccion_id
   AND m_permiso.m_accion_id = m_acciones.m_acciones_id
   ORDER BY m_seccion_id ASC";

   $query_permisos=mysqli_query($link, $SQL_Permisos);

   while($row_permisos=mysqli_fetch_array($query_permisos)){
      $m_seccion_id=$row_permisos["m_seccion_id"];
      $m_seccion_nombre=strtoupper($row_permisos["m_seccion_nombre"]);
      $m_acciones_nombre=strtoupper($row_permisos["m_acciones_nombre"]);
      $m_acciones_id=$row_permisos["m_acciones_id"];
      $m_permiso_status=strtoupper($row_permisos["m_permiso_status"]);

      $permisos[$m_seccion_nombre][$m_acciones_nombre]=$m_permiso_status;

   }
   $_SESSION["R0l3sp3rM1s0s"]=$permisos;
   
    echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>";
}

else {
   $SQLBitacora="INSERT INTO bitacora_accesos VALUES (Null, '$login', '$fechacompleta', '$ipcliente', 'ACCESO DENEGADO')";
   $query=mysqli_query($link, $SQLBitacora);
  echo "<script language='JavaScript'>document.location.href='index.php?ckl=NO';</script>";
}





function getRealIP()
{
  if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){$obtener=$_SERVER["HTTP_X_FORWARDED_FOR"];}else{$obtener="";}
  if($obtener != '')
  {
   $client_ip = 
   ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
   $_SERVER['REMOTE_ADDR'] 
   : 
   ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
      $_ENV['REMOTE_ADDR'] 
      : 
      "unknown" );

   $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);

   reset($entries);
   while (list(, $entry) = each($entries)) 
   {
      $entry = trim($entry);
      if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
      {
         $private_ip = array(
            '/^0\./', 
            '/^127\.0\.0\.1/', 
            '/^192\.168\..*/', 
            '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
            '/^10\..*/');

         $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

         if ($client_ip != $found_ip)
         {
            $client_ip = $found_ip;
            break;
         }
      }
   }
}
else
{
   $client_ip = 
   ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
   $_SERVER['REMOTE_ADDR'] 
   : 
   ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
      $_ENV['REMOTE_ADDR'] 
      : 
      "unknown" );
}

return $client_ip;

}

?>
