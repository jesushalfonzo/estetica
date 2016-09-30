<?php

//PARA EL MANEJO CENTRALIZADO DE LA VALIDACION DE PERMISOS

function TienePermisos($seccion, $accion){
$permitir=false;
$permisos=$_SESSION["R0l3sp3rM1s0s"];
@$consulta=$permisos[$seccion][$accion];
if ($consulta=="SI"){
$permitir=true;
}
else{
$permitir=false;
}
return $permitir;

}

?>