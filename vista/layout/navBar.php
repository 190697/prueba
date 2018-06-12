<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_meta.php');
session_start();
$controladorMeta = new ControladorMeta();
$consulta = $controladorMeta->MetaActual();
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a style="font-size: 18px;font-weight: bold;">
                <span style="color: white;" onclick="sideBar()"><i id="sidebarCollapse" class="btn navbar-btn glyphicon glyphicon-align-left"></i>  MG | Meeting Group&nbsp;&nbsp;</span>
            </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <center>
                <ul class="nav navbar-nav">
                    <li class="active"><a id="home" href="./index">Inicio&nbsp;&nbsp;<i class="fa fa-home"></i></a></li>
                    <?php if ($_SESSION['tipo'] == 3 || $_SESSION['tipo'] == 2) { ?>
                        <li>
                            <a href=javascript:void(0) id="amonto" class='editar' style="color: whitesmoke" data-value="vista/monto_meta/monto_meta.php" onclick="modal(this)">Recurso&nbsp;&nbsp;<i class="fa fa-money"></i></a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2) { ?>
                        <li>
                            <a href=javascript:void(0) id="5" class='editar' data-value="vista/hotel/form_tipoHabitacion.php" onclick="modal(this)" style="color: whitesmoke">Tipo Habitaciones&nbsp;&nbsp;<i class="fa fa-building"></i></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </center>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SESSION['tipo'] == 3 || $_SESSION['tipo'] == 2) { ?>
                    <li>
                        <input type="hidden" id="fondoActual" value="<?= $consulta[0][0] ?>">
                        <a id="monto_met" style="color: white;background-color: #EC4094;border-radius: 0px 30px 0px 30px!important;">
                            <?php
                            if ($consulta) {
                                if ($consulta[0][1])
                                    echo "Alimento: $" . number_format($consulta[0][1]);
                            } else {
                                echo "Debe registrar un fondo";
                            }
                            ?>
                        </a>
                    </li>&nbsp;
                    <li>
                        <a id="monto_met" style="color: white;background-color: #EC4094;border-radius: 0px 30px 0px 30px!important;">
                            <?php
                            if ($consulta) {
                                if ($consulta[0][1])
                                    echo "Hospedaje: $" . number_format($consulta[0][2]);
                            } else {
                                echo "Debe registrar un fondo";
                            }
                            ?>
                        </a>
                    </li>
    <?php }
?>
                <li><a href="#" id="cerrar" name="cerrar" style="color: white; padding-right: 30px;" onclick="cerrarSesion();"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión   </a></li>
                <li></li>
            </ul>
        </div>
    </div>
</nav>