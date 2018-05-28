<?php
include '../../controlador/controlador_usuario.php';
$controlUsuarios = new ControladorUsuario();
$consulta = $controlUsuarios->listarUsuarios();
?>
<head>
    <script src="js/usuario.js" type="text/javascript"></script>
</head>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div align="center" style="margin: 30px;">
    <!--<div align="center" id="spinner" style="">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>-->
    <h2>Administración de Usuarios</h2>
    <div align="right">
        <a href=javascript:void(0) data-value="vista/usuarios/form_usuario.php" onclick="modal(this)"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo usuario</a><br><br>
        <div class="col-xs-10"></div>
        <div class="col-xs-2">
            <input class="form-control" id="myInput" type="text" placeholder="Filtrar.."><br>
        </div>
    </div>
    <div class="table table-responsive">
        <div class="alert-info" style="color: red;"><b><i class="fa fa-info-circle"></i> Recuerde que minimo un administardor debe estar habilitado.</b></div>
        <table id="TablaUsuario" class="table table-condensed table-hover table-striped">
            <thead>
                <tr class="info">
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Nombre Usuario</th>
                    <th>Contraseña</th>
                    <th>Estatus</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="TablaUsuarioFil">
                <?php
                foreach ($consulta as $row):
                    $estatus = "<i class='fa fa-times-circle' style='color:#FF0000;' aria-hidden=true> Desactivado</i>";
                    $tipo="Empleado";
                    $contrasena="*********";
                    if($row["tipo"]==9){
                        $tipo="Root";
                    }
                    if($row["estatus"]==1){
                        $estatus="<i class='fa fa-check' style='color:#28B463;' aria-hidden=true> Habilitado</i>";
                    }
                    ?>
                    <tr> 
                        <td><?php echo $row['nombreUsuario'] ?></td>
                        <td><?=$tipo?></td>
                        <td><?= $row["usuario"]?></td>
                        <td><?=$contrasena?></td>
                        <td><?=$estatus?></td>
                        <td><a href=javascript:void(0) id="<?= $row['id_usuario'] ?>" class='editar' onClick="editarUsuario(this)"><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>
                        <td><a href=# class='eliminar' id="<?= $row['id_usuario'] ?>" style='color:#FF0000;' onClick="eliminarUsuario(this)"><i class='fa fa-minus' aria-hidden=true>&nbsp;&nbsp;Desactivar</i></a></td>
                        <!--
                        <td><?php // echo $row['estatus'];    ?></td>
                        -->
                    </tr>

                <?php endforeach ?>  
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#TablaUsuarioFil tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>