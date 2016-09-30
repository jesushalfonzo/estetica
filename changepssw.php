
<?php session_start();?>
<?php include('logeo.php'); 
include('extras/conectar.php');
$link=Conectarse();
//Clean up the form submission
$username = (!empty($_POST['login']))?trim($_POST['login']):false;
$passwordactual = (!empty($_POST['passwordactual']))?trim($_POST['passwordactual']):false;
$passwordnuevo = (!empty($_POST['passwordNuevo']))?trim($_POST['passwordNuevo']):false;
$passwordrepetido = (!empty($_POST['passwordrepetidoPost']))?trim($_POST['passwordrepetidoPost']):false;;
if($passwordactual==""){
	$passwordactual==' ';
}
if($passwordnuevo!=$passwordrepetido){
	$verify=false;
	$jito="Las contrase&ntilde;as no coinciden";
}

else{
	$pass_ant_encp= md5($passwordactual);
	$pass_new_encp= md5($passwordnuevo);

	$sql= "SELECT m_usuario_id FROM m_usuario WHERE m_usuario_login='$username' and m_usuario_password ='$pass_ant_encp'";

	$result=mysqli_query($link, $sql);
	$num_rows= mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	$m_usuario_id=$row["m_usuario_id"];

	if ($num_rows==0 ){

		$verify=false;
		$jito="Contrase&ntilde;a actual incorrecta";
	}
	else{

		if (strlen($passwordnuevo)<5 )
		{
			$verify=false;
			$jito="La contrase&ntilde;a debe poseer mas de 5 car&aacute;cteres";
		}
		else {
			$insertar="UPDATE m_usuario SET  m_usuario_password='$pass_new_encp' WHERE m_usuario_id ='$m_usuario_id'"; 
			$resultado=mysqli_query($link,$insertar); 	
			$verify=true;
			$jito="Contraseña cambiada Exitosamente!";
		}

	}
}


if ($verify) {
	?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>Exitoso!</strong> Clave Cambiada
		<?php
	} else {


		?>
<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a> 
		<strong>ERROR!</strong> No se pudo cambiar la clave: <?=$jito?>
		<?php
	}

	?>

