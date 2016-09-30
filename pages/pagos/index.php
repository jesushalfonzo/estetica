<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$id_paciente=$_GET["ckl"];
$ref = $_SERVER['HTTP_REFERER'];
if (!control_access("PAGOS", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="../../bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
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
<style type="text/css">

.Table

{display: table;}

.Title

{
    display: table-caption;

    text-align: center;

    font-weight: bold;

    font-size: larger;
}

.Heading

{

    display: table-row;

    font-weight: bold;

    text-align: center;

}

.Row

{

    display: table-row;

}

.Cell

{

    display: table-cell;

    border: none;

    border-width: thin;

    padding-left: 5px;

    padding-right: 5px;

}

#contenedor {
    display: table;
    width: 780px;
    text-align: left;
    margin: 0;
}
#contenidos {
    display: table-row;
}
#columna1, #columna2, #columna3 {
    display: table-cell;
    border: 1px solid #EDEDED;
    vertical-align: middle;
    padding: 10px;
}
#columna4 {
    display: table-cell;
    border: 1px solid #EDEDED;
    vertical-align: middle;
    padding: 10px;
}

#check{
}
</style>
<style type="text/css">
#mensajes {
    background-color: none;
    border: 0px;
    border-radius: 8px 8px 8px 8px;
    float: center;
    position: fixed;
    min-height: 225px;
    margin-bottom: 10px;
    margin-right: 10px;
    overflow: hidden;
    text-align: center;
    width: 60%;
    z-index: 3;
}
</style>
<?php
$SQL="SELECT * FROM m_pacientes WHERE m_paciente_id='$id_paciente'";
$query=mysqli_query($link, $SQL);
$row=mysqli_fetch_array($query);
$m_paciente_id=$row["m_paciente_id"];
$m_paciente_nombre=$row["m_paciente_nombre"];
$m_paciente_sexo=$row["m_paciente_sexo"];
$m_paciente_direccion=$row["m_paciente_direccion"];
$m_paciente_cedula=$row["m_paciente_cedula"];
$m_paciente_telefono=$row["m_paciente_telefono"];
$m_paciente_correo=$row["m_paciente_correo"];
$m_paciente_foto=$row["m_paciente_foto"];
$m_paciente_fechaNacimiento=$row["m_paciente_fechaNacimiento"];
?>

</head>

