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


function tablaRestaurant($id, $nombre,$correo) {
    var fila = "<tr><td>" + $nombre + "</td><td>" + $correo + "</td><td><a href=javascript:void(0) id=" + $id +
            " class='editar' onclick='editarRestaurant(this)'><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>\n\
            <td><a href=# class='eliminar' id=" + $id + " style='color:#FF0000;' onclick='eliminarRestaurant(this)'><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td><tr>";
    $('#TablaEmpresas tr:last').after(fila);
}

/*----------------------------------------------Modulo hotel----------------------------------------------*/
/*-----------------Insertar y/o editar hotel-------------------------*/
function insertarRestaurant() {    
    $idRestaurant = $("#txtIdRestaurant").val();
    $nombre = $("#txtNombreRestaurant").val();
    $correo = $("#txtCorreoRestaurant").val();
    $editar = $("#txtEditarRestaurant").val();
    if (!$idRestaurant)$idRestaurant = 0;
    var url = "./ajax/ajax_restaurant.php";
    if (!caracteresCorreoValido($correo, '#xmail') || $nombre.length < 1) {
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
        $("#txtNombreRestaurant").focus();
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idRestaurant:$idRestaurant,nombre: $nombre, correo:$correo},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    $("#modalRestaurantform").modal('toggle');
                    $idRestaurant = datos.idRestaurant;
                    if($editar>0){
                        document.getElementById("TablaEmpresas").deleteRow($editar);
                    }
                    tablaRestaurant($idRestaurant, $nombre,$correo);
                    swal("Exito!", "El registro se almaceno correctamente.", "success");
                } else {
                    swal("Error!", "Error al intentar crear la empresa.\nVerifique sus datos!", "warning");
                }
            }
        });
    }
}
/*-----------------Editar Empresa-------------------------*/
function editarRestaurant(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idRestaurant = boton.id;
    $destino = "vista/restaurant/form_restaurant.php";
    modal3($destino,$idRestaurant,i);
}

/*-----------------Eliminar Empresa-------------------------*/
function eliminarRestaurant(boton) {
    $idRestaurant = boton.id;
    var url = "./ajax/ajax_restaurant.php";
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
                data: {accion: 2, idRestaurant: $idRestaurant},
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

$(document).ready(function () {
    $("#txtCorreoRestaurant").blur(function () {
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