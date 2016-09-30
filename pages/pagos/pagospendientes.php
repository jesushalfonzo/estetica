<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$id_paciente=$_GET["ckl"];

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


</head>

<body>
    <form role="form" method="post" enctype="multipart/form-data" id="FormularioPaciente"  name="FormularioPaciente">
        <input type="hidden" name="idPaciente" value="<?=$m_paciente_id?>">
        <div id="wrapper">
            <!-- Navigation -->
            <?php include("../topheader.php"); ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">

                        <h2 class="page-header">Historial de pagos Pendientes / Cuentas por cobrar</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>



                <div class="row">
                   

                  <div class="panel panel-default" style="background-color: #FBFBFC;">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>PAQUETES REGISTRADOS</label>

                                </div>
                                <div id="contenedor">
                                    <div id="contenidos">
                                      
                                        <div class="panel-body">
                                            <div class="list-group">

                                                <div class="col-lg-6" style="width:100%;">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                           Paquetes con pagos pendientes
                                                       </div>
                                                       <!-- /.panel-heading -->
                                                       <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Cliente</th>
                                                                        <th>Cantidad de paquetes pendientes</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                   <?php
                                                                   $SQL="SELECT * , COUNT( * ) AS CantidadPaquetes FROM m_paquetes, m_pacientes WHERE m_paquete_valortotal > ( SELECT SUM( m_paquete_abono_cantidad ) FROM m_paquete_abonos WHERE m_paquete_abono_idPaquete = m_paquete_id ) 
                                                                   AND m_paquete_idPaciente = m_paciente_id GROUP BY m_paquete_idPaciente";
                                                                   $query=mysqli_query($link, $SQL);
                                                                   $i=0;
                                                                   while ($row=mysqli_fetch_array($query)) {
                                                                    $m_paquete_id=$row["m_paquete_id"];
                                                                    $m_paquete_idPaciente=$row["m_paquete_idPaciente"];
                                                                    $m_paquete_concepto=$row["m_paquete_concepto"];
                                                                    $m_paquete_valortotal=$row["m_paquete_valortotal"];
                                                                    $m_paquete_fecha=$row["m_paquete_fecha"];
                                                                    $m_paciente_nombre=$row["m_paciente_nombre"];
                                                                    $m_paciente_telefono=$row["m_paciente_telefono"];
                                                                    $CantidadPaquetes=$row["CantidadPaquetes"];
                                                                    $i++;

                                                                    ?>
                                                                    <tr <?php if($status=="Pagado"){ echo "class='alert-success'"; }?> id="Caja<?=$m_paquete_id?>">
                                                                        <td><?=$i?></td>
                                                                        <td><?=$m_paciente_nombre?></td>
                                                                        <td><?=$CantidadPaquetes?></td>
                                                                        <td><span class="tooltip-demox"> <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Ver detalle" id="regPaquete" data-id="<?=$m_paciente_id?>"  onClick="document.location.href='../pagos/index.php?ckl=<?=$m_paquete_idPaciente?>';"><i class="fa fa-eye"></i></button> </span></td>
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
    <button type="reset" class="btn btn-primary" onClick="document.location.href='../pagos/index.php?ckl=<?=$m_paquete_idPaciente?>';">Volver</button>
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

    <script>
    // tooltip demo
    $('.tooltip-demox').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
    .popover()
    </script>