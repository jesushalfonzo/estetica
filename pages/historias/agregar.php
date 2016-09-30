<?php session_start();?>
<?php include('../../logeo.php'); 
include('../../extras/conectar.php');
$link=Conectarse();
$id_paciente=$_GET["ckl"];

if (!control_access("HISTORIA", 'AGREGAR')) {  echo "<script language='JavaScript'>document.location.href='../../dashboard.php';</script>"; }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("../Common_head.php"); ?>
    <script src="../../js/jquery.annotate.js"></script>.
    <script src="../../js/jquery.PrintArea.js"></script>
    <script src="http://zurb.com/playground/uploads/upload/upload/207/jquery.annotate.js"></script>
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


evento = function (evt) { //esta funcion nos devuelve el tipo de evento disparado
 return (!evt) ? event : evt;
}


function craerCampos(numerito){

    container = document.getElementById('CamposTexto');

//DIV MAESTRO
nDiv = document.createElement('div');
nDiv.id="contenido"+numerito;
container.appendChild(nDiv);

//DIVS
divCont1 = document.createElement('div');
divCont1.id="columna1";
divCont1.innerHTML = '- '+numerito;
divCont4 = document.createElement('div');
divCont4.id="columna4";
divCont4.setAttribute("style","width:89%; border-right:0px;");

nFile = document.createElement('input');
nFile.name = 'antropos[]';
nFileX = document.createElement('input');
nFileX.name = 'x[]';
nFileX.type="hidden";
nFileX.id = 'cordenadax'+numerito;
nFileY = document.createElement('input');
nFileY.name = 'y[]';
nFileY.id = 'cordenaday'+numerito;
nFileY.type="hidden";

nFile.setAttribute("class","completo");


a = document.createElement('a');
//El link debe tener el mismo nombre de la div padre, para efectos de localizarla y eliminarla
a.name = nDiv.id;
a.id=nDiv.id;
a.href = '#.';
a.onclick = elimCamp;
a.innerHTML = ' X ';
a.setAttribute("style","font-weight:bold;");

//CREANDO LAS CAJAS DINAMICAS
nDiv.appendChild(divCont1);
nDiv.appendChild(divCont4);
divCont4.appendChild(nFile);
divCont4.appendChild(a);
divCont4.appendChild(nFileX);
divCont4.appendChild(nFileY);

nFile.focus()


}

//con esta función eliminamos el campo cuyo link de eliminación sea presionado
elimCamp = function (evt){
 evt = evento(evt);
 nCampo = rObj(evt);
 div = document.getElementById(nCampo.name);
 div.parentNode.removeChild(div);
 document.getElementById('frameAntro').contentWindow.deleteCordenada(nCampo.id);
}
//con esta función recuperamos una instancia del objeto que disparo el evento
rObj = function (evt) { 
 return evt.srcElement ?  evt.srcElement : evt.target;
}
</script>
<script type="text/javascript">
function getObject(obj) {
  var theObj;
  if(document.all) {
      if(typeof obj=="string") {
          return document.all(obj);
      } else {
          return obj.style;
      }
  }
  if(document.getElementById) {
      if(typeof obj=="string") {
          return document.getElementById(obj);
      } else {
          return obj.style;
      }
  }
  return null;
}


