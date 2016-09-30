<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();

if (!control_access("CLIENTES", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }
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
            <div class="alert alert-danger alert-dismissable" style="display:none;" id="errores">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <div id="mensajeerror">  </div>    
         </div>
         <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <form role="form" method="post" enctype="multipart/form-data" id="FormularioPaciente" onSubmit="valida_envia();" name="formulario" action="ipaciente.php">

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Nombre del Paciente</label>
                                        <input name="nombrepaciente" id="nombrepaciente" class="form-control" placeholder="Apellidos y nombres">

                                    </div>
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="sexopaciente" id="sexopaciente" value="F" checked>Femenino
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="sexopaciente" id="sexopaciente" value="M">Masculino
                                            </label>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Cédula del Paciente</label>
                                        <input name="cedulapaciente" id="cedulapaciente" class="form-control" placeholder="Usar Sólo Números" onKeyPress="return justNumbers(event);">

                                    </div>

                                    <div class="form-group">
                                        <label>Fecha de Nacimiento</label>
                                        <div class='input-group date' id='datetimepicker10'>
                                            <input type='text' class="form-control" name="fnacimiento" id="fnacimiento"  placeholder="Ejemplo 2015-25-03"/>
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
                                        <label>Dirección</label>
                                        <textarea class="form-control" name="direccionpaciente" id="direccionpaciente" rows="3" placeholder="Dirección de habitación"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Número telefónico</label>
                                        <input class="form-control" name="telefonopaciente" id="telefonopaciente" placeholder="Usar Sólo Números" onKeyPress="return justNumbers(event);">
                                    </div>
                                    <div class="form-group">
                                        <label>Correo electrónico</label>
                                        <input class="form-control" name="emailpaciente" id="emailpaciente" placeholder="ejemplo@tucorreo.com">
                                    </div>


                                    
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h1>Información relacionada </h1>
                                    

                                    <div class="form-group">
                                        <label for="disabledSelect"><img src="../../images/LogoUsuario.png" width="170" height="169"></label>

                                    </div>
                                    <div class="form-group">
                                        <label>Seleccionar Foto</label>
                                        <input type="file" name="fotopaciente" id="fotopaciente">
                                    </div>




                                </div>
                                <!-- /.col-lg-6 (nested) -->


                            </div>
                            <div align="center" style="margin-top:10px;">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-danger" onClick="document.location.href='../index.php';">Cancelar</button>
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

</body>

</html>
