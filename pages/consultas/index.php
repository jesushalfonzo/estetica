  <?php session_start();?>
  <?php include('../../logeo.php'); 
  include('../../extras/conectar.php');
  $link=Conectarse();
  if (!control_access("CLIENTES", 'VER')) {  echo "<script language='JavaScript'>document.location.href='dashboard.php';</script>"; }

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  <head>

    <?php include("../Common_head.php"); ?>
    <link rel='stylesheet' href='../../css/cupertino/jquery-ui.min.css' />
    <script src="../../bower_components/bootstrap/js/modal.js"></script>
    <link href='../../css/fullcalendar.css' rel='stylesheet' />
    <link href='../../css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='../../js/moment.min.js'></script>
    <script src='../../js/jquery.min.js'></script>
    <script src='../../js/fullcalendar.js'></script>
    <script src='../../js/es.js'></script>


    <script>

      $(document).ready(function() {

        $('#calendar').fullCalendar({
          theme: true,
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },

          defaultDate: '<?php echo date("Y-m-d", time()); ?>',
          editable: false,
          droppable: true,

        eventLimit: true, // allow "more" link when too many events
        events: [<?php include("getMyEvents.php");?>]
      });

      });

    </script>
    <style>

      #calendar {
        max-width: 900px;
        margin: 0 auto;
      }

    </style>
  </head>

  <body>

    <!-- Navigation -->

    <?php include("../topheader.php"); ?>

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Citas programadas <span class="glyphicon glyphicon-calendar"></span></h1> 

          <div id="mensajes"></div>
        </div>


        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div id='calendar'></div>

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
      </div> <!-- /.modal -->


    </div>
    <!-- /#page-wrapper -->

  </div>
  <!-- /#wrapper -->

  <?php include("../footer.php"); ?>


  <script>
    $(function(){
      $('.fc-bg td.alerta').click(function(){
          //alert("LLAMADo");
          var fechacita=$(this).data('date');
          $('#myModal').removeData('bs.modal');
          $('#myModal').modal({remote: 'formcita.php?date=' + fechacita });
          

        });

    });

    function editarCita(id){
      $('#myModal').modal({remote: 'editarCita.php?id=' + id });
      
    }
  </script>
</body>

</html>
