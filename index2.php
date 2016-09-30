<?php include('logeo.php'); 
include('extras/conectar.php');
$link=Conectarse();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"  />
<title>teleSUR - Sistema actualización CRAWL</title>
<link rel="stylesheet" type="text/css" media="all" href="APP/estilos.css" />
<style type="text/css">
<!--
.Estilo3 {
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
	font-weight: bold;
	font-size: 12px;
}
-->
</style>
</head><body>
<table border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="1024"><img src="images/Crawl.jpg" width="1024" height="200" border="0" /></td>
  </tr>
  
    <tr>
    <td><div class="texto_Gris" align="left" style="margin-right:10px; margin-bottom:5px; margin-top:5px; float:left;"><iframe src="hora.php" scrolling="no" frameborder="0" width="225" height="20"></iframe></div><div class="texto_Gris" align="right" style="margin-right:10px; margin-bottom:5px; margin-top:5px; float:right;"><a href="estadisticas.php"></a>Usuario:  <span class="Numeros_rojo"><? echo $nombre_completo; ?></span> / <a href="cerrar.php" style="text-decoration:none;"> Cerrar sesión</a></div></td>
  </tr>
    <tr>
    <td>
      <div align="right">
        <table width="1024" border="0" cellpadding="0" cellspacing="0" class="bordetabla">
		<tr><td width="226" valign="top">&nbsp;</td>
		</tr>
          <tr><td valign="top" colspan="2"><table cellpadding="0" cellspacing="0" border="0"><tr>
            <td width="392" valign="top" align="right"><div class="Estilo1">
            <div align="center" style="margin-bottom:10px; margin-top:8px; text-align:right; margin-right:10px;">Modo de Actualización 
              actual: </div>
            </div></td>
          <td width="625" valign="top" align="left">
		  <?php 
		  
		  $estado="SELECT * FROM control_actualizacion WHERE control_actualizacion_id='1'";
		  $queryestado=mysql_query($estado, $link);
		  $row=mysql_fetch_array($queryestado);
		  $estadoactual=$row["control_actualizacion_tipo"];
		  if($estadoactual=="AUTOMATICA"){
		  $estadoactualPrint="AUTOMÁTICA";
		  $imagencilla=strtolower($estadoactual);
		  }
		  else{
		  $estadoactualPrint="MANUAL";
		  $imagencilla=strtolower($estadoactual);
		  }
		  $nombre ='CRAWL.txt';
		   ?>
		  
		  <div style="margin-top:5px; margin-left:10px; font-family:Arial, Helvetica, sans-serif;"><img src="images/<?php echo $imagencilla.".png"; ?>" width="30" height="30" align="absmiddle" />   <?php echo $estadoactualPrint; ?></div><?


?> </td>
          </tr></table></td></tr>
		  
		  <tr><td valign="top" colspan="2"><div class="Estilo1">
            <div align="center" style="margin-bottom:10px; margin-top:8px; width:700px; margin-left:162px; background-color: #2981E4; height:10px;">&nbsp;</div>
            </div></td>
          </tr>
		  <tr><td valign="middle"><div class="Estilo1">
            <div align="right" style="margin-bottom:10px; margin-top:8px; margin-right:15px;">Titulares <br />
              cargados: </div>
            </div></td>
			<td width="796" valign="top" align="left">
			
			<?php 
$archivo = file_get_contents("TXT/CRAWL.txt"); //Guardamos archivo.txt en $archivo
$separar=explode("|", $archivo);
$total= count($separar);

#ejemplode.com
$j=1;
for ($i=0; $i < $total; $i++){
?>
			<div style="margin-bottom:10px; font-size:11px;" class="texto_Gris"><?php echo $j; ?> - <?php echo trim($separar[$i]); ?></div>
			
			<?php $j++; } ?>			</td>
          </tr>
		  
		  <tr><td valign="top" colspan="2"><div class="Estilo1">
            <div align="center" style="margin-bottom:10px; margin-top:8px; width:700px; margin-left:162px; background-color: #2981E4; height:10px;">&nbsp;</div>
            </div></td>
          </tr>
		  <tr><td valign="top" colspan="2"><div align="right" class="Estilo3" style="margin-bottom:10px; margin-top:8px; width:700px; margin-left:162px;"><?php  echo actualizacion($nombre); ?></div>
            </td>
          </tr>
		  <tr><td valign="top" colspan="2" align="center">
		  <?php if($estadoactual=="AUTOMATICA"){ ?>
		  <div style="margin-bottom:30px; margin-top:30px;"><a href="APP/index.php" class="medium button blue"> Actualizar manualmente </a></div>
		  <?php } else { ?>
		  <table cellpadding="0" cellspacing="0" border="0"><tr><td valign="top"> <div style="margin-bottom:30px; margin-top:30px;"><a href="APP/index.php" class="medium button blue"> Editar </a></div></td><td valign="top">&nbsp;</td><td valign="top"><div style="margin-bottom:30px; margin-top:30px;"><a href="APP/generarCrawl.php" class="medium button blue"> Actualizar Automáticamente </a></div></td></tr></table>
		  
		  
		  <?php } ?>
		  </td></tr>
        </table>
      </div></td>
  </tr>
  
  <tr><td valign="top"><div style="height:10px;">&nbsp;</div></td></tr>
     <tr>
    <td><div class="pie">                      
    			La Nueva Televisión del Sur C.A. (TVSUR) TeleSUR &copy; | Todo el contenido de esta página es exclusivo para el uso interno del canal. RIF. G-20004500-0 
    		</div></td>
  </tr>
</table>

</body>
</html>
<?php 

function actualizacion($nombre){
$archivo = "TXT/".$nombre;
$actual = date("d/m/Y - H:i:s",filemtime($archivo));
return 'Ultima actualización del archivo CRAWL.txt: '.$actual;
}
?>
