<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Imprimiendo 1</title>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>


    <!-- Bootstrap Core CSS -->

    <!-- MetisMenu CSS -->
    <link href="http://localhost/ESTETICA/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="http://localhost/ESTETICA/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://localhost/ESTETICA/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="http://localhost/ESTETICA/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://localhost/ESTETICA/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="http://localhost/ESTETICA/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<script type="text/javascript" src="../../js/jquery.PrintArea.js"></script>

</head>

<body>

<h2>Imprimir una zona espec&iacute;fica con jQuery</h2>

<p><a href="javascript:void(0)" id="imprime">Imprime</a></p>

<div id="myPrintArea">
<strong><i>Zona que se imprimir&aacute;</i></strong>
</div>

<script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>

</body>
</html>