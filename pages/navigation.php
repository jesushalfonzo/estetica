<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav in" id="side-menu">
            <li>
                <a href="<?=$serveractual?>/pages/index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
            </li>

            <?php if (control_access("CLIENTES", 'VER')) { ?>
            <li>
                <a href="#"><i class="fa  fa-user fa-fw"></i> Pacientes<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                <?php if (control_access("CLIENTES", 'AGREGAR')) { ?>
                   <li>
                    <a href="<?=$serveractual?>/pages/pacientes/agregar_paciente.php" class="fa fa-plus-circle ">&nbsp;Agregar Paciente</a>
                </li>
                <?php } ?>
                <?php if (control_access("CLIENTES", 'VER')) { ?>
                <li>
                    <a href="<?=$serveractual?>/pages/pacientes/listarpacientes.php" class="fa fa-list-alt">&nbsp;Listar Pacientes</a>
                </li>
                <?php } ?>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <?php } ?>
        <li>
            <a href="<?=$serveractual?>/pages/consultas/index.php"><i class="fa fa-table fa-fw"></i> Citas</a>
        </li>

         <?php if (control_access("PAGOS", 'VER')) { ?>
            <li>
                <a href="#"><i class="fa  fa-money fa-fw"></i> Pagos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                
                   <li>
                    <a href="<?=$serveractual?>/pages/pagos/pagospendientes.php" class="fa fa-clock-o ">&nbsp;Pagos Pendientes</a>
                </li>
          
        
              <!-- <li>
                    <a href="<?=$serveractual?>/pages/pagos/completados.php" class="fa fa-check">&nbsp;Pagos Completados</a>
                </li>-->
               
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <?php } ?>
        <!--<li>
            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li>
                    <a href="panels-wells.html">Panels and Wells</a>
                </li>
                <li>
                    <a href="buttons.html">Buttons</a>
                </li>
                <li>
                    <a href="notifications.html">Notifications</a>
                </li>
                <li>
                    <a href="typography.html">Typography</a>
                </li>
                <li>
                    <a href="icons.html"> Icons</a>
                </li>
                <li>
                    <a href="grid.html">Grid</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li>
                    <a href="#">Second Level Item</a>
                </li>
                <li>
                    <a href="#">Second Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level collapse">
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li>
                    <a href="blank.html">Blank Page</a>
                </li>
                <li>
                    <a href="login.html">Login Page</a>
                </li>
            </ul>
        </li>-->
    </ul>
</div>
</div>
