function validarCodigoPostal()
{
    var input = document.getElementById("txt_codpostal_e").value;
    console.log(parseInt(input))
    if(input.length == 5 && parseInt(input) >= 1000 && parseInt(input) <= 52999)
    {
        alert("codigo valido");
    }
    else{
        alert("codigo invalido");
    }
}
var listar_estudiante = function () {

    $.ajax({
        url: "../controlador/estudiantes/controlador_listar_estudiantes.php",
        type: 'POST',
    }).done(function (res) {
        const dataNS = JSON.parse(res);


        console.log(dataNS)

        table = $('#tabla_estudiante').DataTable({
            'serverSide': false,
            'ordering': false,
            'orderCellsTop': true,
            'fixedHeader': true,
            'paging': false,
            'responsive': true,
            'searching': {
                'regex': true
            },
            'lengthMenu': [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],

            'pageLength': 10,

            'destroy': true,

            'async': false,

            'processing': true,

            data: dataNS,
            'columns': [{
                    data: 'id_usuario_estudiante'
                },
                {
                    data: 'id_estudiante'
                },
                {
                    data: 'poblacion'
                },
                {
                    data: 'provincia'
                },
                {
                    data: 'codigo_postal'
                },
                {
                    data: 'telefono'
                },

                {
                    'defaultContent': "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"
                }
            ],


            'language': idioma_espanol,
            select: true
        });
    });
}
function modificar_estudiante() {
    var idest = $('#txtidestudiante').val();
    var idusu =  $('#txtidusu').val();
    var poblacion = $('#txt_poblacion_editar').val();
    var provincia = $('#txt_provincia_editar').val();
    var codpostal = $('#txt_codpostal_editar').val();
    var tel = $('#txt_tel_editar').val();
    console.log(idest)
    console.log(idusu)
    console.log(poblacion)
    console.log(provincia)
    console.log(codpostal)
    console.log(tel)

    if (idest.length == 0 || poblacion.length == 0 || provincia.length == 0 || codpostal.length == 0 || tel.length == 0) {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Todos los campos son obligatorios',
            tipo: 'warning'
        });
    }
    $.ajax({
        "url": "../controlador/estudiantes/controlador_modificar_estudiante.php",
        type: 'POST',
        data: {
            idest, poblacion, provincia, codpostal, tel
        }
    }).done(function (resp) {
        listar_estudiante();
        
        console.log(resp)
        if (resp > 0) {
            $('#modal_editar').modal('hide');
            return Swal.fire(
                'Mensaje de confirmación',
                'Datos correctamente actualizados en el sistema.',
                'success'
            ).then(value => {
                table.ajax(reload);
            })
        } else {
            return Swal.fire({
                icon: 'error',
                title: 'Mensaje de error',
                text: 'Algo salió mal al actualizar el usuario',
                tipo: 'error'
            })
        }
    })

}
$('#tabla_estudiante').on('click', '.editar', function () {
    var data = table.row($(this).parents('tr')).data();
    console.log(data)
    abrirModalEditar();
    $("#txtidestudiante").val(data.id_estudiante)
    $('#txtidusu').val(data.id_usuario_estudiante);
    $("#txt_poblacion_editar").val(data.poblacion)
    $("#txt_provincia_editar").val(data.provincia)
    $("#txt_codpostal_editar").val(data.codigo_postal)
    $("#txt_tel_editar").val(data.telefono)
})
function abrirModalRegistro() {
    $('#modal_registro').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_registro').modal('show');
}

function abrirModalEditar() {
    $('#modal_editar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_editar').modal('show');
}