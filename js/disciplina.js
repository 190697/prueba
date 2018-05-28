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

function tablaDisciplina($id, $nombre,$descripcion) {
    var fila = "<tr><td>" + $nombre + "</td><td>" + $descripcion + "</td><td><a href=javascript:void(0) id=" + $id +
            " class='editar' onclick='editarDisciplina(this)'><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>\n\
            <td><a href=# class='eliminar' id=" + $id + " style='color:#FF0000;' onclick='eliminarDisciplina(this)'><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td><tr>";
    $('#TablaEmpresas tr:last').after(fila);
}

/*----------------------------------------------Modulo disciplina----------------------------------------------*/
/*-----------------Insertar y/o editar disciplina-------------------------*/
function insertarDisciplina() {    
    $idDisciplina = $("#txtIdDisciplina").val();
    $descripcion = $("#txtDescripcionDisciplina").val();
    $nombre = $("#txtNombreDisciplina").val();
    $editar = $("#txtEditarDisciplina").val();
    if (!$idDisciplina)$idDisciplina = 0;
    var url = "./ajax/ajax_disciplina.php";
    if ($nombre.length < 1) {
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
        $("#txtNombreDisciplina").focus();
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, idDisciplina:$idDisciplina,nombre: $nombre, descripcion:$descripcion},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    $("#modalDisciplinaform").modal('toggle');
                    $idDisciplina = datos.idDisciplina;
                    if($editar>0){
                        document.getElementById("TablaEmpresas").deleteRow($editar);
                    }
                    tablaDisciplina($idDisciplina, $nombre,$descripcion);
                    swal("Exito!", "El registro se almaceno correctamente.", "success");
                } else {
                    swal("Error!", "Error al intentar crear la empresa.\nVerifique sus datos!", "warning");
                }
            }
        });
    }
}
/*-----------------Editar Empresa-------------------------*/
function editarDisciplina(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idDisciplina = boton.id;
    $destino = "vista/disciplinas/form_disciplina.php";
    modal3($destino,$idDisciplina,i);
}

/*-----------------Eliminar Empresa-------------------------*/
function eliminarDisciplina(boton) {
    $idDisciplina = boton.id;
    var url = "./ajax/ajax_disciplina.php";
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
                data: {accion: 2, idDisciplina: $idDisciplina},
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