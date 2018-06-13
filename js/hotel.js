/*-----------------Abrir modal empresa y giro-------------------------*/
$(document).ready(function () {
    $("#linkModal1").click(function () {
        $destino = $("#linkModal1").attr("form");
        modal3($destino,0,0);
        $("#txtIdGiro").val(0);
        $("#txtEditarGiro").val(0);
        $("#txtNombreGiro").val("");
        $("#txtDetalleGiro").val("");
    });
});

$(document).ready(function () {
    $("#linkModal").click(function () {
        $destino = $("#linkModal").attr("form");
        $("#linkModal").hide();
        $("#SpinnPrincipal").show();
        modal3($destino,0,0);
        setTimeout(function(){ 
            $("#linkModal").show();
            $("#SpinnPrincipal").hide();
        }, 2000);
    });
});

function respuestaForm(boton){
    $id=boton.id;
    $destino = $("#"+$id).attr("form");
        $("#"+$id).hide();
        $("#SpinnPrincipa"+$id).show();
        modal3($destino,0,0);
        setTimeout(function(){ 
            $("#"+$id).show();
            $("#SpinnPrincipa"+$id).hide();
        }, 2000);
}

function modal3($destino,$id,$editar) {
    $("#modalform").empty();
    if($id>0){
        $.post($destino,{id:$id,editar:$editar})
            .done(function (data) {
                $("#modalform").html(data);
            });
    }else{
        $.post($destino,)
            .done(function (data) {
                $("#modalform").html(data);
            });
    }
}


function tablaHotel($id, $nombre,$correo) {
    var fila = "<tr><td>" + $nombre + "</td><td>" + $correo + "</td><td><a href=javascript:void(0) id=" + $id +
            " class='editar' onclick='editarHotel(this)'><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>\n\
            <td><a href=# class='eliminar' id=" + $id + " style='color:#FF0000;' onclick='eliminarHotel(this)'><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td><tr>";
    $('#TablaEmpresas tr:last').after(fila);
}

function tablaHabitacion($id, $nombre,$costo) {
    var fila = "<tr><td>" + $nombre + "</td><td>" + $costo + "</td><td><a href=javascript:void(0) id=" + $id +
            " class='editar' onclick='editarHotel(this)'><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>\n\
            <td><a href=# class='eliminar' id=" + $id + " style='color:#FF0000;' onclick='eliminarHabitacion(this)'><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td><tr>";
    $('#TablaHabitaciones tr:last').after(fila);
}
/*----------------------------------------------Modulo hotel----------------------------------------------*/
/*-----------------Insertar y/o editar hotel-------------------------*/
function insertarHotel() {    
    $idHotel = $("#txtIdHotel").val();
    $editar = $("#txtEditarHotel").val();
    $nombre = $("#txtNombreHotel").val();
    $correo = $("#txtCorreoHotel").val();
    $contra="!454_1!.";
    if (!$idHotel)$idHotel = 0;
    var url = "./ajax/ajax_hotel.php";
    if (!caracteresCorreoValido($correo, '#xmail') || $nombre.length < 1) {
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
        $("#txtNombreHotel").focus();
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idHotel:$idHotel,nombre: $nombre, correo:$correo,contrasenhia:$contra},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    $("#modalHotelform").modal('toggle');
                    swal({
                        title: "Exito!",
                        text: "El registro se almaceno correctamente.",
                        type: "success",
                        timer: 3000,
                        showConfirmButton: false,
                    });
                    setTimeout(function(){ 
                        $("#sideHotel").click();
                    }, 300);
                    swal("Exito!", "El registro se almaceno correctamente.", "success");
                } else {
                    swal("Error!", "Error al intentar crear la empresa.\nVerifique sus datos!", "warning");
                }
            }
        });
    }
}
/*-----------------Editar Empresa-------------------------*/
function editarHotel(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idHotel = boton.id;
    $destino = "vista/hotel/form_hotel.php";
    modal3($destino,$idHotel,i);
}

function habitacionesHotel(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idHotel = boton.id;
    $destino = "vista/hotel/form_habitacion.php";
    modal3($destino,$idHotel,i);
}

