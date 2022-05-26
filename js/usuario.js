function verificarUsuario() {
    var usu = $("#txt_usu").val();
    var con = $("#txt_con").val();
    if (usu.length == 0 || con.length == 0) {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Todos los campos son obligatorios',
            tipo: 'warning'
        });
    }
    $.ajax({
        url: '../controlador/usuario/controlador_verificar_usuario.php',
        type: 'POST',
        data: {
            user: usu,
            pass: con
        }
    }).done(function (res) {
        if (res == 0) {
            console.log(res);
            Swal.fire('Mensaje de error', 'Los datos que has introducido no son correctos', 'error');
        } else {
            var data = JSON.parse(res);
            console.log('<br>' + res);
            console.log(data)
            if (data[0]['estado'] === 'INACTIVO') {
                return Swal.fire('Mensaje de advertencia', 'Lo sentimos, el usuario ' + usu + ' se encuentra suspendido. Comuniquese con el administrados del sistema', 'warning');
            }
            $.ajax({
                url: '../controlador/usuario/controlador_crear_session.php',
                type: 'POST',
                data: {
                    idusuario: data[0]['idusuario'],
                    user: data[0]['nombre_usuario'],
                    rol: data[0]['rol_id']
                }
            }).done(function (res) {
                let timerInterval
                Swal.fire({
                    title: '¡Bienvenido al sistema!',
                    html: 'Será redireccionado en <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload()
                    }
                })
            })

        }
    })
}
var table;
var listar_usuario = function () {

    $.ajax({
        url: "../controlador/usuario/controlador_listar_usuario.php",
        type: 'POST',
    }).done(function (res) {
        const dataNS = JSON.parse(res);


        console.log(dataNS)

        table = $('#tabla_usuario').DataTable({
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
                    data: 'idusuario'
                },
                {
                    data: 'nombre_usuario'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'apellidos'
                },
                {
                    data: 'fecha_nacimiento'
                },
                {
                    data: 'correo'
                },
                {
                    data: 'estado',


                    render: function (data, type, row) {
                        if (data == 'ACTIVO') {
                            return "<span class='badge badge-success'>" + data + "</span>";
                        } else {
                            return "<span class='badge badge-danger'>" + data + "</span>";
                        }
                    }
                },

                {
                    data: 'rol_nombre'
                },
                {
                    'defaultContent': "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>"
                }
            ],


            'language': idioma_espanol,
            select: true
        });
    });
}

//desactivar usuario
$('#tabla_usuario').on('click', '.desactivar', function () {
    var data = table.row($(this).parents('tr')).data();
    console.log(data)
    console.log(data.idusuario)
    if (data.idusuario > 0) {
        Swal.fire({
            title: '¿Estás seguro de que quieres desactivar el usuario?',
            text: "Cuando está inactivo el usuario no tendrá acceso al sistema",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, desactívalo'
        }).then((result) => {

            if (result.value) {
                modificar_estatus(data.idusuario, 'INACTIVO');
            }
        })
    }
})

//activar usuario
$('#tabla_usuario').on('click', '.activar', function () {
    var data = table.row($(this).parents('tr')).data();
    console.log(data)
    console.log(data.idusuario)
    if (data.idusuario > 0) {
        Swal.fire({
            title: '¿Estás seguro de que quieres desactivar el usuario?',
            text: "Cuando está inactivo el usuario no tendrá acceso al sistema",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, desactívalo'
        }).then((result) => {

            if (result.isConfirmed) {
                modificar_estatus(data.idusuario, 'ACTIVO');
                table.ajax.reload();
            }
        })
    }
})

//editar usuario
$('#tabla_usuario').on('click', '.editar', function () {
    var data = table.row($(this).parents('tr')).data();
    abrirModalEditar();
    $("#txtidusuario").val(data.idusuario)
    $("#txt_usu_editar").val(data.nombre_usuario)
    $("#txt_nombre_editar").val(data.nombre)
    $("#txt_apellidos_editar").val(data.apellidos)
    $("#txt_fnac_editar").val(data.fecha_nacimiento)
    $("#txt_correo_editar").val(data.correo)
    $("#cbm_rol_editar").val(data.rol).trigger('change')
})

