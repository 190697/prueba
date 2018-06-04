/*-----------------Editar Grupo-------------------------*/
function editarGrupo(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idCliente = boton.id;
    $destino = "vista/grupo/form_grupo.php";
    modal2($destino, $idCliente, i);
}
function telefonos(boton) {
    $idPersona = boton.id;
    $destino = "vista/clientes/form_telefono.php";
    modal2($destino, $idPersona, 0);
}

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

function prueba() {
    swal({
        title: "Mensaje con cierre automático",
        text: "Se cerrará en 3 segundos.",
        type: "success",
        timer: 3000,
        showConfirmButton: false,
    });
}

function ingresarEstancia() {
    var Fecha = new Date();
    var Fecha2 = new Date();
    Fecha=$("#fechaEntrada").val();
    Fecha2=$("#fechaSalida").val();
    $idFolio = $("#dropSubfolio").val();
    $fechaEntrada = $("#fechaEntrada").val();
    $hotel = $("#dropHotel").val();
    $tarifa = $("#txtTarifa").val();
    $habitacion = $("#dropHabitacion").val();
    $fechaSalida = $("#fechaSalida").val();
    $num_habitaciones = $("#txtHabitaciones").val();
    $noches = $("#txtNoches").val();
    $total=$noches*$num_habitaciones*$tarifa;
    $("#txtTotal").val($total);
    var url = "./ajax/ajax_grupo.php";
    if (Fecha > Fecha2 ) {
        swal({
        title: "Importante!",
        text: "La fecha de entrada debe ser menor que la de salida",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
    });
    }else if (!$fechaEntrada || !$hotel || !$idFolio || !$tarifa || !$habitacion || !$fechaSalida || !$num_habitaciones || !$noches || !$total) {
        swal({
        title: "Importante!",
        text: "Se deben llenar todos los campos",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
    });
    }else {
        swal({
            title: "Importante!",
            text: "El total es:\n$"+$total,
            type: "info",
            timer: 3000,
            showConfirmButton: false,
        });
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 3, subfolio: $idFolio, fechaEntrada: $fechaEntrada,hotel:$hotel,tarifa:$tarifa,habitacion:$habitacion,fechaSalida:$fechaSalida,
                num_habitaciones:$num_habitaciones,noches:$noches,total:$total},
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
                    $totalFondo=$("#fondoActual").val();
                    $totalFondo-=$total;
                    $("#monto_meta").empty();
                    $("#monto_meta").text("M/actual: "+$totalFondo.toFixed(2));
                    $("#modalCotizacion").modal('toggle');
                } else {
                    swal("Error!", "Error al intentar crear el registro.", "warning");
                }
            }
        });
    }
}

function insertarSubfolio() {
    $idCotizacion = $("#idCotizacion").val();
    $subfolio = $("#txtSubFolio").val();
    $grupo=$("#idGrupo").val();
    var url = "./ajax/ajax_grupo.php";
    if(!$idCotizacion)$idCotizacion=0;
    if (!$subfolio) {
        $('#xmail2').hide().removeClass('hide').slideDown('slow');
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 2, idCotizacion: $idCotizacion, subfolio: $subfolio, grupo:$grupo},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    $id=datos.subfolio;
                    var f = new Date();
                    var fecha=f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
                    var fila = "<tr><td>"+$subfolio+"</td><td>"+fecha+"</td><tr>";
                    /*var fila = "<tr><td>"+$subfolio+"</td><td><a href=# class='eliminar' id=" + $id + " style='color:#FF0000;' onclick='eliminarGiro(this)'><i class='fa fa-qrcode' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td>"+
                            "<td><a href=javascript:void(0) onclick='modal(this)'><i class='fa fa-qrcode'></i>&nbsp;&nbsp;Editar</a></td><tr>";*/
                    $('#tabSubfolio tr:last').after(fila);
                    swal({
                        title: "Exito!",
                        text: "Se ha registrado correctamente.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                } else {
                    swal("Error!", "Error al intentar crear el registro.", "warning");
                }
            }
        });
    }

}