/*-----------------Eliminar hotel-------------------------*/
function eliminarHotel(boton) {
    $idHotel = boton.id;
    var url = "./ajax/ajax_hotel.php";
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
                data: {accion: 2, idHotel: $idHotel},
                success: function (response) {
                    var datos = JSON.parse(response);
                    if (datos.estado != 0) {
                        /*Eliminar registro tabla*/
                        var i = boton.parentNode.parentNode.rowIndex;
                        document.getElementById("TablaEmpresas").deleteRow(i);
                        swal("Exito!", "El registro se elimino correctamente.", "success"); 
                    } else {
                        swal("Error!", "Error al intentar eliminar el giro.", "warning");
                    }
                }
            });
        });
}

function mostrarTipoHabitacion(div){
    if(div===1){
        $("#agregarHab").hide();
        $("#regresarHab").show();
        $("#habitacionesDiv").hide();
        $("#nuevaHabitacion").show(280);
        $("#txtHabitacion").val("");
        $("#txtDetalleHab").val("");
        $("#txtEditarHabitacion").val(0);
        $("#txtIdHabitacion").val(0);
    }else{
        $("#regresarHab").hide();
        $("#agregarHab").show();
        $("#nuevaHabitacion").hide();
        $("#habitacionesDiv").show(280);
        
        
    }
    
}

function mostrarTipoHabitacionHotel(div){
    if(div===1){
        $("#agregarHab").hide();
        $("#regresarHab").show();
        $("#habitacionesDiv").hide();
        $("#nuevaHabitacion").show(280);
        $("#txtNombreHab").val("");
        $("#txtCostoHab").val("");
        $("#txtEditarHabitacion").val(0);
        $("#txtIdHabitacion").val(0);
    }else{
        $("#regresarHab").hide();
        $("#agregarHab").show();
        $("#nuevaHabitacion").hide();
        $("#habitacionesDiv").show(280);
        
        
    }
    
}

function registrarHabitacion(){
    $editar = $("#txtEditarHabitacion").val();
    $habitacion=$("#txtHabitacion").val();
    $detalle=$("#txtDetalleHab").val();
    if($habitacion.length<1 || $detalle.length<1){
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
    }else{
        var url = "./ajax/ajax_hotel.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#nuevaHabitacion").serialize(),
                success: function (response)
                {
                    var datos = JSON.parse(response);
                    if (datos.estado != 0) {
                        mostrarTipoHabitacion(2);
                        $idHabitacion = datos.idHabitacion;
                        if($editar>0){
                            document.getElementById("TablaHabitaciones").deleteRow($editar);
                        }
                        $("#msjtabla").hide();
                        tablaHabitacion($idHabitacion, $habitacion,$detalle);
                        swal("Exito!", "El registro se almaceno correctamente.", "success");
                    } else {
                        swal("Error!", "Error al intentar crear el registro.\nVerifique sus datos!", "warning");
                    }
                }
            });
    }
}

function registrarHabitacionHotel(){
    $idHotel = $("#txtIdHotel").val();
    $editar = $("#txtEditarHabitacion").val();
    $habitacion=$("#txtIdHab").val();
    $textoHabitacion=$("#txtIdHab option:selected").text();
    $costo=$("#txtCostoHab").val();
    if($habitacion.length<1 || $costo.length<1){
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
    }else{
        var url = "./ajax/ajax_hotel.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#nuevaHabitacion").serialize(),
                success: function (response)
                {
                    var datos = JSON.parse(response);
                    if (datos.estado != 0) {
                        mostrarTipoHabitacion(2);
                        $idHabitacion = datos.idHabitacion;
                        if($editar>0){
                            document.getElementById("TablaHabitaciones").deleteRow($editar);
                        }
                        $("#msjtabla").hide();
                        tablaHabitacion($idHabitacion, $textoHabitacion,("$"+$costo));
                        swal("Exito!", "El registro se almaceno correctamente.", "success");
                    } else {
                        swal("Error!", "Error al intentar crear crear el registro.\nVerifique sus datos!", "warning");
                    }
                }
            });
    }
}

/*-----------------Eliminar TipoHabitacion-------------------------*/
function eliminarHabitacion(boton) {
    $idHabitacion = boton.id;
    var url = "./ajax/ajax_hotel.php";
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
                data: {accion: 6, idHabitacion: $idHabitacion},
                success: function (response) {
                    var datos = JSON.parse(response);
                    if (datos.estado != 0) {
                        /*Eliminar registro tabla*/
                        var i = boton.parentNode.parentNode.rowIndex;
                        document.getElementById("TablaHabitaciones").deleteRow(i);
                        swal("Exito!", "El registro se elimino correctamente.", "success"); 
                    } else {
                        swal("Error!", "Error al intentar eliminar el giro.", "warning");
                    }
                }
            });
        });
}

