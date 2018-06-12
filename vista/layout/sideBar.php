<?php
session_start();
?>
<div class="sidebar-header">
    <center>
        <FONT FACE="impact" SIZE=5 COLOR="white">SECTUR</FONT>
        <li><a class="fa fa-user" style="color: white!important;font-size:17px !important;font-weight: bold !important;">&nbsp;<?= $_SESSION['nombre']; ?></a></li>
    </center>
</div>
<center>
    <ul class="list-unstyled components">
        <?php if ($_SESSION['tipo'] == 9) { ?>
            <li class="active">
                <a href="#"  onclick="navContent('inicio')">Inicio&nbsp;&nbsp;<i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Personal&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <!--<li><a href="#" onclick="navContent('clientes/clientes')">Clientes</a></li>-->
                    <li><a href="#" id="ausu" onclick="navContent('usuarios/usuario')">Usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="#" id="tarjetasid" onclick="navContent('tarjetas/asignacion')">Asignacion tarjetas&nbsp;&nbsp;<i class="fa fa-credit-card"></i></a>
            </li>
            <?php
        }
        ?>
        <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2) { ?>
            <li>
                <a href=javascript:void(0) id="sideHotel" class='editar' onclick="navContent('hotel/hotel')">Hoteles&nbsp;&nbsp;<i class="fa fa-building-o"></i></a>
            </li>
            <li>
                <a href=javascript:void(0) id="1" class='editar' onclick="navContent('restaurant/restaurant')">Restaurantes&nbsp;&nbsp;<i class="fa fa-coffee"></i></a>
            </li>
            <li>
                <a href=javascript:void(0) id="1" class='editar' onclick="navContent('disciplinas/disciplina')">Disciplinas&nbsp;&nbsp;<i class="fa fa-cubes"></i></a>
            </li>
            <?php
        }
        ?>
        <?php if ($_SESSION['tipo'] == 7) { ?>
            <li>
                <a href="#" id="ventasid" onclick="navContent('ventas/venta')">Ventas&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i></a>
            </li>
            <?php
        }
        ?>
    </ul>
</center>
<ul class="list-unstyled CTAs">
    <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2) { ?>
        <li>
            <a href=javascript:void(0) id="1" class='editar' onclick="navContent('layout/_layout')" style="font-weight: bold;">Exportar LAYOUT&nbsp;&nbsp;<i class="fa fa-file-excel-o"></i></a>
        </li>
        <?php
    }
    ?>
</ul>