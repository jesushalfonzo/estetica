<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
if (!control_access("CLIENTES", 'VER')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; }
if (isset($_GET["id"])){$idGet=$_GET["id"];}else{ $idGet=0; }
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<head>

  <?php include("../Common_head.php"); ?>
  <script src="buscador/statics/js/functions.js"></script>


  <script type="text/javascript">
  function direccionar(idPaciente){
    document.location.href="listarpacientes.php?id="+idPaciente;

  }


  </script>

</head>

<body>

  <div id="wrapper">

    <!-- Navigation -->

    <?php include("../topheader.php"); ?>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Listado de Pacientes</h1>

          <div id="mensajes"></div>

          <div class="input-group custom-search-form navbar-right" style="width:30%; margin-bottom:25px;">

            <input class="form-control" placeholder="Buscar...." type="text" id="campoBusqueda" name="autocomplete"  />

            <div class="col-md-8" id="busqueda" style="width:20%; z-index:3; overflow: hidden; float: center;  position: fixed; margin-top:30px;" ></div>             
            <span class="input-group-btn">

              <button class="btn btn-default" type="button" onclick="document.location.href='listarpacientes.php'">
                <i class="fa fa-search"></i>
              </button>
            </span>

          </div>



          <!-- /.col-lg-12 -->
        </div>

        <!-- /.row -->
        <div class="row" id="listas">

         <?php 


         if ($idGet==0) {
           $SQL="SELECT * FROM m_pacientes WHERE m_paciente_estatus ='A' ORDER BY m_paciente_nombre ASC LIMIT 0,10 ";
         } else {
           $SQL="SELECT * FROM m_pacientes WHERE m_paciente_id='$idGet'";
         }
         
         $query=mysqli_query($link, $SQL);
         while($row=mysqli_fetch_array($query)){
           $m_paciente_id=$row["m_paciente_id"];
           $m_paciente_nombre=$row["m_paciente_nombre"];
           $m_paciente_sexo=$row["m_paciente_sexo"];
           $m_paciente_direccion=$row["m_paciente_direccion"];
           $m_paciente_cedula=$row["m_paciente_cedula"];
           $m_paciente_telefono=$row["m_paciente_telefono"];
           $m_paciente_correo=$row["m_paciente_correo"];
           $m_paciente_foto=$row["m_paciente_foto"];
           if ($m_paciente_foto=="") {
                     # code...
            $m_paciente_foto="no_photo.jpg";
          }

          ?>
          <div class="col-lg-4" id="Caja<?=$m_paciente_id?>">
            <div class="panel panel-primary">
              <div class="panel-heading" style="text-align:center">
                <?=$m_paciente_nombre?>
              </div>
              <div class="panel-body" style="overflow-y: scroll;height: 200px;">
                <div>




                 <?php if (control_access("HISTORIA", 'AGREGAR')) { ?>  <a href="../historias/agregar.php?ckl=<?=$m_paciente_id?>"><i data-toggle="tooltip" data-placement="top" title="Consultar miembro del espacio" class="fa fa-eye"></i> Historia m&eacute;dica</a> &nbsp;<?php } ?>




                 <?php if (control_access("CLIENTES", 'EDITAR')) { ?><a href="editarpaciente.php?idpaciente=<?=$m_paciente_id?>"><i data-toggle="tooltip" data-placement="top" title="Editar minformación del paciente" class="fa fa-pencil-square-o"></i> Editar Paciente</a><?php } ?>



               </div>
               <br>
               <div align="center">
                <div class="row">
                  <div class="col-sm-4">
                    <img src="../../multimedia/fotos/<?=$m_paciente_foto;?>"  height= "80px" style=" width:80%; max-height: 120px;" class="img-thumbnail">
                  </div>
                  <div class="col-sm-8" align="left">
                   <?php if (control_access("CITAS", 'VER')) { ?> <a href="../consultas/historial.php?paciente=<?=$m_paciente_id?>"><i data-toggle="tooltip" data-placement="top" title="Ver lista de pendientes" class="fa fa-list"></i> Consultas</a><br><?php } ?>
                   <?php if (control_access("PAGOS", 'VER')) { ?> <a href="../pagos/index.php?ckl=<?=$m_paciente_id?>"><i data-toggle="tooltip" data-placement="top" title="Ver lista de actividades por revisar" class="fa fa-money"></i> Pagos</a><br><?php } ?>


                 </div>
               </div>

             </div>
             <div>

             </div>
           </div>
           <div class="panel-footer">
            <?php if (control_access("CLIENTES", 'ELIMINAR')) { ?>
            <button class="btn btn-danger btn-xs btn-borrar" data-id="<?=$m_paciente_id?>" data-title="Borrar paciente?" data-trigger="focus" data-on-confirm="deletePaciente" data-toggle="confirmation" data-btn-ok-label="Confirmar" data-btn-cancel-label="Cancelar!" data-placement="top" >
             <span class="glyphicon glyphicon-trash"></span>
             <span <i title="Borrar de la lista de paciente"> </i>Borrar paciente</span>
           </button>
           <?php } ?>
         </div>
       </div>
     </div>

     <?php } ?>



   </div>

 </div>
 <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include("../footer.php"); ?>

<!-- Bootstrap Core JavaScript -->


<script>

$('[data-toggle=confirmation]').confirmation();

function deletePaciente(){
  var id = $(this).data('id');
  $.get("borrarpaciente.php", {idpaciente: id}, function(respuesta){
    $($("#mensajes").html(respuesta)).fadeIn( "slow" );
    $( "#Caja"+id  ).slideUp();
              //$( "#Caja"+id ).remove();
            })
};
$(".alert-dismissable").click(function (e) {
  $(this).fadeOut('slow');
});
</script>
</body>

</html>
