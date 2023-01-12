function validarCodigoPostal() {
    var input = document.getElementById("txt_codpostal_p").value;
    console.log(parseInt(input))
    if (input.length == 5 && parseInt(input) >= 1000 && parseInt(input) <= 52999) {
        alert("codigo valido");
    } else {
        alert("codigo invalido");
    }
}
var table = $('#tabla_profesor').DataTable();

var listar_profesor = function () {

    $.ajax({
        url: "../controlador/profesores/controlador_listar_profesores.php",
        type: 'POST',
    }).done(function (res) {
        const dataNS = JSON.parse(res);

        console.log(res)
        console.log(dataNS)

        table = $('#tabla_profesor').DataTable({
            'serverSide': false,
            'ordering': true,
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
                    data: 'id_usuario_profesor'
                },
                {
                    data: 'id_profesor'
                },
                {
                    data: 'nombre'
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
$('#tabla_profesor').on('click', '.editar', function () {
    var data = table.row($(this).parents('tr')).data();
    console.log(data)
    abrirModalEditar();
    $("#txtidprofesor").val(data.id_profesor)
    $("#txtidusu").val(data.id_usuario_profesor)
    $("#txt_nombre_editar").val(data.nombre)
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

function registrar_profesor() {
    var idusu = $("#txt_idusu_p").val();
    console.log(idusu)
    var nombre = $("#txt_nombre_p").val();
    var poblacion = $("#txt_poblacion_p").val();
    var provincia = $("#txt_provincia_p").val();
    var codpostal = $("#txt_codpostal_p").val();
    var tel = $("#txt_tel_p").val();
    var tipoid = 2;
    if (idusu.length == 0 || nombre.length == 0 || poblacion.length == 0 || provincia.length == 0 || codpostal.length == 0 || tel.length == 0) {
        Swal.fire("Mensaje de advertencia ", "Todos los campos deben tener datos", "warning")
    }

    $.ajax({
        url: '../controlador/profesores/controlador_registrar_profesor.php',
        type: 'POST',
        data: {
            idusu,
            nombre,
            poblacion,
            provincia,
            codpostal,
            tel
        }
    }).done(function (resp) {
        console.log('id:' + idusu)
        console.log('tipo:' + tipoid)
        console.log('res:' + resp)
        if (resp != '1') {
            Swal.fire("Mensaje de advertencia ", "No se ha podido introducir este profesor en la base de datos", "warning")
        } else {
            listar_profesor();
            $('#modal_registro').modal('hide');
            $.ajax({
                url: '../controlador/usuario/controlador_cambiar_tipo.php',
                type: 'POST',
                data: {
                    idusu,
                    tipoid
                }
            }).done(function (res) {
                console.log(res)

            })

        }
    })
}

function modificar_profesor() {
    var idprof = $('#txtidprofesor').val();
    var idusu = $('#txtidusu').val();
    var nombre = $('#txt_nombre_editar').val();
    var poblacion = $('#txt_poblacion_editar').val();
    var provincia = $('#txt_provincia_editar').val();
    var codpostal = $('#txt_codpostal_editar').val();
    var tel = $('#txt_tel_editar').val();
    console.log(nombre)
    console.log(poblacion)
    console.log(provincia)
    console.log(codpostal)
    console.log(tel)
    if (idprof.length == 0 || nombre.length == 0 || poblacion.length == 0 || provincia.length == 0 || codpostal.length == 0 || tel.length == 0) {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Todos los campos son obligatorios',
            tipo: 'warning'
        });
    }
    $.ajax({
        "url": "../controlador/profesores/controlador_modificar_profesor.php",
        type: 'POST',
        data: {
            idprof,
            nombre,
            poblacion,
            provincia,
            codpostal,
            tel
        }
    }).done(function (resp) {
        console.log(resp)
        if (resp == '') {
            $('#modal_editar').modal('hide');
            return Swal.fire(
                'Mensaje de confirmación',
                'Datos correctamente actualizados en el sistema.',
                'success'
            ).then(value => {

                table.destroy();
                table = $('#tabla_profesor').DataTable();
                
                console.log(value);
                if (value.isConfirmed) {

                    listar_profesor();
                }
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

function limpiar_registro() {
    $('#txt_nombre_p').val("");
    $('#txt_poblacion_p').val("");
    $('#txt_provincia_p').val("");
    $('#txt_codpostal_p').val("");
    $('#txt_tel_p').val("");
}


function traer_datos_usuario() {
    var usuario = $('#usuarioprincipal').val()
    console.log(usuario)
    $.ajax({
        url: '../controlador/usuario/controlador_traer_datos_usuario.php',
        type: 'POST',
        data: {
            usuario: usuario
        }

    }).done(function (resp) {
        console.log(resp)
        var data = JSON.parse(resp)
        console.log(data)
        if (data.length > 0) {
            $('#txtcontra_bd').val(data[0]['contrasena']);
            if (data[0]['sexo'] == 'MASCULINO') {
                $('#img_nav').attr('src', '../plantilla/dist/img/avatar5.png')
                $('#img_subnav').attr('src', '../plantilla/dist/img/avatar5.png')
                $('#img_lateral').attr('src', '../plantilla/dist/img/avatar5.png')
            } else {
                $('#img_nav').attr('src', '../plantilla/dist/img/avatar3.png')
                $('#img_subnav').attr('src', '../plantilla/dist/img/avatar5.png')
                $('#img_lateral').attr('src', '../plantilla/dist/img/avatar5.png')
            }
        }
    })
}