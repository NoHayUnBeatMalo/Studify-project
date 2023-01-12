
function verificarUsuario() {
    var usu = $("#txt_usu").val();
    console.log(usu);

    var con = $("#txt_con").val();
    //console.log(con)
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
        console.log(res);
        if (res == false) {
            //console.log(res);
            Swal.fire('Mensaje de error', 'Los datos que has introducido no son correctos', 'error');
        } else {
            var data = JSON.parse(res);
            console.log('texto ');
            console.log(data);
            if (data['estado'] === 'INACTIVO') {
                return Swal.fire('Mensaje de advertencia', 'Lo sentimos, el usuario ' + usu + ' se encuentra suspendido. Comuniquese con el administrados del sistema', 'warning');
            } else {
                console.log('controlador crear session');
                $.ajax({
                    url: '../controlador/usuario/controlador_crear_session.php',
                    type: 'POST',
                    data: {
                        idusuario: data['idusuario'],
                        user: data['nombre_usuario'],
                        estado: data['estado'],
                        rol: data['rol_id'],
                        tipo: data['tipo_id']
                    }
                }).done(function () {

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
                        window.location.href = "http://localhost/Studify-project/vista/index.php";


                    })
                })
            }


        }
    })
}
var table = $('#tabla_usuario').DataTable();



var listar_usuario = function () {

    $.ajax({
        url: "../controlador/usuario/controlador_listar_usuario.php",
        type: 'POST',
    }).done(function (res) {
        console.log(res)
        const dataNS = JSON.parse(res);


        console.log(dataNS)

        table = $('#tabla_usuario').DataTable({
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

//abrir modal registro profesor
function abrirModalRegistroProfesor() {
    $('#modal_registro_profesor').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_registro_profesor').modal('show');
}

//abrir modal registro estudiante
function abrirModalRegistroEstudiante() {
    $('#modal_registro_estudiante').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_registro_estudiante').modal('show');
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
function limpiar_registro_profesor() {
    $('#txt_idusu_p').val("");
    $('#txt_nombre_p').val("");
    $('#txt_poblacion_p').val("");
    $('#txt_provincia_p').val("");
    $('#txt_codpostal_p').val("");
    $('#txt_tel_p').val("");
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
                table.ajax.reload();
                listar_usuario()
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
            title: '¿Estás seguro de que quieres activar el usuario?',
            text: "El usuario volverá a tener acceso al sistema",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, actívalo'
        }).then((result) => {

            if (result.isConfirmed) {
                modificar_estatus(data.idusuario, 'ACTIVO');
                table.ajax.reload();
                listar_usuario();
            }
        })
    }
})

//editar usuario
$('#tabla_usuario').on('click', '.editar', function () {
    var data = table.row($(this).parents('tr')).data();
    abrirModalEditar();
    $("#txtidusuario").val(data.idusuario);
    $("#txt_usu_editar").val(data.nombre_usuario)
    $("#txt_nombre_editar").val(data.nombre)
    $("#txt_apellidos_editar").val(data.apellidos)
    $("#txt_fnac_editar").val(data.fecha_nacimiento)
    $("#txt_correo_editar").val(data.correo)
    $("#cbm_rol_editar").val(data.rol).trigger('change')
})
//modificar estutus usuario
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


            listar_usuario();
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
        console.log('resp listar rol:::::' + res)
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                console.log('data: ' + data[i]['rol_id'])
                cadena += "<option name='opt-select-rol' value='" + data[i]['rol_id'] + "'>" + data[i]['rol_nombre'] + "</option>";
            }
            $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena);
            console.log($("#cbm_rol_editar").html(cadena));
        } else {
            cadena += "<option name='opt-select-rol' value=''>NO SE ENCONTRARON REGISTROS</option>";

            $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena);

        }
    })
}

