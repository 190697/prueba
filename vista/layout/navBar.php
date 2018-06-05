<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_meta.php');
session_start();
$controladorMeta = new ControladorMeta();
$consulta = $controladorMeta->buscarMetaActual();
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a style="font-size: 18px;font-weight: bold;">
                <span style="color: white;" onclick="sideBar()"><i id="sidebarCollapse" class="btn navbar-btn glyphicon glyphicon-align-left"></i>  SRA |Sistema de Registro de Asistencia&nbsp;&nbsp;</span>
            </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a id="home" href="./index.php">Inicio&nbsp;&nbsp;<i class="fa fa-home"></i></a></li>
                    <?php if ($_SESSION['tipo'] == 3 || $_SESSION['tipo'] == 2) { ?>
                    <li>
                        <a href=javascript:void(0) id="amonto" class='editar' data-value="vista/monto_meta/monto_meta.php" onclick="modal(this)">Recurso</a>
                    </li>
                    <?php
                }
                ?>
                <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2) { ?>
                    <li>
                        <a href=javascript:void(0) id="5" class='editar' data-value="vista/hotel/form_tipoHabitacion.php" onclick="modal(this)">Tipo Habitaciones&nbsp;&nbsp;</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a style="color: white;font-size:17px;font-weight: bold;"><?= $_SESSION['nombre']; ?></a></li>
                <?php if ($_SESSION['tipo'] == 3 || $_SESSION['tipo'] == 2) {?>
                    <li>
                        <input type="hidden" id="fondoActual" value="<?=$consulta[0][4]?>">
                        <a id="monto_meta" style="color: white;background-color: #EC4094;border-radius: 100px;">
                            <?php
                            if ($consulta) {
                                if ($consulta[0][1])echo "M/actual: " . number_format($consulta[0][4], 2);
                            } else {
                                echo "Debe registrar un fondo";
                            }
                            ?>
                        </a>
                    </li>
                <?php
                } ?>
                <li><a href="#" id="cerrar" name="cerrar" style="color: white; padding-right: 30px;" onclick="cerrarSesion();"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión   </a></li>
                <li></li>
            </ul>
        </div>
    </div>
</nav>