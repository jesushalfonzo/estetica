<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$idPaciente=$_GET["id"];

if (!control_access("HISTORIA", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html version="xhtml 1.1" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.w3.org/MarkUp/SCHEMA/xhtml11.xsd">
<head>
	<title>Documento XHTML básico</title>
	<script src="../../js/jquery.min.js"></script>
	<script type="text/javascript">
	
	function simulate(){
		$("#serialize").click();
	}
	function deleteCordenada(idCordenada){
		console.log(idCordenada);
		var el = document.getElementById(idCordenada);
		el.remove();

	}
	</script>
</head>
<body>
	<a href="#" id="serialize" class="super button" style="display:none"><span>Serialize!</span></a>
	<a href="#" id="doItHansel" class="super button" style="display:none"><span>ff!</span></a>
	<div id="nutmeg">
		<img src="../../images/ANTROPOMETRIA_3.jpg">
		

	</div>

</body>
</html>
<script src="../../js/jquery.annotate.js"></script>

<style type="text/css">
body {
	margin: 0;
}
span.note.black {
	background-position: -150px 0;
}

span.note {
	display: block;
	position: absolute;
	top: -2px;
	left: 0;
	z-index: 10;
	background: url(../../images/notes-bg.png) no-repeat 0 0;
	/*background-color: black;*/
	width: 25px;
	font-family: arial;
	color: black;
	height: 25px;
	font-size: 12px;
	font-weight: bold;
	line-height: 25px;
	letter-spacing: -1px;
	text-align: center;
	color: #fff;
	text-decoration: none;
	text-shadow: 0 1px 1px rgba(0,0,0,.15);
}

span.note, span.set-label, span.wrap {
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
}
</style>

<?php
$SQL="SELECT * FROM r_antopometria WHERE r_antopometria_idPaciente='$idPaciente'";
$query=mysqli_query($link, $SQL);
$num=mysqli_num_rows($query);

if ($num!=0){
	$init=$num;
} else {
	$init=0;
}

?>
<script>
var i = <?=$init?>;
$(document).ready(function(){
	j=0;
	function blackNote() {
		
		var shit = $(document.createElement('span')).addClass('black circle note');
		i=i+1;
		idces="contenido"+i;
		shit.attr("id",idces);
		shit.text(i); 
		//$("#serialize").click();
		window.parent.craerCampos(i);
		
		return shit
	}


	$('#nutmeg span.note').seralizeAnnotations();


	$('#nutmeg').annotatableImage(blackNote);

	$('#nutmeg img').load(function(){
		$('#nutmeg').addAnnotations(function(annotation){
			var elemento= $(document.createElement('span')).addClass('black circle note').html(annotation.position);
			j=j+1;
			idcorde="contenido"+j;
			elemento.attr("id",idcorde);
			return elemento;
		},[
		<?php
		$i=0;
		while ($row=mysqli_fetch_array($query)) {
			$r_antopometria_cordenadaX=$row["r_antopometria_cordenadaX"];
			$r_antopometria_cordenadaY=$row["r_antopometria_cordenadaY"];
			$i++;

			?>
			{x: <?=$r_antopometria_cordenadaX?>, y: <?=$r_antopometria_cordenadaY?>, position: <?=$i?>}<?php if($i<$num){ echo","; } ?> 


			<?php

		}

		?>

		]
		);
	});

	$('#labeledNutmeg').annotatableImage(function(annotation){
		return $(document.createElement('span')).
		addClass('set-label');
	}, {xPosition: 'left'});

	$('#serialize').click(function(event){
		event.preventDefault();
			//$('#serializedOutput ul').empty();
			$.each($('#nutmeg span.note').seralizeAnnotations(), function(){
				//$('#serializedOutput ul').append($(document.createElement('li')).html('<strong>x:</strong> ' + this.x + ' <strong>y:</strong> ' + this.y + ' <strong>response_time:</strong> ' + this.response_time + 'ms'));
				window.parent.asignarCordenadas(this.x, this.y);
				//alert(this.x + " - "+this.y);
			});

		});

	$('#doItHansel').click(function(event){
		event.preventDefault();
		$('#nutmeg').addAnnotations(blackNote, $('#nutmeg span.note').seralizeAnnotations());
	});
});
</script>