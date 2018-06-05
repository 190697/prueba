<?php
session_start();
?>
<div class="sidebar-header">
    <h3>SECTUR&nbsp;&nbsp; </h3>
</div>

<ul class="list-unstyled components">
    <?php
    if($_SESSION['tipo']==9){?>
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
            <a href=javascript:void(0) id="1" class='editar' onclick="navContent('hotel/hotel')">Hoteles&nbsp;&nbsp;<i class="fa fa-building-o"></i></a>
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

<ul class="list-unstyled CTAs">
</ul>