function listar_tipousu() {
    $.ajax({
        "url": "../controlador/usuario/controlador_listar_tipo_usu.php",
        type: 'POST'
    }).done(function (res) {
        console.log('res: ' + res)
        var data = JSON.parse(res);
        var cadena = '';
        console.log('resp tipo usu:::::' + res)
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                console.log('data: ' + data[i]['idtipo'])
                cadena += "<option name='opt-select-tipousu' value='" + data[i]['idtipo'] + "'>" + data[i]['nombre_tipo'] + "</option>";
            }
            $("#cbm_tipousu").html(cadena);
            $("#cbm_tipousu_editar").html(cadena)
            console.log($("#cbm_tipousu_editar").html(cadena))
        } else {
            cadena += "<option name='opt-select-tipousu' value=''>NO SE ENCONTRARON REGISTROS</option>";

            $("#cbm_tipousu").html(cadena);
            $("#cbm_tipousu_editar").html(cadena);

        }
    })
}


function ShowSelected(element) {
    /* Para obtener el valor */
    var cod = document.getElementById(element).value;
    return cod;
}
$(document).on('change', '#cbm_rol', function () {
    if (ShowSelected('cbm_rol') == 1) {
        $('#cbm_tipousu').addClass('d-none');
        console.log('1')
    } else {

        $('#cbm_tipousu').removeClass('d-none');
        console.log('2')
    }
})

