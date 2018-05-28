function modal2($destino, $id, $editar) {
    $("#modal").empty();
    if ($id > 0) {
        $.post($destino, {id: $id, editar: $editar})
                .done(function (data) {
                    $("#modal").html(data);
                });
    } else {
        $.post($destino, )
                .done(function (data) {
                    $("#modal").html(data);
                });
    }
}

/*----------------------------------------------Modulo Usuarios----------------------------------------------*/
/*-----------------Insertar y/o editar usuarios-------------------------*/
function insertarUsuario() {
    $idUsuario = $("#txtIdUsuario").val();
    $editar = $("#txtEditarUsuario").val();
    $nombre = $("#txtNombre").val();
    $usuario = $("#txtNombreUsuario").val();
    $contrasenhia = $("#txtContrasenhia").val();
    $tipo = $("#txtEstatus").val();
    $estatus = $("#dropdownEstatus").val();
    if (!$idUsuario)
        $idUsuario = 0;
    var url = "./ajax/ajax_usuario.php";
    if ($nombre.length < 1 || $usuario.length < 1 || $contrasenhia.length < 1) {
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
        $("#txtNombre").focus();
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idUsuario: $idUsuario, nombre: $nombre, usuario: $usuario, contrasenhia: $contrasenhia, tipo: $tipo, estatus: $estatus},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    $("#modalUsuario").modal('toggle');
                    $id = datos.idUsduario;
                    if ($editar > 0) {
                        try {
                            document.getElementById("TablaUsuario").deleteRow($editar);
                        } catch (e) {
                            $("#ausu").click();
                        }
                    }
                    swal({
                        title: "Exito!",
                        text: "Se ha registrado correctamente.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    $("#ausu").click();
                } else {
                    swal("Error!", "Error al intentar crear el registro.", "warning");
                }
            }
        });
    }
}

/*-----------------Eliminar Usuario-------------------------*/
function eliminarUsuario(boton) {
    $idUsuario = boton.id;
    var url = "./ajax/ajax_usuario.php";
    swal({
        title: "¿Estas seguro de eliminar el registro?",
        text: "Recuerde una vez eliminados los datos no se podran recuperar",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true
    },
            function () {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {accion: 2, idUsuario: $idUsuario},
                    success: function (response) {
                        var datos = JSON.parse(response);
                        if (datos.estado != 0) {
                            /*Eliminar registro tabla*/
                            $("#ausu").click();
                            swal({
                                title: "Exito!",
                                text: "Se ha desabilitado correctamente.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            //swal("Exito!", "El registro se elimino correctamente.", "success");
                        } else {
                            swal("Error!", "Error al intentar eliminar el registro.", "warning");
                        }
                    }
                });
            });
}

/*-----------------Editar Usuario-------------------------*/
function editarUsuario(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idUsuario = boton.id;
    $destino = "vista/usuarios/form_usuario.php";
    modal2($destino, $idUsuario, i);
}
