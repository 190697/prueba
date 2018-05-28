function insertarPersona() {
    $nombre = $("#txtNombreP").val();
    $apellidos= $("#txtApP").val();
    $correo = $("#txtCorreP").val();
    var url = "./ajax/ajax_persona.php";
    if (!$nombre || !$apellidos || !$correo) {
        swal("Error!", "Se deben llenar todos los campos.", "warning");
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idNombre: $nombre, idApellidos: $apellidos, idCorreo:$correo},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    swal({
                        title: "Exito!",
                        text: "Se ha registrado correctamente.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    $("#home").click();
                } else {
                    swal("Error!", "Error al intentar crear el registro.", "warning");
                }
            }
        });
    }

}