function modificar_estatus(idusuario, estatus) {

    $.ajax({
        "url": "../controlador/usuario/controlador_modificar_estatus_usuario.php",
        type: 'POST',
        data: {
            idusuario: idusuario,
            estatus: estatus
        }
    }).done(function (resp) {

        console.log('repsuesta mod estatus ' + resp)

        if (resp > 0) {
            Swal.fire(
                'Mensaje de confirmación',
                'El estado del usuario se ha cambiado de forma correcta',
                'success')


            table.ajax.reload();
        } else {
            Swal.fire(
                'Mensaje de advertencia',
                'No se ha podido modificar el estatus',
                'warning'
            )
        }
    })

}

$('input.global_filter').on('keyup click', function () {
    filterGlobal();
});
$('input.global_filter').on('keyup click', function () {
    filterColumn($(this).parents('tr').attr('data-column'));
});

function filterGlobal() {
    $('#tabla_usuario').DataTable().search(
        $('#global_filter').val(),
    ).draw();
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


function listar_rol() {
    $.ajax({
        "url": "../controlador/usuario/controlador_listar_rol.php",
        type: 'POST'
    }).done(function (res) {
        console.log('res: ' + res)
        var data = JSON.parse(res);
        var cadena = '';
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                console.log('data: ' + data[i]['rol_id'])
                cadena += "<option value='" + data[i]['rol_id'] + "'>" + data[i]['rol_nombre'] + "</option>";
            }
            $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena)
            console.log($("#cbm_rol_editar").html(cadena))
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";

            $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena);

        }
    })
}

function registrar_usuario() {
    var usu = $('#txt_usu').val();
    var nombre = $('#txt_nombre').val();
    var apellidos = $('#txt_apellidos').val();
    var fecha_nacimiento = $('#txt_fnac').val();
    var correo = $('#txt_correo').val();
    var con1 = $('#txt_con1').val();
    var con2 = $('#txt_con2').val();
    var rol = document.getElementById('cbm_rol').value;
    var sexo = document.getElementById('cbm_sexo').value;
    console.log(usu)
    console.log(nombre)
    console.log(apellidos)
    console.log(fecha_nacimiento)
    console.log(correo)
    console.log(con1)
    console.log(con2)
    console.log(rol)
    console.log(sexo)
    if (usu.length == 0 || nombre.length == 0 || apellidos.length == 0 || fecha_nacimiento.length == 0 || correo.length == 0 || con1.length == 0 || con2.length == 0 || rol.length == 0 || sexo.length == 0) {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Todos los campos son obligatorios',
            tipo: 'warning'
        });
    }
    if (con1 != con2) {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Las contraseñas deben coincidir',
            tipo: 'warning'
        })
    }
    $.ajax({
        "url": "../controlador/usuario/controlador_registrar_usuario.php",
        type: 'POST',
        data: {
            usuario: usu,
            nom: nombre,
            ape: apellidos,
            fnac: fecha_nacimiento,
            contrasena: con1,
            email: correo,
            rol: rol,
            sexo: sexo
        }
    }).done(function (resp) {
        console.log(resp)
        if (resp > 0) {
            if (resp == 1) {
                $('#modal_registro').modal('hide');
                return Swal.fire(
                        'Mensaje de confirmación',
                        'Datos correctamente introducidos en el sistema. Nuevo usuario registrado',
                        'success'
                    )
                    .then((value) => {
                        limpiar_registro();
                        table.ajax.reload();
                    })
            } else {
                return Swal.fire('Mensaje de advertencia', 'Lo sentimos, el nombre de usuario ya se encuentra en nuestra base de datos',
                    'warning'
                )
            }

        } else {
            return Swal.fire({
                icon: 'error',
                title: 'Mensaje de error',
                text: 'Algo salió mal al introducir el usuario',
                tipo: 'error'
            })
        }
    })

}

