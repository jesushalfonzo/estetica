<?php session_start();?>
<?php include('logeo.php'); 
include('extras/conectar.php');
$link=Conectarse();
$id_paciente=$_GET["ckl"];

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">






    <title>Cambiar Clave</title>
    <?php include("pages/Common_head.php"); ?>
    <script type="text/javascript">
    <!--
    function valida_envia(){
    //valido el nombre
    validar=true;
    if (document.formulario.passwordactual.value.length==0){
        $("#errores").show();
        $("#mensajes").html( "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a> <strong>Error!</strong> La clave no puede estar vacia</div>" );
        document.formulario.passwordactual.focus();
        setTimeout(function() { $(".alert").alert('close');}, 3000);

        return false;
    } 
 if (document.formulario.passwordNuevo.value.length==0){
        $("#errores").show();
        $("#mensajes").html( "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a> <strong>Error!</strong> La clave no puede estar vacia</div>" );
        document.formulario.passwordNuevo.focus();
        setTimeout(function() { $(".alert").alert('close');}, 3000);

        return false;
    } 
    if (document.formulario.passwordrepetidoPost.value.length==0){
        $("#errores").show();
        $("#mensajes").html( "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a> <strong>Error!</strong> Debe repetir la clave</div>" );
        document.formulario.passwordrepetidoPost.focus();
        setTimeout(function() { $(".alert").alert('close');}, 3000);

        return false;
    } 
    if (document.formulario.passwordNuevo.value != document.formulario.passwordrepetidoPost.value){
        $("#errores").show();
        $("#mensajes").html( "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a> <strong>Error!</strong> las claves no coinciden</div>" );
        document.formulario.password.focus();
        setTimeout(function() { $(".alert").alert('close');}, 3000);

        return false;
    } 

    
return validar;

}

//-->
</script>
<style type="text/css">
#mensajes {
    background-color: none;
    border: 0px;
    border-radius: 8px 8px 8px 8px;
    float: center;
    min-height: 20px;
    margin-bottom: 10px;
    margin-right: 10px;
    overflow: hidden;
    text-align: center;
    width: 100%;
    z-index: 1;
}
</style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">

                        <h3 class="panel-title">Cambiar Clave de acceso</h3>
                    </div>
                    <div class="panel-body">
                        <div id="errores"><div id="mensajes"></div></div>
                        <form role="form" name="formulario" action="changePassword.php" method="post" id="formulario">
                            <fieldset>
                                <input type="hidden" name="idUsuario" value="<?=$idusuario?>">
                                <div class="form-group">
                                    <input class="form-control" name="login"  readonly="yes" value="<?=$loginusuario?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password Actual" autofocus name="passwordactual" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nuevo Password"  name="passwordNuevo" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Repita el password" name="passwordrepetidoPost" type="password" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <button type="button" class="btn btn-primary" id="btn_enviar" onclick="valida_envia();">Cambiar Clave</button>
                                <button type="reset" class="btn btn-warning" onClick="document.location.href='pages/index.php';">Volver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("pages/footer.php"); ?>

    </body>

    </html>
    <script>   
    $(function(){
        $("#btn_enviar").click(function(){

            var validado=valida_envia();
        console.log(validado);
        if (validado) {
            var formData = new FormData($("#formulario")[0]);

            $.ajax({
                url: "changepssw.php",
                type: 'POST',
                enctype: 'multipart/form-data',
                data: formData,
                async: false,
                success: function (data) {
                    $($("#mensajes").html(data)).slideDown("slow");
                    $('#btn_cerrar').click();
                    setTimeout(function() { $(".alert").alert('close');}, 2000);
                    
                    //

                },
                
                cache: false,
                contentType: false,
                processData: false
            });
        }

        return false;
    });
    });



</script>