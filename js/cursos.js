function listar_curso() {
    var tableCurso = $('#tabla_cursos').DataTable({
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

        'ajax': {
            url: "../controlador/cursos/controlador_listar_cursos.php",
            type: 'POST'
        },
        'order': [
            [1, "asc"]
        ],
        'columns': [{
                'defaultContent': ''
            },
            {
                data: 'cod_curso'
            },
            {
                data: 'nombre_curso'
            },
            {
                data: 'nombre'
            },
            {
                data: 'horas_curso'
            },
            {
                data: 'precio_curso'
            },
            {
                data: 'fechapublicacion'
            },
            {
                data: 'participantes'
            },
            {
                data: 'estado'
            },

            {
                'defaultContent': "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"
            }
        ],


        'language': idioma_espanol,
        select: true
    });
    document.getElementById('tabla_cursos_filter').style.display = none;
    $('input.global_filter').on('keyup click', function () {
        filterglobal();
    });
    $('input.colum_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'))
    });



}

function abrirModalRegistro() {
    $('#modal_registro').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_registro').modal('show');

}

function registrar_usuario() {
    var nombrecurso = $("#txt_nombrecurso").val();
    var nombreprofesor = $("#txt_nombreprofesor").val();
    var horas = $("#txt_horas").val();
    var precio = $("#txt_precio").val();
    if (nombrecurso.length == 0 || nombreprofesor.length == 0 || horas.length == 0 || precio.length == 0) {
        Swal.fire("Mensaje de advertencia ", "Todos los campos deben tener datos", "warning")
    }

    $.ajax({
        url: '../controlador/cursos/controlador_registrar_curso.php',
        type: 'POST',
        data: {
            nombrecurso,
            nombreprofesor,
            horas,
            precio
        }
    }).done(function (resp) {
        $('#modal_registro').modal('hide');
        console.log('res:')
        if (resp == '0') {
            Swal.fire("Mensaje de advertencia ", "No hay un profesor registrado con este nombre", "warning")
        }else if(resp == '2'){
            Swal.fire("Mensaje de advertencia ", "No se ha podido introducir este curso en la base de datos", "warning")
    
        }else{
            
            listar_curso();
        }
    })
}

function abrirModalEditar() {
    $('#modal_editar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_editar').modal('show');
}

function modificar_curso() {
    var codcurso = $('#txt_usu_editar').val();
    var nombrecurso = $('#txt_nombre_editar').val();
    var horascurso = $('#txt_apellidos_editar').val();
    var preciocurso = $('#txt_fnac_editar').val();
    var nombreprofesorcurso = $('#txt_correo_editar').val();
    var participantescurso = document.getElementById('cbm_rol_editar').value;
    var sexo = document.getElementById('cbm_sexo_editar').value;
    console.log(usu)
    console.log(nombre)
    console.log(apellidos)
    console.log(fecha_nacimiento)
    console.log(correo)
    console.log(rol)
    console.log(sexo)
    if (usu.length == 0 || nombre.length == 0 || apellidos.length == 0 || fecha_nacimiento.length == 0 || correo.length == 0 || rol.length == 0 || sexo.length == 0) {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Todos los campos son obligatorios',
            tipo: 'warning'
        });
    }
    $.ajax({
        "url": "../controlador/cursos/controlador_modificar_curso.php",
        type: 'POST',
        data: {
            codcurso: codcurso,
            nombre: nombrecurso,
            horas: horascurso,
            precio: preciocurso,
            nombreprofesor: nombreprofesorcurso,
            participantes: participantescurso
        }
    }).done(function (resp) {
        console.log(resp)
        if (resp > 0) {
            $('#modal_editar').modal('hide');
            return Swal.fire(
                'Mensaje de confirmación',
                'Datos correctamente actualizados en el sistema.',
                'success'
            ).then(value => {

                table.ajax(reload);
                traer_datos_usuario();
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