<?php session_start();?>
<?php include('../logeo.php'); 
include('../extras/conectar.php');
$link=Conectarse();
?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php include("Common_head.php"); ?>
 <script language="JavaScript" type="text/javascript">
 function show5(){
    if (!document.layers&&!document.all&&!document.getElementById)
        return

    var Digital=new Date()
    var hours=Digital.getHours()
    var minutes=Digital.getMinutes()
    var seconds=Digital.getSeconds()

    var dn="PM"
    if (hours<12)
        dn="AM"
    if (hours>12)
        hours=hours-12
    if (hours==0)
        hours=12

    if (minutes<=9)
       minutes="0"+minutes
   if (seconds<=9)
       seconds="0"+seconds
        //change font size here to your desire
        myclock="<font size='2' face='Arial' ><b><font size='1'></font>"+hours+":"+minutes+":"
        +seconds+" "+dn+"</b></font>"
        if (document.layers){
            document.layers.liveclock.document.write(myclock)
            document.layers.liveclock.document.close()
        }
        else if (document.all)
            liveclock.innerHTML=myclock
        else if (document.getElementById)
            document.getElementById("liveclock").innerHTML=myclock
        setTimeout("show5()",1000)
    }


    window.onload=show5
         //-->
         </script>


         <script type="text/javascript">
         $(document).ready(function() {
                //$("#galeria-fotos").load("galeria.html",{valor1:'1', valor2:'2'}, function(response, status, xhr) {
                  if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#galeria-fotos").html(msg + xhr.status + " " + xhr.statusText);
                }
            });

     });         
</script>

<style type="text/css">
#galeria-fotos {
 position: relative;
 padding-bottom: 56.25%;
 overflow: hidden;
}
#galeria-fotos iframe
{
    position: absolute;
    display: block;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

</style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("topheader.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inicio</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa  fa-clock-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo date("d/m/Y", time());?></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" ></span>
                                <span class="pull-right" id="liveclock"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-calendar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $hoy=date("Y-m-d", time());
                                    $SQL="SELECT m_consulta_idUsuario, m_consulta_id, m_consulta_fecha, m_consulta_tipo, m_consulta_fecha, m_consulta_duracion, m_paciente_nombre, m_paciente_id, m_servicio_nombre, m_consulta_hora FROM m_consultas, m_servicios, m_pacientes WHERE m_consultas.m_consulta_estatus='A' AND m_servicios.m_servicio_id=m_consultas.m_consulta_tipo AND m_pacientes.m_paciente_id=m_consultas.m_consulta_idUsuario AND m_consulta_fecha ='$hoy'";
                                    $query=mysqli_query($link, $SQL);
                                    $numero=mysqli_num_rows($query);
                                    ?>
                                    <div class="huge"><?=$numero?></div>
                                    <div>Total citas para hoy!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><a href="consultas/index.php">Ver Detalle</a></span>
                                <span class="pull-right"><a href="consultas/index.php"><i class="fa fa-arrow-circle-right"></i></a></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-database fa-5x"></i>
                                </div>
                                <?php
                                
                                $SQLPac="SELECT * FROM m_pacientes WHERE m_paciente_estatus ='A'";
                                $queryPac=mysqli_query($link, $SQLPac);
                                $numeroPacientes=mysqli_num_rows($queryPac);
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$numeroPacientes?></div>
                                    <div>Clientes registrados</div>
                                </div>
                            </div>
                        </div>

                        

                        <a href="pacientes/listarpacientes.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalle</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                
                                $SQLPaquetes="SELECT COUNT( * ) AS CantidadPaquetes FROM m_paquetes WHERE m_paquete_valortotal > ( SELECT SUM( m_paquete_abono_cantidad ) FROM m_paquete_abonos WHERE m_paquete_abono_idPaquete = m_paquete_id )";
                                $QueryPaquetes=mysqli_query($link, $SQLPaquetes);
                                $rowPaquetes=mysqli_fetch_array($QueryPaquetes);
                                $NumPaquetes=$rowPaquetes["CantidadPaquetes"];
                                ?>

                                    <div class="huge"><?=$NumPaquetes?></div>
                                    <div> Pendientes por pago</div>
                                </div>
                            </div>
                        </div>
                        <a href="pagos/pagospendientes.php.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalle</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">

             <div id="galeria-fotos">
                <iframe width="640" height="360" src="galeria.html" frameborder="0" scrolling="no" allowfullscreen></iframe>

            </div>
            <!-- /#wrapper -->

            <?php include("footer.php"); ?>
            <script src="<?=$serveractual?>/bower_components/raphael/raphael-min.js"></script>
            <script src="<?=$serveractual?>/bower_components/morrisjs/morris.min.js"></script>
            <script src="<?=$serveractual?>/js/morris-data.js"></script>
        </body>

        </html>
