<?php
session_start();
ini_set('session.gc_maxlifetime',7200);
if (isset($_SESSION["RnVM4n3jAdor3s"])){$variable=$_SESSION["RnVM4n3jAdor3s"];}else{$variable="";}	
if ($variable == 'm4n3j4d0rRnV'){
	echo "<script language='JavaScript'>document.location.href='pages/index.php';</script>";
	exit();
} 
if (isset($_GET["ckl"])){$error=$_GET["ckl"]; }
if ($error!=""){ $display="block"; } else { $display="none";}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Estética en Alma y Cuerpo | Agenda | Login</title>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- -->
<script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
<script src="js/jquery.min.js"></script>
<script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
	  		$('.message').remove();
		});
	});	  
});
</script>
</head>
<body>
<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<h1><img src="images/LogoAgenda.png"></h1>
		 <div class="alert-close"> </div> 			
	</div>
		<form action="login.php" method="post" onSubmit="validar();">
			<li>
				<input type="text" class="text" name="login" value="Usuario" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Username';}"><a href="#" class=" icon user"></a>
			</li>
				<div class="clear"> </div>
			<li>
				<input type="password" value="Password" name="password" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Password';}"> <a href="#" class="icon lock"></a>
			</li>
			
			<div class="alert alert-warning alert-danger" style="display:<?=$display?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Error!</strong> La combinación Usuario/Password es incorrecta
</div>

			<div class="clear"> </div>
			<div class="submit">
				<input type="submit" onClick="myFunction()" value="Entrar" >
				<h4><a href="#">Olvidaste tú contraseña ?</a></h4>
						  <div class="clear">  </div>	
			</div>
				
		</form>
		</div>					
	</div>
	</div>
	<div class="clear"> </div>
<!--- footer --->
<div class="footer">
	<p>Desarrollado por <a href="#">Pixelado.com - @jesushalfonzo</a></p>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
