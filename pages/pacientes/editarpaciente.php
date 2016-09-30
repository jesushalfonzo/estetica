<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');

if (!control_access("CLIENTES", 'EDITAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }

$link=Conectarse();
$id_paciente=$_GET["idpaciente"];

$SQL="SELECT * FROM m_pacientes WHERE m_paciente_id='$id_paciente'";
$query=mysqli_query($link, $SQL);
$row=mysqli_fetch_array($query);
$m_paciente_id=$row["m_paciente_id"];
$m_paciente_nombre=$row["m_paciente_nombre"];
$m_paciente_sexo=$row["m_paciente_sexo"];
$m_paciente_fechaNacimiento=$row["m_paciente_fechaNacimiento"];
$m_paciente_direccion=$row["m_paciente_direccion"];
$m_paciente_cedula=$row["m_paciente_cedula"];
$m_paciente_telefono=$row["m_paciente_telefono"];
$m_paciente_correo=$row["m_paciente_correo"];
$m_paciente_foto=$row["m_paciente_foto"];
$int= rand(1262055681,1262055681);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("../Common_head.php"); ?>
    <script type="text/javascript">
    function justNumbers(e)
    {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;

        return /\d/.test(String.fromCharCode(keynum));
    }
    </script>
    <script type="text/javascript">
    <!--
    function valida_envia(){
    //valido el nombre
    validar=true;

    if (document.formulario.nombrepaciente.value.length==0){
       $("#errores").show();
       $("#mensajeerror").html( "<strong>Error!</strong> Debe ingresar el nombre del paciente" );
       document.formulario.nombrepaciente.focus()

       return false;
   } 

   if (document.formulario.cedulapaciente.value.length==0){
       $("#errores").show();
       $("#mensajeerror").html( "<strong>Error!</strong> Debe ingresar la cédula del paciente" );
       document.formulario.cedulapaciente.focus()

       return false;
   }  
   if (document.formulario.emailpaciente.value.length==0){
    $("#errores").show();
    $("#mensajeerror").html( "<strong>Error!</strong> Debe ingresar el correo electrónico del paciente" );
    document.formulario.emailpaciente.focus()
    
    return false;
} 
if (document.formulario.telefonopaciente.value.length==0){
   $("#errores").show();
   $("#mensajeerror").html( "<strong>Error!</strong> Debe ingresar el correo número telefónico del paciente" );
   document.formulario.telefonopaciente.focus()

   return false;
} 
return validar;


}

//-->
</script>
<script src="../../js/moment.min.js"></script>
<script src="../../js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap-datepicker3.css"></head>

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include("../topheader.php"); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">Registrar paciente en el sistema! </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div id="mensajes">  </div>    
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <form role="form" enctype="multipart/form-data"  name="formulario" id="formulario">

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label>Nombre del Paciente</label>
                                            <input name="pacienteid" type="hidden" value="<?php echo $m_paciente_id; ?>">
                                            <input name="nombrepaciente" id="nombrepaciente" class="form-control" placeholder="Apellidos y nombres" value="<?=$m_paciente_nombre?>">

                                        </div>
                                        <div class="form-group">
                                            <label>Sexo</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="sexopaciente" id="sexopaciente" value="F" <?php if($m_paciente_sexo=="F"){ ?> checked <?php } ?> >Femenino
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="sexopaciente" id="sexopaciente" value="M" <?php if($m_paciente_sexo=="M"){ ?> checked <?php } ?>>Masculino
                                                </label>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Fecha de Nacimiento</label>
                                            <div class='input-group date' id='datetimepicker10'>
                                                <input type='text' class="form-control" name="fnacimiento" id="fnacimiento" value="<?=$m_paciente_fechaNacimiento?>" placeholder="Ejemplo 2015-25-03"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar">
                                                    </span>
                                                </span>
                                            </div>

                                        </div>


                                        <script type="text/javascript">
                                        $(function () {


                                            $('#datetimepicker10').datetimepicker({
                                                viewMode: 'years',
                                                format: 'YYYY/MM/DD'
                                            });
                                        });
                                        </script>

                                        <div class="form-group">
                                            <label>Cédula de Paciente</label>
                                            <input name="cedulapaciente" id="cedulapaciente" class="form-control" placeholder="Usar Sólo Números" onKeyPress="return justNumbers(event);" value="<?php echo $m_paciente_cedula; ?>">

                                        </div>
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <textarea class="form-control" name="direccionpaciente" id="direccionpaciente" rows="3" placeholder="Dirección de habitación"><?php echo $m_paciente_direccion;  ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Número telefónico</label>
                                            <input class="form-control" name="telefonopaciente" id="telefonopaciente" placeholder="Usar Sólo Números" onKeyPress="return justNumbers(event);" value="<?php echo $m_paciente_telefono; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Correo electrónico</label>
                                            <input class="form-control" name="emailpaciente" id="emailpaciente" placeholder="ejemplo@tucorreo.com" value="<?php echo $m_paciente_correo; ?>">
                                        </div>



                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <h1>Información relacionada </h1>


                                        <div class="form-group">

                                            <?php if($m_paciente_foto==""){
                                                $m_paciente_foto="../../images/LogoUsuario.png";
                                            }
                                            else{
                                                $m_paciente_foto="../../multimedia/fotos/".$m_paciente_foto;
                                            } 
                                            ?>
                                            <label for="disabledSelect" id="FotoCargada"><div id="polainas"><img src="<?php echo $m_paciente_foto; ?>" width="170" height="169" id="fotoPacienteFile" ></div></label>

                                        </div>
                                        <div class="form-group">
                                            <label>Seleccionar Foto</label>
                                            <input type="file" name="fotopaciente" id="fotopaciente">
                                        </div>




                                    </div>
                                    <!-- /.col-lg-6 (nested) -->


                                </div>
                                <div align="center" style="margin-top:10px;">
                                    <button type="submit" class="btn btn-success" id="btn_enviar">Guardar</button>
                                    <button type="reset" class="btn btn-danger"  onClick="document.location.href='listarpacientes.php';">Cancelar</button>
                                    <button type="reset" class="btn btn-primary"  onClick="document.location.href='listarpacientes.php';">Salir</button>
                                </div>
                                <!-- /.row (nested) -->
                            </div></form>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php include("../footer.php"); ?>

        <script>   
        $(function(){
            $("#btn_enviar").click(function(){
                var formData = new FormData($("#formulario")[0]);
                var file = $('#fotopaciente').get(0).files[0];
                formData.append('file', file);

                $.ajax({
                    url: "updatePaciente.php",
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    data: formData,
                    async: false,
                    success: function (data) {
                        $($("#mensajes").html(data)).fadeIn( "slow" );
                        $("#FotoCargada").html("<img src='<?php echo $m_paciente_foto; ?>?ckl=<?=$int?>' width='170' height='169' id='fotoPacienteFile' border='0'>");
                        var $container = $("#polainas");
                        $container.load("<?php echo $m_paciente_foto; ?>?ckl=<?=$int?>");
                        setTimeout(function() { $(".alert").alert('close');}, 2000);
                        setTimeout(function() { document.location.href = 'listarpacientes.php';}, 2000);

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });


                return false;
            });
});



</script>

</body>

</html>