function actualizarGrupo() {
    $idCotizacion = $("#idCotizacion").val();
    $grupo = $("#txtNGrupo").val();
    $clave = $("#txtClave").val();
    $folio = $("#txtFolio").val();
    $numperso = $("#txtNumP").val();
    $pais=$("#dropPais").val();
    $disciplina=$("#dropDisGrupo").val();
    var url = "./ajax/ajax_grupo.php";
    if ($grupo.length<0 || $clave.length<0 || $folio.length<0 || $numperso.length<0|| $pais<0 || $disciplina<0) {
        swal("Error!", "Se deben llenar todos los campos.", "warning");
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idCotizacion: $idCotizacion, grupo:$grupo, clave:$clave, folio:$folio, numperso:$numperso, pais:$pais, disciplina:$disciplina},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    swal({
                        title: "Exito!",
                        text: "Se ha registrado correctamente.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    mostrarIndex(2);
                } else {
                    swal("Error!", "Error al intentar crear el registro.", "warning");
                }
            }
        });
    }

}



function eliminarCotizacion($idCotizacion){
    var url = "./ajax/ajax_grupo.php";
    swal({
        title: "¿Estas seguro de borrar la cotizacion?",
        text: "Una vez borrada la información no podrás recuperarla",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, borrar!",
        closeOnConfirm: false
    },
            function () {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {accion: 4, idCotizacion: $idCotizacion},
                    success: function (response) {
                        var datos = JSON.parse(response);
                        if (datos.estado != 0) {
                            swal({
                                title: "Registro borrado!",
                                text: "El registro se borro exitosamente.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            $("#home").click();
                        }//Para agregar notificacion en caso que si se alla eliminado
                    }
                });
            });
}
//Validar telefono
$(document).ready(function () {
    $('#txtTelefono').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length != 10) {
            $('#xmail2').hide().removeClass('hide').slideDown('slow');
        } else {
            $('#xmail2').hide().addClass('hide').slideDown('slow');
        }
    });
});

$(document).ready(function () {
    $("#correo").blur(function () {
        caracteresCorreoValido($(this).val(), '#xmail');
    });
});

function caracteresCorreoValido(email, div) {
    console.log(email);
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (caract.test(email) == false) {
        $(div).hide().removeClass('hide').slideDown('slow');

        return false;
    } else {
        $(div).hide().addClass('hide').slideDown('slow');
//        $(div).html('');
        return true;
    }
}

 function validarInput(boton,spa){
            $id=boton.id;
            $idS=spa;
            if($("#"+$id).val().length == 0){
                $("#"+$id).css("border-color","red");

                $("#"+$id+"Esp").html("<span><img src='./images/incorrect.png' width='10' height='10'></span>");
            }else{
                $("#"+$id+"Esp").html("<span><img src='./images/correct.png' width='10' height='10'></span>");
               $("#"+$id).css("border-color","green");
            }
        }

//---------------------------------------------Cargar archivo al servidor-----------------------
/*$(document).ready(function () {
    
    $(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function ()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (isImage(fileExtension)) {
            swal("Error!", "Error al intentar cargar el archivo.\n(Se debe seleccionar una documento)", "warning");
            $("#imagen").val("");
            $("#imagen").focus();
        }
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        //showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
    });

    //al enviar el formulario
    $(':button').click(function () {
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
        var imagen = $("#ruta_imagen").val();
        //hacemos la petición ajax  
        $.ajax({
            url: 'controlador/upload.php',
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {

            },
            //una vez finalizado correctamente
            success: function (data) {
                var url = "files/" + data;
                insertarRespuesta(url, imagen)
            },
        });
    });
})

//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch (extension.toLowerCase())
    {
        case 'jpg':
        case 'gif':
        case 'png':
        case 'jpeg':
            return true;
            break;
        default:
            return false;
            break;
    }
}*/