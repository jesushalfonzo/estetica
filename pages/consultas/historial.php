
<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CLIENTES", 'VER')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; }
$pacienteid=$_GET["paciente"];
?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php include("../Common_head.php"); ?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("../topheader.php"); ?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <?php 
                    $SQLpaciente="SELECT * FROM m_pacientes WHERE m_paciente_id='$pacienteid'";
                    $queryPaciente=mysqli_query($link, $SQLpaciente);
                    $rowpaciente=mysqli_fetch_array($queryPaciente);
                    $m_paciente_nombre=$rowpaciente["m_paciente_nombre"];
                    ?>
                    <h1 class="page-header">Historial de citas del paciente <?=$m_paciente_nombre?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Datos encontrados
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Fecha de la cita</th>
                                            <th>Hora</th>
                                            <th>Duración</th>
                                            <th>Tipo de tratamiento</th>
                                            <th>Observaciones</th>
                                             <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php 
                                        $hoy=date("Y-m-d", time());
                                        $SQL="SELECT m_consulta_idUsuario, m_paciente_id , m_consulta_id, m_consulta_fecha, m_consulta_tipo, m_consulta_duracion, m_servicio_nombre, m_consulta_hora, m_consulta_estatus, m_consulta_comentarios FROM m_consultas, m_servicios, m_pacientes WHERE  m_consultas.m_consulta_idUsuario='$pacienteid' AND m_pacientes.m_paciente_id =  '$pacienteid' AND m_servicio_id=m_consulta_tipo ORDER BY m_consulta_fecha DESC";
                                        $query=mysqli_query($link, $SQL);
                                        $numero=mysqli_num_rows($query);
                                        $fechahoy=date("Y-m-d H:i:s", time());
                                        while ($row=mysqli_fetch_array($query)) {
                                            $m_consulta_idUsuario=$row["m_consulta_idUsuario"];
                                            $m_consulta_id=$row["m_consulta_id"];
                                            $m_consulta_fecha=$row["m_consulta_fecha"];
                                            $m_servicio_nombre=$row["m_servicio_nombre"];
                                            $m_consulta_estatus=$row["m_consulta_estatus"];
                                            $m_consulta_comentarios=$row["m_consulta_comentarios"];
                                            $m_consulta_hora=strtotime($row["m_consulta_hora"]);
                                            $m_consulta_hora=date('H:i A', $m_consulta_hora);
                                            $m_consulta_duracion=$row["m_consulta_duracion"];
                                            $horasumada=strtotime($m_consulta_hora)+$m_consulta_duracion;
                                            $horaFin=date("H:i:s",$horasumada);

                                            $fechaCita=$m_consulta_fecha." ".$m_consulta_hora;
                                            $fechaFinCita=$m_consulta_fecha." ".$horaFin;
                                            if ($fechaCita>=$fechahoy) {
                                                $clase="warning";
                                                $estatus="Pendiente";
                                                
                                            }
                                            else{
                                               $clase="success";
                                               $estatus="Realizada" ;
                                            }
                                        
                                            if ($m_consulta_estatus=="C") {
                                                $clase="danger"; 
                                                $estatus="Cancelada";
                                            }

                                            ?>
                                            <tr class="odd gradeX <?=$clase?>">
                                                <td><?=$m_consulta_fecha?></td>
                                                <td><?=$m_consulta_hora?></td>
                                                <td><?=$m_consulta_duracion?> minutos</td>
                                                <td class="center"><?=$m_servicio_nombre?></td>
                                                <td class="center"><?=$m_consulta_comentarios?></td>
                                                <td><?=$estatus?></td>
                                                
                                            </tr>

                                            <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
<div class="panel panel-default">
         <div align="center" style="margin-top:10px;">
            <button type="reset" class="btn btn-info" onClick="document.location.href='../pacientes/listarpacientes.php';">Volver</button>
        </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php include("../footer.php"); ?>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>

    </body>

    </html>
