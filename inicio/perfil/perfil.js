function traerDatosUsuario(idusuario){
    $.ajax({
        url: 'datos_usuario.php',
        type: 'POST',
        data: {idusuario},
        success: function(res){
            resp = JSON.parse(res);
            return resp;
        }
    })
}

function traerDatosProfesor(idusuario) {
    $.ajax({
        url: 'datos_profesor.php',
        type: 'POST',
        data: { idusuario },
        success: function (resp) {
            res = JSON.parse(resp)
            $('#txt_p_idpro').val(res[0]['id_profesor'])
            $('#txt_p_nombrepro').val(res[0]['nombre'])
            $('#txt_p_tel').val(res[0]['telefono'])
            $('#txt_p_provincia').val(res[0]['provincia'])
            $('#txt_p_poblacion').val(res[0]['poblacion'])
            $('#txt_p_codpostal').val(res[0]['codigo_postal'])


        }
    });
}
function traerDatosEstudiante(idusuario) {
    $.ajax({
        url: 'datos_estudiante.php',
        type: 'POST',
        data: { idusuario },
        success: function (resp) {
            res = JSON.parse(resp)
            console.log(res)
            $('#txt_e_idest').val(res[0]['id_estudiante'])
            $('#txt_e_tel').val(res[0]['telefono'])
            $('#txt_e_provincia').val(res[0]['provincia'])
            $('#txt_e_poblacion').val(res[0]['poblacion'])
            $('#txt_e_codpostal').val(res[0]['codigo_postal'])


        }
    })
}