<body>
    <form role="form" method="post" enctype="multipart/form-data" id="FormularioPaciente"  name="FormularioPaciente">
        <input type="hidden" name="idPaciente" value="<?=$m_paciente_id?>">
        <div id="wrapper">
            <!-- Navigation -->
            <?php include("../topheader.php"); ?>
            <div id="page-wrapper">
                <div id="mensajes"> </div>
                <div class="row">
                    <div class="col-lg-12">

                        <h2 class="page-header">Historial de pagos del paciente: <?=$m_paciente_nombre?></h2>
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

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="mensajes"> </div> 
                                    <div class="form-group">
                                        <label>Nombre del Paciente</label>
                                        <input name="nombrepaciente" id="nombrepaciente" class="form-control" value="<?=$m_paciente_nombre?>" placeholder="Apellidos y nombres" readonly="true">

                                    </div>




                                    <div class="Table">



                                        <div class="Row">

                                            <div class="Cell">


                                                <div class="form-group">
                                                    <label>Edad:</label>
                                                    <?=CalculaEdad($m_paciente_fechaNacimiento)?>

                                                </div>
                                            </div>

                                            <div class="Cell">

                                                <div class="form-group">
                                                    <label>Fecha de Nacimiento:</label>
                                                    <?=$m_paciente_fechaNacimiento?>

                                                </div>

                                            </div>

                                            <div class="Cell">

                                                <div class="form-group">
                                                    <label>Teléfono:</label>
                                                    <?=$m_paciente_telefono?>

                                                </div>
                                            </div>

                                            <div class="Cell">

                                                <div class="form-group">
                                                    <label>E-mail:</label>
                                                    <?=$m_paciente_correo?>

                                                </div>
                                            </div>

                                        </div>



                                    </div>




                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">


                                    <div class="form-group">
                                      <?php if($m_paciente_foto==""){
                                        $m_paciente_foto="../../images/LogoUsuario.png";
                                    }
                                    else{
                                        $m_paciente_foto="../../multimedia/fotos/".$m_paciente_foto;
                                    } 
                                    ?>
                                    <label for="disabledSelect" id="FotoCargada"><div id="polainas"><img src="<?php echo $m_paciente_foto; ?>" width="85" height="84" id="fotoPacienteFile" ></div></label>

                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                      </div> <!-- /.modal-content -->
                                  </div> <!-- /.modal-dialog -->
                              </div> <!-- /.modal -->

                          </div>
                          <!-- /.col-lg-6 (nested) -->


                      </div>

                      <!-- /.row (nested) -->
                  </div>
                  <!-- /.panel-body -->
              </div>

              <div class="panel panel-default" style="background-color: #FBFBFC;">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label>PAQUETES REGISTRADOS</label>

                            </div>
                            <div id="contenedor">
                                <div id="contenidos">
                                   <span class="tooltip-demo"> <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Registrar nuevo paquete" id="regPaquete" data-id="<?=$m_paciente_id?>"><img src="../../images/dollar135.png" /></button> </span>

                                    <div class="panel-body">
                                        <div class="list-group">

                                            <div class="col-lg-6" style="width:140%;">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                       Paquetes registrados
                                                   </div>
                                                   <!-- /.panel-heading -->
                                                   <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Concepto</th>
                                                                    <th>Estatus</th>
                                                                    <th>Valor total</th>
                                                                    <th>Cantidad abonada</th>
                                                                    <th>Cantidad restante</th>
                                                                    <th>Cantidad de abonos</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                               <?php
                                                               $SQLPaquetes="SELECT * FROM m_paquetes WHERE m_paquete_idPaciente='$m_paciente_id' ORDER BY m_paquete_fecha DESC ";
                                                               $queryPaquetes=mysqli_query($link, $SQLPaquetes);
                                                               while ($rowPaquetes=mysqli_fetch_array($queryPaquetes)) {
                                                                $m_paquete_id=$rowPaquetes["m_paquete_id"];
                                                                $m_paquete_idPaciente=$rowPaquetes["m_paquete_idPaciente"];
                                                                $m_paquete_concepto=$rowPaquetes["m_paquete_concepto"];
                                                                $m_paquete_valortotal=$rowPaquetes["m_paquete_valortotal"];
                                                                $m_paquete_fecha=$rowPaquetes["m_paquete_fecha"];


                                                                $SqlAbonos="SELECT SUM( m_paquete_abono_cantidad ) AS ABONO, COUNT(*) AS CantidadAbonos, m_paquete_abono_id, m_paquete_abono_fecha, m_paquete_abono_cantidad FROM m_paquete_abonos WHERE m_paquete_abono_idPaquete='$m_paquete_id' ORDER BY m_paquete_abono_id DESC";
                                                                $queryAbonos=mysqli_query($link, $SqlAbonos);
                                                                $rowAbonos=mysqli_fetch_array($queryAbonos);
                                                                $cantidadAbonada=$rowAbonos["ABONO"];
                                                                $cantidadAbonos=$rowAbonos["CantidadAbonos"];
                                                                $ultimoAbonoFecha=$rowAbonos["m_paquete_abono_fecha"];
                                                                $restante=aBolivares($m_paquete_valortotal-$cantidadAbonada);
                                                                if ($m_paquete_valortotal==$cantidadAbonada) {
                                                                    $status="Pagado";
                                                                }
                                                                else{

                                                                    $status="Pendiente";
                                                                }
                                                                ?>
                                                                <tr <?php if($status=="Pagado"){ echo "class='alert-success'"; }?> id="Caja<?=$m_paquete_id?>">
                                                                    <td><?=$m_paquete_concepto?></td>
                                                                    <td><?=$status?> <?php if($status=="Pagado"){ echo "<button type='button' class='btn btn-success btn-circle'><i class='fa fa-check'></i></button>"; } else { echo "<button type='button' class='btn btn-warning btn-circle'><i class='fa fa-clock-o'></i></button>";}?></td>
                                                                    <td><?php echo aBolivares($m_paquete_valortotal); ?></td>
                                                                    <td><?php echo aBolivares($cantidadAbonada);?></td>
                                                                    <td><?=$restante?></td>
                                                                    <td><?=$cantidadAbonos?></td>
                                                                    
                                                                    <td><?php if($status=="Pendiente"){ ?>
                                                                        <button type="button" id="regAbono" class="btn btn-success btn-circle regAbono" title="Abonar pago" data-idpaquete="<?=$m_paquete_id?>"><i class="fa fa-money"></i></button>
                                                                        <?php } ?> 
                                                                        <button type="button" class="btn btn-primary btn-circle alerta" title="Ver detalle" data-idpaquete="<?=$m_paquete_id?>" id="detalle"><i class="fa fa-list"></i></button> 
                                                                        <?php if (control_access("PAGOS", 'ELIMINAR')) { ?>
                                                                        <button type="button" class="btn btn-danger btn-circle" data-id="<?=$m_paquete_id?>" data-title="Seguro que desea Eliminar este paquete?" data-trigger="focus" data-on-confirm="deletePaquete" data-toggle="confirmation" data-btn-ok-label="Confirmar" data-btn-cancel-label="Cancelar!" data-placement="top"><i class="fa fa-times"></i></button> </td>
                                                                        <?php } ?> 

                                                                </tr>

                                                                <?php
                                                            } 

                                                            ?> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->
                                    </div>                             


                                </div>
                                <!-- /.list-group -->

                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <!-- /.col-lg-6 (nested) -->


        </div>

        <!-- /.row (nested) -->
    </div>