function registrar_usuario() {
    var usu = $('#txt_usu').val();
    var nombre = $('#txt_nombre').val();
    var apellidos = $('#txt_apellidos').val();
    var fecha_nacimiento = $('#txt_fnac').val();
    var correo = $('#txt_correo').val();
    var con1 = $('#txt_con1').val();
    var con2 = $('#txt_con2').val();
    var sexo = $('#txt_sexo').val();
    var rol = document.getElementById('cbm_rol').value;
    var tipousu = document.getElementById('cbm_tipousu').value;
    
    console.log(usu)
    console.log(nombre)
    console.log(apellidos)
    console.log(fecha_nacimiento)
    console.log(correo)
    console.log(con1)
    console.log(con2)
    console.log(sexo)
    console.log(rol)
    console.log(tipousu)
    
    console.log('tipo usu: '+tipousu)
    if (usu.length == 0 || nombre.length == 0 || apellidos.length == 0 || fecha_nacimiento.length == 0 || correo.length == 0 || con1.length == 0 || con2.length == 0 || sexo.length == 0 || rol.length == 0) {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Todos los campos son obligatorios',
            tipo: 'warning'
        });
    }
    
    if (sexo !== 'MASCULINO' && sexo !== 'FEMENINO') {
        return Swal.fire({
            icon: 'error',
            title: 'Mensaje de advertencia',
            text: 'Los valores permitidos en el campo sexo son unicamente "MASCULINO" y "FEMENINO"',
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
            sexo: sexo,
            tipousu: tipousu
        }
    }).done(function (resp) {
        console.log(resp)
        //limpiar_registro();
        if (resp == '') {
            
                $('#modal_registro').modal('hide');
                return Swal.fire(
                    'Mensaje de confirmación',
                    'Datos correctamente introducidos en el sistema. Nuevo usuario registrado',
                    'success'
                )
                    .then((value) => {

                        limpiar_registro();
                        table.destroy();
                        
                        table = $('#tabla_usuario').DataTable();
                        if(rol == 2){
                            if (tipousu == 1) {
                                abrirModalRegistroEstudiante();
                                
                            } else if (tipousu == 2) {
                                
                                abrirModalRegistroProfesor();
                            }
                        }else{
                            return Swal.fire(
                                'Mensaje de confirmación',
                                'Al registrarte como administrador no puedes ser ni estudiante ni profesor',
                                'success'
                            )
                        }
                        
                    })
            

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
    //var tiporol = $('#cbm_rol_editar').value;
    var sexo = $('#txt_sexo_editar').val();
    //var tipousuario = $('#cbm_tipousu_editar').value;
    console.log(usu)
    console.log(nombre)
    console.log(apellidos)
    console.log(fecha_nacimiento)
    console.log(correo)
    //console.log(rol)
    console.log(sexo)
    if (usu.length == 0 || nombre.length == 0 || apellidos.length == 0 || fecha_nacimiento.length == 0 || correo.length == 0 || sexo.length == 0) {
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
            //rol: tiporol,
            sexo: sexo
            //tipousuario: tipousuario
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
                table.destroy();
                table = $('#tabla_usuario').DataTable();
                
                console.log(value);
                if (value.isConfirmed) {

                    listar_usuario();
                }

            });


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
            user: usuario
        }

    }).done(function (resp) {
        console.log(resp);
        console.log('dentro de traer datos usuario');
        var data = JSON.parse(resp);
        console.log(data)
        if (data.length > 0) {
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

function editar_contrasena() {
    var idusuario = $('#txtidprincipal').val();
    var contrabd = $('#txtcontra_bd').val();
    var contraActual = $('#txt_contra_actual_editar').val();
    var contraNueva = $('#txt_contra_nueva_editar').val();
    var contraNuevaRepetir = $('#txt_contra_repetir_editar').val();
    if (idusuario.length == 0 || contrabd.length == 0 || contraActual.length == 0 || contraNueva.length == 0 || contraNuevaRepetir.length == 0) {
        return Swal.fire(
            'Mensaje de advertencia', 'Todos los datos son requeridos', 'warning'
        )
    }
    if (contraNueva != contraNuevaRepetir) {
        return Swal.fire(
            'Mensaje de advertencia', 'Debes ingresar la misma clave dos veces', 'warning'
        )
    }
    $.ajax({
        'url': '../controlador/usuario/controlador_editar_contra.php',
        type: 'POST',
        data: {
            idusuario: idusuario,
            contrabd: contrabd,
            contraActual: contraActual,
            contraNueva: contraNueva,
        }
    }).done(function (resp) {
        console.log(resp)
        if (resp == 0) {
            Swal.fire(
                'Mensaje de advertencia', 'La contrase&ntilde;a actual que has introducido no coincide con la de la base de datos.', 'warning'
            )
        } else if (resp == 1) {

            $('#modal_editar_contra').modal('hide');

            limpiar_editar_contrasena();
            Swal.fire(
                'Mensaje de confirmación',
                'La contrase&ntilde;a ha sido actualizada',
                'success').then((value) => {
                    traer_datos_usuario();
                })
        } else {
            Swal.fire(
                'Mensaje de advertencia', 'No se ha podido introducir en la base de datos', 'warning'
            )
        }
    })
}

/*function limpiar_editar_contrasena() {
    $('#txtidprincipal').val("");
    $('#txtcontra_bd').val("");
    $('#txt_contra_actual_editar').val("");
    $('#txt_contra_nueva_editar').val("");
    $('#txt_contra_repetir_editar').val("");
}


function abrir_modal_restablecer() {
    $('#modal_restablecer_contra').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modal_restablecer_contra').modal('show');
    $('#modal_restablecer_contra').on('shown.bs.modal', function () {
        $('#txt_email_restablecer_contra').focus();
    });
}

function restablecer_contrasena() {
    var email = $('#txt_email_restablecer_contra').val();
    var caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    var contrasena = "";
    if (email.length == 0) {
        return Swal.fire('Mensaje de advertencia', 'Tiene que introducir un email', 'warning')
    }
    for (var i = 0; i < 8; i++) {
        contrasena += caracteres.charAt(Math.floor(Math.random() * caracteres.length))
    }
    console.log(contrasena)
    $.ajax({
        url: '../controlador/usuario/controlador_restablecer_contra.php',
        type: 'POST',
        data: {
            email: email,
            contrasena: contrasena
        }
    }).done(function (resp) {
        console.log(resp)
    })
}
*/