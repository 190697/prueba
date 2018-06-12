function insertarPersona() {
    $nombre = $("#txtNombreP").val();
    $apellidos = $("#txtApP").val();
    $correo = $("#txtCorreP").val();
    var url = "./ajax/ajax_persona.php";
    if (!$nombre || !$apellidos || !$correo) {
        swal("Error!", "Se deben llenar todos los campos.", "warning");
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idNombre: $nombre, idApellidos: $apellidos, idCorreo: $correo},
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
function insertPers_grupo(boton) {
    var url = "./ajax/ajax_persona.php";
    $id = boton.id;
    $("#" + $id).hide();
    $("#S" + $id).show();
    $.ajax({
        url: url,
        type: 'post',
        data: $("#formGroup").serialize(),
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
                $("#" + $id).show();
                $("#S" + $id).hide();
                mostrarIndex(2);
                $(".close").click();
            } else {
                $("#" + $id).show();
                $("#S" + $id).hide();
                swal("Error!", "Error al intentar crear el registro\nRevisa que los campos hayan quedado completos", "error");
            }
        }
    });
}


function validarInput(boton, spa) {
    $id = boton.id;
    $idS = spa;
    if ($("#" + $id).val().length == 0) {
        $("#" + $id).css("border-color", "red");

        $("#" + $id + "Esp").html("<span><img src='./images/incorrect.png' width='10' height='10'></span>");
    } else {
        $("#" + $id + "Esp").html("<span><img src='./images/correct.png' width='10' height='10'></span>");
        $("#" + $id).css("border-color", "green");
    }
}

/*function validarInp(boton){
 $(document).ready(function(){
 $("#txtNombreP").focusout(function(){
 if($(this).val().length == 0){
 $(this).css("border-color","red");
 
 $("#spa").html("<span>no</span>");
 }else{
 $(this).css("border-color","green");
 }
 }); 
 });
 }*/