function eliminarHabitacionHotel(boton) {
    $idHabitacion = boton.id;
    var url = "./ajax/ajax_hotel.php";
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
                data: {accion: 4, idHabitacion: $idHabitacion},
                success: function (response) {
                    var datos = JSON.parse(response);
                    if (datos.estado != 0) {
                        /*Eliminar registro tabla*/
                        var i = boton.parentNode.parentNode.rowIndex;
                        document.getElementById("TablaHabitaciones").deleteRow(i);
                        swal("Exito!", "El registro se elimino correctamente.", "success"); 
                    } else {
                        swal("Error!", "Error al intentar eliminar el giro.", "warning");
                    }
                }
            });
        });
}

function editarHabitacion(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    var id=boton.id;
    var nombre=document.getElementById('TablaHabitaciones').tBodies[0].rows[(i-1)].cells[0].innerHTML;
    var detalle=document.getElementById('TablaHabitaciones').tBodies[0].rows[(i-1)].cells[1].innerHTML;
    mostrarTipoHabitacion(1);
    $("#txtHabitacion").val(nombre);
    $("#txtDetalleHab").val(detalle);
    $("#txtEditarHabitacion").val(i);
    $("#txtIdHabitacion").val(id);
    
}

function editarHabitacionHotel(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    var id=boton.id;
    var nombre=document.getElementById('TablaHabitaciones').tBodies[0].rows[(i-1)].cells[0].innerHTML;
    var costo=document.getElementById('TablaHabitaciones').tBodies[0].rows[(i-1)].cells[1].innerHTML;
    var res =parseFloat(costo.substring(1));
    mostrarTipoHabitacionHotel(1);
    $("#txtIdHab option["+ nombre +"]").attr("selected",true);
    $("#txtCostoHab").val(res);
    $("#txtEditarHabitacion").val(i);
    $("#txtIdHabitacion").val(id);
    
}


$(document).ready(function () {
    $("#txtCorreoHotel").blur(function () {
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

function respuesta(){
    $idEstancia = $("#actualizarEstancia").val();
    $estatus = $("#estado:checked").val();
    var url = "./ajax/ajax_hotel.php";
    if(!$estatus){
        swal("Selecciona alguna una opción!", "", "error");
    }else{
        swal({ 
        title: "¿Responder solicitud?",
        text: "Desea realizar este movimiento...",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2980B9",
        confirmButtonText: "¡Aceptar!",
        cancelButtonText: "Cancelar", 
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        showLoaderOnCancel: true},

        function(isConfirm){ 
            if (isConfirm) {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {accion: 7, idEstancia: $idEstancia, estado: $estatus},
                    success: function (response) {
                        var datos = JSON.parse(response);
                        if (datos.estado != 0) {
                            /*Eliminar registro tabla*/
                            swal({
                                title: "Exito!",
                                text: "La respuesta se envio correctamente.",
                                type: "success",
                                timer: 3000,
                                showConfirmButton: false,
                            });
                            setTimeout(function(){ 
                                location.reload();
                            }, 3000);
                        } else {
                            swal("Error!", "Error al intentar enviar respuesta.", "warning");
                        }
                    }
                });
            }
        });
    }
}

function enviarCredenciales(boton) {
    $idHotel = boton.id;
    var i = boton.parentNode.parentNode.rowIndex;
    var nombre=document.getElementById('TablaEmpresas').tBodies[0].rows[(i-1)].cells[0].innerHTML;
    var correo=document.getElementById('TablaEmpresas').tBodies[0].rows[(i-1)].cells[1].innerHTML;
    var url = "./ajax/ajax_hotel.php";
    swal({ 
        title: "¿Desea enviar las credenciales de acceso?",
        text: "Confirme este movimiento",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#2980B9",
        confirmButtonText: "¡Aceptar!",
        cancelButtonText: "Cancelar", 
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        showLoaderOnCancel: true},

        function(isConfirm){ 
            if (isConfirm) {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {accion: 8, idHotel:$idHotel,nombre: nombre, correo:correo},
                    success: function (response) {
                        var datos = JSON.parse(response);
                        if (datos.estado != 0) {
                            swal("Exito!", "Se enviaron las credenciales correctamente.", "success"); 
                        } else {
                            swal("Error!", "Error al intentar enviar las credenciales.", "warning");
                        }
                    }
                });
            }
        });
}