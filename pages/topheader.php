<?php session_start();?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><span style="font-family: 'Orbitron'">ESTÉTICA INTEGRAL YADIRA MEJÍAS / EN ALMA Y CUERPO</span></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
               
              
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?=$nombre_completo?></a>
                        </li>
                        <li><a href="<?=$serveractual?>/cambiarclave.php"><i class="fa fa-gear fa-fw"></i> Cambiar Clave</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=$serveractual?>/cerrar.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <?php include("navigation.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>