</div>
<!-- /.panel-body -->
</div>



<div class="panel panel-default">
   <div align="center" style="margin-top:10px;">
    <button type="reset" class="btn btn-primary" onClick="document.location.href='<?=$ref?>';">Volver</button>
</div>
</div>
</form>
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

<?php
function CalculaEdad($fechanacimiento){ 
    list($ano,$mes,$dia) = explode("-",$fechanacimiento); 
    $ano_diferencia = date("Y") - $ano; 
    $mes_diferencia = date("m") - $mes; 
    $dia_diferencia = date("d") - $dia; 
    if ($dia_diferencia < 0 || $mes_diferencia < 0) 
        $ano_diferencia--; 
    return $ano_diferencia; 
} 
?>

<script>
$(function(){

    //PARA REGISTRAR EL PAQUETE
    $('#regPaquete').click(function(){
      $('#myModal').removeData('bs.modal');
      $('#myModal').modal({remote: 'formularioPago.php?ckl=' + $(this).data("id") });


  });
//PARA VER TODOS LOS ABONOS
$('.alerta').click(function(){
    $('#myModal').removeData('bs.modal');
    $(".modal-content").html("");
    $('#myModal').modal({remote: 'verdetalle.php?ckl=' + $(this).data("idpaquete") });
});

    //PARA REALIZAR ABONO
    $('.regAbono').click(function(){
        $('#myModal').removeData('bs.modal');
        $(".modal-content").html("");
        $('#myModal').modal({remote: 'abonar.php?ckl=' + $(this).data("idpaquete") });
    });

});
</script>

<script>

        $('[data-toggle=confirmation]').confirmation();

        function deletePaquete(){
            var id = $(this).data('id');
            $.get("borrarPaquete.php", {idpaquete: id}, function(respuesta){
            $($("#mensajes").html(respuesta)).fadeIn( "slow" );
            $( "#Caja"+id  ).slideUp();
            setTimeout(function() { $(".alert").alert('close');}, 2000);
  })
        };
        $(".alert-dismissable").click(function (e) {
            $(this).fadeOut('slow');
        });
        </script>


<?php
function aBolivares( $monto ) {
 return(number_format( $monto, 2, ",", "." ) );
}
?>

 <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>