function modificar_usuario() {
    var usu = $('#txt_usu_editar').val();
    var nombre = $('#txt_nombre_editar').val();
    var apellidos = $('#txt_apellidos_editar').val();
    var fecha_nacimiento = $('#txt_fnac_editar').val();
    var correo = $('#txt_correo_editar').val();
    var rol = document.getElementById('cbm_rol_editar').value;
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
        "url": "../controlador/usuario/controlador_modificar_usuario.php",
        type: 'POST',
        data: {
            usu: usu,
            nom: nombre,
            ape: apellidos,
            fnac: fecha_nacimiento,
            email: correo,
            rol: rol,
            sexo: sexo
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

function limpiar_registro() {
    $('#txt_usu').val("");
    $('#txt_nombre').val("");
    $('#txt_apellidos').val("");
    $('#txt_fnac').val("");
    $('#txt_correo').val("");
    $('#txt_con1').val("");
    $('#txt_con2').val("");
    $('#cbm_rol').val("");
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

function abrir_modal_editar_contrasena() {
    $('#modal_editar_contra').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_editar_contra').modal('show');
    $('#modal_editar_contra').on('shown.bs.modal', function () {
        $('#txt_contra_actual_editar').focus();
    });
}

function editar_contrasena(){
    var idusuario = $('#txtidprincipal').val();
    var contrabd = $('#txtcontra_bd').val();
    var contraActual = $('#txt_contra_actual_editar').val();
    var contraNueva = $('#txt_contra_nueva_editar').val();
    var contraNuevaRepetir = $('#txt_contra_repetir_editar').val();
    if(idusuario.length == 0 || contrabd.length == 0 || contraActual.length == 0 || contraNueva.length == 0 || contraNuevaRepetir.length == 0){
        return Swal.fire(
            'Mensaje de advertencia', 'Todos los datos son requeridos', 'warning'
        )
    }
    if(contraNueva != contraNuevaRepetir){
        return Swal.fire(
            'Mensaje de advertencia', 'Debes ingresar la misma clave dos veces', 'warning'
        )
    }
    $.ajax({
        'url': '../controlador/usuario/controlador_editar_contra.php',
        type: 'POST',
        data:{
            idusuario: idusuario,
            contrabd: contrabd,
            contraActual: contraActual,
            contraNueva: contraNueva,
        }
    }).done(function(resp){
        console.log(resp)
        if(resp == 0){
            Swal.fire(
                'Mensaje de advertencia', 'La contrase&ntilde;a actual que has introducido no coincide con la de la base de datos.', 'warning'
        )
        }else if(resp == 1){
            
        $('#modal_editar_contra').modal('hide');
        
        limpiar_editar_contrasena(); 
            Swal.fire(
                'Mensaje de confirmación',
                'La contrase&ntilde;a ha sido actualizada',
                'success').then((value) => {
                    traer_datos_usuario();
                })
        }else{
            Swal.fire(
                'Mensaje de advertencia', 'No se ha podido introducir en la base de datos', 'warning'
        )
        }
    })
}

function limpiar_editar_contrasena(){
    var idusuario = $('#txtidprincipal').val("");
    var contrabd = $('#txtcontra_bd').val("");
    var contraActual = $('#txt_contra_actual_editar').val("");
    var contraNueva = $('#txt_contra_nueva_editar').val("");
    var contraNuevaRepetir = $('#txt_contra_repetir_editar').val("");
}


function abrir_modal_restablecer(){
    $('#modal_restablecer_contra').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_restablecer_contra').modal('show');
    $('#modal_restablecer_contra').on('shown.bs.modal', function () {
        $('#txt_email_restablecer_contra').focus();
    });
}

function restablecer_contrasena(){
    var email = $('#txt_email_restablecer_contra').val();
    var caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    var contrasena = "";
    if(email.length == 0){
        return Swal.fire('Mensaje de advertencia', 'Tiene que introducir un email', 'warning')
    }
    for(var i = 0; i<8; i++){
        contrasena+= caracteres.charAt(Math.floor(Math.random()*caracteres.length))
    }
    console.log(contrasena)
    $.ajax({
        url: '../controlador/usuario/controlador_restablecer_contra.php',
        type: 'POST',
        data: {
            email: email,
            contrasena: contrasena
        }
    }).done(function(resp){
        console.log(resp)
    })
}