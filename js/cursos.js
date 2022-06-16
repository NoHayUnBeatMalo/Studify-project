var listar_curso = function () {

    $.ajax({
        url: "../controlador/cursos/controlador_listar_cursos.php",
        type: 'POST',
    }).done(function (res) {
        const dataNS = JSON.parse(res);


        console.log(dataNS["data"])

        table = $('#tabla_cursos').DataTable({
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

            data: dataNS["data"],
            'columns': [{
                    data: 'cod_curso'
                },
                {
                    data: 'nombre_curso'
                },
                {
                    data: 'descripcion'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'fechacurso'
                },
                {
                    data: 'precio_curso'
                },
                {
                    data: 'descuento'
                },
                {
                    data: 'fechapublicacion'
                },
                {
                    data: 'estado'
                },
                

                {
                    'defaultContent': "<button style='font-size:13px;' type='button' class='editar btn btn-primary'>Editar<i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button>"
                }
            ],


            'language': idioma_espanol,
            select: true
        });
    });
}
    
    $('input.global_filter').on('keyup click', function () {
        filterglobal();
    });
    $('input.colum_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'))
    });

function registrar_curso() {
    var nombrecurso = $("#txt_nombrecurso").val();
    var idprofesor = $("#txt_idprofesor").val();
    var fechacurso = $("#txt_fechacurso").val();
    console.log(fechacurso)
    var precio = $("#txt_precio").val();
    var descripcion = $("#txt_descripcion").val();
    var descuento = $("#txt_descuento").val();
    if (nombrecurso.length == 0 || fechacurso.length == 0 || descripcion.length == 0 || descuento.length == 0 ||  idprofesor.length == 0 || precio.length == 0) {
        Swal.fire("Mensaje de advertencia ", "Todos los campos deben tener datos", "warning")
    }

    $.ajax({
        url: '../controlador/cursos/controlador_registrar_curso.php',
        type: 'POST',
        data: {
            nombrecurso,
            idprofesor,
            fechacurso,
            precio,
            descripcion,
            descuento
        }
    }).done(function (resp) {
        $('#modal_registro').modal('hide');
        console.log('res:' + resp)
        if (resp == '0') {
            Swal.fire("Mensaje de advertencia ", "No hay un profesor registrado con este nombre", "warning")
        }else if(resp == '2'){
            Swal.fire("Mensaje de advertencia ", "No se ha podido introducir este curso en la base de datos", "warning")
    
        }else{
            
            listar_curso();
        }
    })
}

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
$('#tabla_cursos').on('click', '.editar', function () {
    var data = table.row($(this).parents('tr')).data();
    console.log(data)
    abrirModalEditar();
    $("#txt_idcurso_editar").val(data.cod_curso)
    $("#txt_nombrecurso_editar").val(data.nombre_curso)
    $("#txt_idprofesor_editar").val(data.id_profesor)
    $("#txt_fechacurso_editar").val(data.fechacurso)
    $("#txt_precio_editar").val(data.precio_curso)
    $("#txt_descripcion_editar").val(data.descripcion)
    $("#txt_descuento_editar").val(data.descuento)
})
$('#tabla_cursos').on('click', '.eliminar', function () {
    var data = table.row($(this).parents('tr')).data();
    console.log(data)
    
})

function modificar_curso() {
    var codcurso = $('#txt_idcurso_editar').val();
    var nombrecurso = $('#txt_nombrecurso_editar').val();
    var idprofesor = $('#txt_idprofesor_editar').val();
    var fechacurso = $('#txt_fechacurso_editar').val();
    var precio = $('#txt_precio_editar').val();
    var descripcion = $('#txt_descripcion_editar').val();
    var descuento = $('#txt_descuento_editar').val();
    console.log(codcurso)
    console.log(nombrecurso)
    console.log(idprofesor)
    console.log(fechacurso)
    console.log(precio)
    console.log(descripcion)
    console.log(descuento)
    if (codcurso.length == 0 || nombrecurso.length == 0 || idprofesor.length == 0 || fechacurso.length == 0 || precio.length == 0 || descripcion.length == 0 || descuento.length == 0) {
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
            codcurso, 
            nombrecurso,
            idprofesor, 
            fechacurso,
            precio, 
            descripcion,
            descuento
        }
    }).done(function (resp) {
        
        listar_curso();
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