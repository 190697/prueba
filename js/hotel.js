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
        modal3($destino,0,0);
    });
});

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


function tablaHotel($id, $nombre) {
    var fila = "<tr><td>" + $nombre + "</td><td><a href=javascript:void(0) id=" + $id +
            " class='editar' onclick='editarHotel(this)'><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>\n\
            <td><a href=# class='eliminar' id=" + $id + " style='color:#FF0000;' onclick='eliminarHotel(this)'><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td><tr>";
    $('#TablaEmpresas tr:last').after(fila);
}

/*----------------------------------------------Modulo hotel----------------------------------------------*/
/*-----------------Insertar y/o editar hotel-------------------------*/
function insertarHotel() {    
    $idHotel = $("#txtIdHotel").val();
    $nombre = $("#txtNombreHotel").val();
    $editar = $("#txtEditarHotel").val();
    if (!$idHotel)$idHotel = 0;
    var url = "./ajax/ajax_hotel.php";
    if ($nombre.length < 1) {
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
        $("#txtNombreHotel").focus();
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idHotel:$idHotel,nombre: $nombre},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    $("#modalHotelform").modal('toggle');
                    $idHotel = datos.idHotel;
                    if($editar>0){
                        document.getElementById("TablaEmpresas").deleteRow($editar);
                    }
                    tablaHotel($idHotel, $nombre);
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

/*-----------------Eliminar Empresa-------------------------*/
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