i=0;
function asignarCordenadas(x, y){
    i=i+1;
    var inputX="cordenadax"+i;
    var inputY="cordenaday"+i;
    document.getElementById(inputX).value = x;
    document.getElementById(inputY).value = y;
    
    //alert("X="+x+" Y="+y);
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
    /* border: 0.5px solid #000;*/
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

.completo{
    width: 90%;
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

                <div class="row">
                    <div class="col-lg-12">

                        <h2 class="page-header">Historia médica del paciente: <?=$m_paciente_nombre?></h2>
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
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <textarea class="form-control" name="direccionpaciente" id="direccionpaciente" rows="3" placeholder="Dirección de habitación" readonly><?=$m_paciente_direccion?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Motivo de consulta:</label>
                                        <textarea class="form-control" name="motivoConsultamotivoConsulta" id="motivoConsulta" rows="3" placeholder="Motivo de consulta"></textarea>

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
                                    <label>ANTECEDENTES FAMILIARES</label>
                                    
                                </div>
                                <div id="contenedor">
                                    <div id="contenidos">
                                        <?php
                                        $i=0;
                                        $sqlAntecedentes="SELECT * FROM antecedentes_Familiares ORDER BY antecedentes_descripciion ASC";
                                        $queryAntecedentes=mysqli_query($link, $sqlAntecedentes);
                                        $totalCat=mysqli_num_rows($queryAntecedentes);
                                        while ($rowAntecedentes=mysqli_fetch_array($queryAntecedentes)) {
                                            $i++;
                                            $antecedentes_id=$rowAntecedentes["antecedentes_id"];
                                            $antecedentes_descripciion=$rowAntecedentes["antecedentes_descripciion"];
                                            ?>


                                            <div id="columna1"><?=utf8_encode($antecedentes_descripciion)?></div>
                                            <?php
                                            $SqlrelAnte="SELECT * FROM r_antecedentes WHERE r_antecedentes_idPaciente='$m_paciente_id' AND r_antecedentes_idAntecedente='$antecedentes_id'";
                                            $QueryRelExpAnte=mysqli_query($link, $SqlrelAnte);
                                            $rowRelAnte=mysqli_fetch_array($QueryRelExpAnte);
                                            $r_antecedentes_idAntecedente=$rowRelAnte["r_antecedentes_idAntecedente"];
                                            ?>

                                            <div id="columna4"><input name="antecedentes[<?php echo "$antecedentes_id";?>]" type="checkbox" <?php if ($antecedentes_id==$r_antecedentes_idAntecedente) {echo "checked";} ?>/></div>
                                            <?php

                                            if (($i % 3 == 0) and ($i < $totalCat)) {
                                                ?>
                                            </div>
                                            <div id="contenidos">
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->


                    </div>

                    <!-- /.row (nested) -->
                </div>


                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>DATOS CLÍNICOS</label>
                                    
                                </div>
                                <div id="contenedor">
                                    <div id="contenidos">
                                        <?php
                                        $i=0;
                                        $sqlDatosClinicos="SELECT * FROM m_datosClinicos ORDER BY m_datosClinicos_detalle ASC";
                                        $queryDatosClinicos=mysqli_query($link, $sqlDatosClinicos);
                                        $totalCatDC=mysqli_num_rows($queryDatosClinicos);
                                        while ($rowDatosClinicos=mysqli_fetch_array($queryDatosClinicos)) {
                                            $i++;
                                            $m_datosClinicos_id=$rowDatosClinicos["m_datosClinicos_id"];
                                            $m_datosClinicos_detalle=$rowDatosClinicos["m_datosClinicos_detalle"];
                                            ?>


                                            <div id="columna1"><?=utf8_encode($m_datosClinicos_detalle)?></div>


                                            <?php
                                            $SqlrelDatosC="SELECT * FROM r_datosClinicos WHERE r_datosClinicos_idpaciente='$m_paciente_id'  AND r_datosClinicos_idDatoC='$m_datosClinicos_id'";
                                            $QueryRelDatosC=mysqli_query($link, $SqlrelDatosC);
                                            $rowRelDatosC=mysqli_fetch_array($QueryRelDatosC);
                                            $r_datosClinicos_idDatoC=$rowRelDatosC["r_datosClinicos_idDatoC"];
                                            ?>

                                            <div id="columna4"><input name="datocC[<?php echo "$m_datosClinicos_id";?>]" type="checkbox" <?php if ($m_datosClinicos_id ==$r_datosClinicos_idDatoC) {echo "checked";} ?>/></div>
                                            <?php

                                            if (($i % 4 == 0) and ($i < $totalCatDC)) {
                                                ?>
                                            </div>
                                            <div id="contenidos">
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->

                    </div>
                </div>

                <div class="panel panel-default" style="background-color: #FBFBFC;">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>HABITOS PSICOLÓGICOS</label>
                                    
                                </div>
                                <div id="contenedor">
                                    <div id="contenidos">
                                        <?php
                                        $i=0;
                                        $sqlHabitosPs="SELECT * FROM m_habitosPsicologicos ORDER BY m_habitosPsicologicos_detalle ASC";
                                        $queryHabitosPs=mysqli_query($link, $sqlHabitosPs);
                                        $totalCatAP=mysqli_num_rows($queryHabitosPs);
                                        while ($rowHabitosPs=mysqli_fetch_array($queryHabitosPs)) {
                                            $i++;
                                            $m_habitosPsicologicos_id=$rowHabitosPs["m_habitosPsicologicos_id"];
                                            $m_habitosPsicologicos_detalle=$rowHabitosPs["m_habitosPsicologicos_detalle"];
                                            ?>


                                            <div id="columna1"><?=utf8_encode($m_habitosPsicologicos_detalle)?></div>


                                            <?php
                                            $SqlrelExpFisica="SELECT * FROM r_habitosPsicologicos WHERE r_habitosPsicologicos_idPaciente='$m_paciente_id' AND r_habitosPsicologicos_idhabitoPsicologico='$m_habitosPsicologicos_id'";
                                            $QueryRelExpFisica=mysqli_query($link, $SqlrelExpFisica);
                                            $rowRelExpFis=mysqli_fetch_array($QueryRelExpFisica);
                                            $r_habitosPsicologicos_idhabitoPsicologico=$rowRelExpFis["r_habitosPsicologicos_idhabitoPsicologico"];
                                            ?>



                                            <div id="columna4"><input name="HabitosPs[<?php echo "$m_habitosPsicologicos_id";?>]" type="checkbox" <?php if ($m_habitosPsicologicos_id ==$r_habitosPsicologicos_idhabitoPsicologico) {echo "checked";} ?>/></div>
                                            <?php

                                            if (($i % 4 == 0) and ($i < $totalCatAP)) {
                                                ?>
                                            </div>
                                            <div id="contenidos">
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->

                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>ASPECTOS PSICOLÓGICOS</label>
                                    
                                </div>
                                <div id="contenedor">
                                    <div id="contenidos">
                                        <?php
                                        $i=0;
                                        $sqlAspectoPs="SELECT * FROM m_aspectosPsicologicos ORDER BY m_aspectosPsicologicos_detalle ASC";
                                        $queryAspectosPs=mysqli_query($link, $sqlAspectoPs);
                                        $totalCatAP=mysqli_num_rows($queryAspectosPs);
                                        while ($rowAspectosPs=mysqli_fetch_array($queryAspectosPs)) {
                                            $i++;
                                            $m_aspectosPsicologicos_id=$rowAspectosPs["m_aspectosPsicologicos_id"];
                                            $m_aspectosPsicologicos_detalle=$rowAspectosPs["m_aspectosPsicologicos_detalle"];
                                            ?>


                                            <div id="columna1"><?=utf8_encode($m_aspectosPsicologicos_detalle)?></div>


                                            <?php
                                            $SqlrelExpAspPs="SELECT * FROM r_aspectosPsicologicos WHERE r_aspectosPsicologicos_idPaciente='$m_paciente_id' AND r_aspectosPsicologicos_idAspecto='$m_aspectosPsicologicos_id'";
                                            $QueryRelAspPs=mysqli_query($link, $SqlrelExpAspPs);
                                            $rowRelAspPs=mysqli_fetch_array($QueryRelAspPs);
                                            $r_aspectosPsicologicos_idAspecto=$rowRelAspPs["r_aspectosPsicologicos_idAspecto"];
                                            ?>

                                            <div id="columna4"><input name="AspectosPs[<?php echo "$m_aspectosPsicologicos_id";?>]" type="checkbox" <?php if ($m_aspectosPsicologicos_id ==$r_aspectosPsicologicos_idAspecto) {echo "checked";} ?>/></div>
                                            <?php

                                            if (($i % 4 == 0) and ($i < $totalCatAP)) {
                                                ?>
                                            </div>
                                            <div id="contenidos">
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>

                        
                        <!-- /.col-lg-6 (nested) -->

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>EXPLORACIÓN FISICA</label>
                                    
                                </div>
                                <div id="contenedor">
                                    <div id="contenidos">
                                        <?php
                                        $i=0;
                                        $SqlExpfisica="SELECT * FROM m_exploracion_fisica ORDER BY m_exploracionFisica_detalle ASC";
                                        $queryExpfisica=mysqli_query($link, $SqlExpfisica);
                                        $totalCatAP=mysqli_num_rows($queryExpfisica);
                                        while ($rowAspectosPs=mysqli_fetch_array($queryExpfisica)) {
                                            $i++;
                                            $m_exploracionFisica_id=$rowAspectosPs["m_exploracionFisica_id"];
                                            $m_exploracionFisica_detalle=$rowAspectosPs["m_exploracionFisica_detalle"];
                                            $m_exploracionFisica_imagen=$rowAspectosPs["m_exploracionFisica_imagen"];
                                            ?>

                                            <?php
                                            if($m_paciente_sexo=="M"){
                                                $m_exploracionFisica_imagen="".$m_exploracionFisica_imagen;

                                            }
                                            ?>
                                            <div id="columna1"><?=utf8_encode($m_exploracionFisica_detalle)?></div>
                                            <div id="columna4">

                                                <?php
                                                $SqlrelExpFisica="SELECT * FROM r_exploracion_fisica WHERE r_exploracionFisica_idpaciente='$m_paciente_id' AND r_exploracionFisica_idtipo='$m_exploracionFisica_id'";
                                                $QueryRelExpFisica=mysqli_query($link, $SqlrelExpFisica);
                                                $rowRelExpFis=mysqli_fetch_array($QueryRelExpFisica);
                                                $r_exploracionFisica_idtipo=$rowRelExpFis["r_exploracionFisica_idtipo"];
                                                ?>

                                                <img src="../../images/<?=$m_exploracionFisica_imagen?>" height="180">
                                                <input type="radio" name="grupExpFisica" id="check" value="<?=$m_exploracionFisica_id?>" <?php if ($r_exploracionFisica_idtipo==$m_exploracionFisica_id) { echo "checked"; } ?>>
                                            </div>
                                            <?php

                                            if (($i % 4 == 0) and ($i < $totalCatAP)) {
                                                ?>
                                            </div>
                                            <div id="contenidos">
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->

                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>BIOTIPO</label>

                                </div>
                                <div id="contenedor">
                                    <div id="contenidos">

                                        <?php
                                        $i=0;
                                        $sqlBiotipo="SELECT * FROM m_biotipo ORDER BY m_biotipo_detalle ASC";
                                        $queryBiotipo=mysqli_query($link, $sqlBiotipo);
                                        $totalCatAP=mysqli_num_rows($queryBiotipo);
                                        while ($rowBiotipo=mysqli_fetch_array($queryBiotipo)) {
                                            $i++;
                                            $m_biotipo_detalle=$rowBiotipo["m_biotipo_detalle"];
                                            $m_biotipo_img=$rowBiotipo["m_biotipo_img"];
                                            $m_biotipo_id=$rowBiotipo["m_biotipo_id"];
                                            ?>


                                            <div id="columna1"><?=utf8_encode($m_biotipo_detalle)?></div>

                                            <div id="columna4" style="text-align:center;">

                                              <?php
                                              if($m_paciente_sexo=="M"){
                                                $m_biotipo_img="M-".$m_biotipo_img;

                                            }
                                            ?>
                                            <img src="../../images/<?=$m_biotipo_img?>">


                                            <?php
                                            $SqlrelExpBio="SELECT * FROM r_biotipo_paciente WHERE r_biotipo_idPaciente='$m_paciente_id' AND r_biotipo_idBiotipo='$m_biotipo_id'";
                                            $QueryRelExpBio=mysqli_query($link, $SqlrelExpBio);
                                            $rowRelBio=mysqli_fetch_array($QueryRelExpBio);
                                            $r_biotipo_idBiotipo=$rowRelBio["r_biotipo_idBiotipo"];
                                            ?>


                                            <input type="radio" name="grupBiotipoRel" id="checkBio" value="<?=$m_biotipo_id?>" <?php if ($r_biotipo_idBiotipo==$m_biotipo_id) { echo "checked"; } ?>></div>
                                            <?php

                                            if (($i % 4 == 0) and ($i < $totalCatAP)) {
                                                ?>
                                            </div>
                                            <div id="contenidos">
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>

                                </div>
                            </div>


                        </div>


                        <!-- /.col-lg-6 (nested) -->

                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>ANTROPOMETRÍA</label>

                                </div>
                                <div id="contenedor">


                                    <div class="col-lg-6" style="width:50%">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                ANTROPOMETRÍA
                                            </div>

                                            <div class="panel-body">
                                                <div id=""><iframe id="frameAntro" src="atropometriaFrame.php?id=<?=$m_paciente_id?>" height="588" width="500" frameborder="0" scrolling="no" allowfullscreen></iframe></div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.col-lg-4 -->
                                    <div class="col-lg-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                               DETALLES ANTROPOMETRIA
                                           </div>
                                           <a href="#" id="serialize" class="super button" style="display:none"><span>Serialize!</span></a>
                                           <div id="CamposTexto">
                                               <?php
                                               $SQL="SELECT * FROM r_antopometria WHERE r_antopometria_idPaciente='$m_paciente_id'";
                                               $query=mysqli_query($link, $SQL);
                                               $num=mysqli_num_rows($query);

                                               $i=0;
                                               while ($row=mysqli_fetch_array($query)) {
                                                $r_antopometria_id=$row["r_antopometria_id"];
                                                $r_antopometria_cordenadaX=$row["r_antopometria_cordenadaX"];
                                                $r_antopometria_cordenadaY=$row["r_antopometria_cordenadaY"];
                                                $r_antopometria_texto=$row["r_antopometria_texto"];
                                                $i++;

                                                ?>
                                                <div id="contenido<?=$i?>" class="contenido">
                                                    <div id="columna1">- <?=$i?></div>
                                                    <div id="columna4" style="width:89%; border-right:0px;">
                                                        <input name="antropos[]" id="contenido<?=$i?>" class="completo" value="<?=$r_antopometria_texto?>">

                                                        <img src="../../images/eliminar.png" title="Eliminar" data-id="<?=$r_antopometria_id?>" data-iddiv="<?=$i?>" class="BotonELiminar" name="contedido<?=$i?>">
                                                        <input name="x[]" type="hidden" id="cordenadax<?=$i?>" value="<?=$r_antopometria_cordenadaX?>">
                                                        <input name="y[]" id="cordenaday<?=$i?>" type="hidden" value="<?=$r_antopometria_cordenadaY?>">
                                                    </div>
                                                </div>

                                                <?php } ?>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- /.col-lg-4 -->

                            </div>

                        </div>


                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>INESTICISMO</label>

                                    </div>
                                    <div id="contenedor">


                                      <!-- /.col-lg-4 -->
                                      <div class="col-lg-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                               DETALLES ANTROPOMETRIA
                                           </div>
                                           <?php
                                           $i=0;
                                           $sqlInesticismo="SELECT * FROM m_inesticismo ORDER BY m_inesticismo_id ASC";
                                           $queryInesticismo=mysqli_query($link, $sqlInesticismo);
                                           $totalCatAP=mysqli_num_rows($queryInesticismo);
                                           while ($rowInesticismo=mysqli_fetch_array($queryInesticismo)) {
                                            $i++;
                                            $m_inesticismo_id=$rowInesticismo["m_inesticismo_id"];
                                            $m_inesticismo_detalle=utf8_encode($rowInesticismo["m_inesticismo_detalle"]);
                                            ?>
                                            <?php
                                            $Sqlrelinesticismo="SELECT * FROM r_inesticismo WHERE r_inesticismo_idPaciente='$m_paciente_id' AND r_inesticismo_idInesticismo='$m_inesticismo_id'";
                                            $QueryRelInesticismo=mysqli_query($link, $Sqlrelinesticismo);
                                            $rowRelInes=mysqli_fetch_array($QueryRelInesticismo);
                                            $r_inesticismo_idInesticismo=$rowRelInes["r_inesticismo_idInesticismo"];
                                            $r_inesticismo_detalle=$rowRelInes["r_inesticismo_detalle"];
                                            ?>
                                            <div id="contenidos">
                                                <div id="columna1"><?=$m_inesticismo_detalle?></div>
                                                <div id="columna4">
                                                    <input name="idInesticismo[<?=$m_inesticismo_id?>]" type="hidden" value="<?=$m_inesticismo_id?>"/>
                                                    <input name="inesticismoDetalle[<?=$m_inesticismo_id?>]" type="text" value="<?=$r_inesticismo_detalle?>" /> 
                                                </div>
                                            </div>

                                            <?php } ?>

                                        </div>

                                    </div>
                                </div>
                                <!-- /.col-lg-4 -->

                            </div>

                        </div>

                    </div>


                </div>


                <!-- /.col-lg-6 (nested) -->

            </div>
        </div>

        <div class="panel panel-default" style="background-color: #FBFBFC;">

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label>TRATAMIENTOS Y RECOMENDACIONES</label>

                        </div>

                        <div id="contenedor">
                            <div id="contenidos">


                                <?php
                                $SQLTrat="SELECT * FROM m_tratamiento WHERE m_tratamiento_idPaciente='$m_paciente_id'";
                                $queryTrat=mysqli_query($link, $SQLTrat);
                                $rowTrat=mysqli_fetch_array($queryTrat);
                                $m_tratamiento_tipo=$rowTrat["m_tratamiento_tipo"];
                                $m_tratamiento_contraindicaciones=$rowTrat["m_tratamiento_contraindicaciones"];
                                $m_tratamiento_alteraciones=$rowTrat["m_tratamiento_alteraciones"];
                                $m_tratamiento_pronosticco=$rowTrat["m_tratamiento_pronosticco"];
                                ?>
                                <div id="columna1">Tipo de tratamiento: </div>
                                <div id="columna4"><textarea  name="tipoTratamiento" style="width:100%;"><?=$m_tratamiento_tipo?></textarea></div>

                            </div>
                            <div id="contenidos">



                                <div id="columna1">Contraindicaciones: </div>
                                <div id="columna4"><textarea  name="contraindicaciones" style="width:100%;"><?=$m_tratamiento_contraindicaciones?></textarea></div>

                            </div>
                            <div id="contenidos">



                                <div id="columna1">Algunas alteraciones: </div>
                                <div id="columna4"><textarea  name="alteraciones" style="width:100%;"><?=$m_tratamiento_alteraciones?></textarea></div>

                            </div>
                            <div id="contenidos">



                                <div id="columna1">Pronostico: </div>
                                <div id="columna4"><textarea  name="pronostico" style="width:100%;"><?=$m_tratamiento_pronosticco?></textarea></div>

                            </div>

                        </div>
                    </div>


                </div>
                <!-- /.col-lg-6 (nested) -->


            </div>




            <!-- /.row (nested) -->
        </div>

        <!-- /.row (nested) -->
    </div>
    <!-- /.panel-body -->

</div>




<div class="panel panel-default">
 <div align="center" style="margin-top:10px;">
    <button type="submit" class="btn btn-primary" id="btn_enviar">Guardar</button>
    <button type="reset" class="btn btn-danger" onClick="document.location.href='../index.php';">Cancelar</button>
    <button type="button" class="btn btn-warning" id="imprime" href="#.">Imprimir</button>
    
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
    $("#btn_enviar").click(function(){
       document.getElementById('frameAntro').contentWindow.simulate();
       var formData = new FormData($("#FormularioPaciente")[0]);
       $.ajax({
        url: "ihistoria.php",
        type: 'POST',
        enctype: 'multipart/form-data',
        data: formData,
        async: false,
        success: function (data) {
            $("#mensajes").css("z-index", "1");
            $($("#mensajes").html(data)).fadeIn( "slow" );
            setTimeout(function() { $(".alert").alert('close');}, 2000);
            setTimeout(function() { document.location.href = '../pacientes/listarpacientes.php';}, 2000);

        },
        error: function(returnval) {
            alert( "Ha ocurrido un error" );
            setTimeout(function() { $(".alert").alert('close');}, 2000);
        },
        cache: false,
        contentType: false,
        processData: false
    });


       return false;
   });

    $(".BotonELiminar").click(function(){
     var id = $(this).data('id');
     var idDiv = $(this).data('iddiv');
     $.get("deleteRegisterCord.php", {idCordenada: id}, function(respuesta){
        $( "#contenido"+idDiv  ).slideUp();
        document.getElementById('frameAntro').contentWindow.deleteCordenada("contenido"+idDiv);
           //setTimeout(function() { $(".alert").alert('close');}, 2000);
       })

     return false;
 });




});



</script>

<script type="text/javascript">
$("#imprime").click(function (){
  // $("div#myPrintArea").printArea();
  window.print();
})
</script>