/*-----------------Asignacion-------------------------*/
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

function asignarTarjeta(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idUsuario = boton.id;
    $destino = "vista/tarjetas/form_asignacion.php";
    modal2($destino, $idUsuario, i);
}

function historialTarjeta(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idUsuario = boton.id;
    $destino = "vista/ventas/form_historial.php";
    modal2($destino, $idUsuario, i);
}

function insertarTarjeta() {
    $idTajeta = $("#txtIdTarjeta").val();
    $tarjeta = $("#txtTarjeta").val();
    $nip = $("#txtNip").val();
    $monto = $("#txtMonto").val();
    $estatus = $("#dropdownEstatus").val();
    if (!$idTajeta)
        $idUsuario = 0;
    var url = "./ajax/ajax_tarjeta.php";
    if ($tarjeta.length < 10 || $nip.length < 4 || $monto.length < 1  || !$estatus) {
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
        $("#txtNombre").focus();
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idTajeta: $idTajeta, tarjeta: $tarjeta, nip: $nip, monto: $monto, estatus: $estatus},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado == 1) {
                    $("#modalUsuario").modal('toggle');
                    swal({
                        title: "Exito!",
                        text: "Se ha registrado correctamente.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    $("#tarjetasid").click();
                } else if (datos.estado == 3) {
                    $("#txtTarjeta").val("");
                    $("#txtTarjeta").focus();
                    swal("Error!", "La tarjeta ya esta asignada aun usuario.", "warning");
                }else {
                    swal("Error!", "Error al intentar crear el registro.", "warning");
                }
            }
        });
    }
}

function desactivarTarjeta(boton) {
    $idTarjeta = boton.id;
    var url = "./ajax/ajax_tarjeta.php";
    swal({
        title: "¿Estas seguro de desactivar la tarjeta?",
        text: "Recuerde una vez desactiva el usuario no podra realizar compras",
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
                    data: {accion: 2, idTajeta: $idTarjeta, estatus:0},
                    success: function (response) {
                        var datos = JSON.parse(response);
                        if (datos.estado != 0) {
                            swal({
                                title: "Exito!",
                                text: "Se ha desabilitado correctamente.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            $("#tarjetasid").click();
                            //swal("Exito!", "El registro se elimino correctamente.", "success");
                        } else {
                            swal("Error!", "Error al intentar desactivar la tarjeta.", "warning");
                        }
                    }
                });
            });
}

function activarTarjeta(boton) {
    $idTarjeta = boton.id;
    var url = "./ajax/ajax_tarjeta.php";
    swal({
        title: "¿Estas seguro de activar la tarjeta?",
        text: "Recuerde una vez activa la tarjeta el usuario podra realizar compras",
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
                    data: {accion: 2, idTajeta: $idTarjeta, estatus:1},
                    success: function (response) {
                        var datos = JSON.parse(response);
                        if (datos.estado != 0) {
                            swal({
                                title: "Exito!",
                                text: "Se activo correctamente la tarjeta.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            $("#tarjetasid").click();
                            //swal("Exito!", "El registro se elimino correctamente.", "success");
                        } else {
                            swal("Error!", "Error al intentar activar la tarjeta.", "warning");
                        }
                    }
                });
            });
}