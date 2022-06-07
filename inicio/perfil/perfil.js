$(document).ready(function () {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idusuario = urlParams.get('idu');
    console.log(idusuario)
    traerDatosUsuario(idusuario)

    function traerDatosUsuario(idusuario){
        templateProfesor = `
                    <div class="col-md-12"><label class="labels">Identificador del profesor</label><input type="text" class="form-control" id="txt_p_idpro" placeholder="experience" value="" readonly></div> <br>
                    <div class="col-md-12"><label class="labels">Nombre profesor</label><input type="text" class="form-control" id="txt_p_nombrepro" placeholder="experience" value="" readonly></div> <br>
                    <div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" id="txt_p_tel" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Provincia</label><input type="text" class="form-control" id="txt_p_provincia" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Población</label><input type="text" class="form-control" id="txt_p_poblacion" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Código postal</label><input type="text" class="form-control" id="txt_p_codpostal" placeholder="experience" value=""></div> <br>
                    
                    `;
                    templateEstudiante = `
                    <div class="col-md-12"><label class="labels">Identificador del estudiante</label><input type="text" class="form-control" id="txt_e_idest" placeholder="experience" value="" readonly></div> <br>
                    <div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" id="txt_e_tel" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Provincia</label><input type="text" class="form-control" id="txt_e_provincia" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Población</label><input type="text" class="form-control" id="txt_e_poblacion" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Código postal</label><input type="text" class="form-control" id="txt_e_codpostal" placeholder="experience" value=""></div> <br>
                    
                    `;

        $.ajax({
            url: 'datos_usuario.php',
            type: 'POST',
            data:{idusuario},
            success: function(resp){
                res = JSON.parse(resp)
                $('#txt_nombreusu').val(res[0]['nombre_usuario'])
                document.getElementById('nombre_usuario_left').innerHTML = res[0]['nombre_usuario'];
                $('#txt_nombre').val(res[0]['nombre']);
                $('#txt_apellidos').val(res[0]['apellidos']);
                $('#txt_correo').val(res[0]['correo']);
                document.getElementById('correo_usu').innerHTML = res[0]['correo'];
                $('#correo_usu').val(res[0]['correo']);
                $('#txt_sexo').val(res[0]['sexo']);
                if(res[0]['sexo'] == 'MASCULINO'){
                    document.getElementById('img_profile').src = "../../plantilla/dist/img/avatar5.png";
                }else if(res[0]['sexo'] == 'FEMENINO'){
                    document.getElementById('img_profile').src = "../../plantilla/dist/img/avatar2.png";
                }

                if(res[0]['tipo_id'] == 1){
                    $('#seccionTipoUsu').html(templateEstudiante)
                    $('#txt_tipousuario').val('ESTUDIANTE')
                    $('#tipo').html('ESTUDIANTE')
                    traerDatosEstudiante(idusuario)
                    
                    traerDatosEstudiante(idusuario)
                }else if(res[0]['tipo_id'] == 2){
                    $('#seccionTipoUsu').html(templateProfesor)
                    $('#txt_tipousuario').val('PROFESOR')
                    $('#tipo').html('PROFESOR')
                    traerDatosProfesor(idusuario)
                }
                if(res[0]['rol_id'] == 1){
                    $('#txt_rolid').val('ADMINISTRADOR');
                }else if(res[0]['rol_id'] == 2){
                    $('#txt_rolid').val('INVITADO');
                }
                
                
                $('#txt_estado').val(res[0]['estado']);
                $('#txt_idusu').val(res[0]['idusuario']);


            }
        })
    }
    function traerDatosProfesor(idusuario){
        $.ajax({
            url: 'datos_profesor.php',
            type: 'POST',
            data:{idusuario},
            success: function(resp){
                res = JSON.parse(resp)
                $('#txt_p_idpro').val(res[0]['id_profesor'])
                $('#txt_p_nombrepro').val(res[0]['nombre'])
                $('#txt_p_tel').val(res[0]['telefono'])
                $('#txt_p_provincia').val(res[0]['provincia'])
                $('#txt_p_poblacion').val(res[0]['poblacion'])
                $('#txt_p_codpostal').val(res[0]['codigo_postal'])
                

            }
        })
    }
    function traerDatosEstudiante(idusuario){
        $.ajax({
            url: 'datos_estudiante.php',
            type: 'POST',
            data:{idusuario},
            success: function(resp){
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


})