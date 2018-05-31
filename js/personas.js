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
     function insertPers_grupo () {
         var url = "./ajax/ajax_persona.php";
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
                    $("#home").click();
                } else {
                    swal("Error!", "Error al intentar crear el registro\nRevisa que los campos hayan quedado completos", "warning");
                }
            }
        });
        }
        
        function validarInput(boton){
            $id=boton.id;
            if($("#"+$id).val().length == 0){
                $("#"+$id).css("border-color","red");

                /*$("#spa").html("<span>no</span>");*/
            }else{
               $("#"+$id).css("border-color","green");
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


