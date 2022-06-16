<script type="text/javascript" src="../js/usuario.js"></script>
<div class="col-md-12">
    <div class="card card-warning shadow">
        <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido del usuario</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group">
                <div class="col-lg-12">
                    <button class="btn btn-danger" style="width:100%" onclick="abrirModalRegistro();"><i class="glyphicon glyphicon-plus"></i>Nuevo registro</button>

                </div>
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                        <span class="input-group-addon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </div>
                </div>

            </div>
            <table id="tabla_usuario" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre de usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Fecha de nacimiento</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <br><br>

                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nombre de usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Fecha de nacimiento</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_registro" role="dialog">
        <div class="modal-dialog modal-sm" style="max-width: 750px!important;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Registro de usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->

                <div class="row">
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_usu">Usuario</label>
                            <input type="text" class="form-control col-lg-24" id="txt_usu" placeholder="Ingrese usuario"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_nombre">Nombre</label>
                            <input type="text" class="form-control col-lg-12" id="txt_nombre" placeholder="Ingrese su nombre"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_apellidos">Apellidos</label>
                            <input type="text" class="form-control col-lg-12" id="txt_apellidos" placeholder="Ingrese sus apellidos"><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_fnac">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="txt_fnac"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_correo">Email</label>
                            <input type="email" class="form-control" id="txt_correo" placeholder="Ingrese usuario"><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_con1">Contrase&ntilde;a</label>
                            <input type="password" class="form-control" id="txt_con1" placeholder="Ingrese contrase&ntilde;a"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_con2">Repita la Contrase&ntilde;a</label>
                            <input type="password" class="form-control" id="txt_con2" placeholder="Repita la contrase&ntilde;a"><br>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="modal-body  col-lg-6">
                        <div class="col-lg-12 ">
                            <label for="cbm_rol">Rol</label>
                            <select class="form-control select2-rol select" name="cbm_rol" id="cbm_rol" style="width:100%;">

                            </select><br><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="cbm_sexo">Sexo<small>Valores permitidos 'MASCULINO' y 'FEMENINO'</small></label>
                              <label for="txt_sexo" class="form-label"></label>
                              <input type="text"
                                class="form-control" name="txt_sexo" id="txt_sexo" placeholder="Valores permitidos 'MASCULINO' y 'FEMENINO'">
                              
                            </div>
                        </div>
                    </div>
                    
                <div class="row">
                <div class="modal-body col-lg-12">
                        <div class="col-lg-6">
                            <label for="cbm_tipousu">Tipo de usuario invitado</label>
                            <select class="form-control select2-tipousu select" name="cbm_tipousu" id="cbm_tipousu" style="width:100%;">

                            </select><br><br>
                        </div>
                    </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="registrar_usuario(); console.log('onclick');">Registrar</button>
                    <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</form>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar" role="dialog">
        <div class="modal-dialog modal-sm" style="max-width: 750px!important;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edición de usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->

                <div class="row">
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <input type="text" id="txtidusuario">
                            <label for="txt_usu">Usuario</label>
                            <input type="text" class="form-control col-lg-24" id="txt_usu_editar" placeholder="Ingrese usuario" disabled><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_nombre">Nombre</label>
                            <input type="text" class="form-control col-lg-12" id="txt_nombre_editar" placeholder="Ingrese su nombre"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_apellidos">Apellidos</label>
                            <input type="text" class="form-control col-lg-12" id="txt_apellidos_editar" placeholder="Ingrese sus apellidos"><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_fnac">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="txt_fnac_editar"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_correo">Email</label>
                            <input type="email" class="form-control" id="txt_correo_editar" placeholder="Ingrese usuario"><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="rol">Rol</label>
                            <select class="form-control select2-rol select" name="cbm_rol_editar" id="cbm_rol_editar" style="width:100%;">

                            </select><br><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                    <div class="col-lg-12">
                            <label for="cbm_sexo">Sexo<small>Valores permitidos 'MASCULINO' y 'FEMENINO'</small></label>
                              <label for="txt_sexo_editar" class="form-label"></label>
                              <input type="text"
                                class="form-control" name="txt_sexo_editar" id="txt_sexo_editar" placeholder="Valores permitidos 'MASCULINO' y 'FEMENINO'">
                              
                            </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="modal-body col-lg-12">
                        <div class="col-lg-12">
                            <label for="sexo">Tipo de usuario invitado</label>
                            <select class="form-control select2-tipousu select" name="cbm_tipousu_editar" id="cbm_tipousu_editar" style="width:100%;">

                            </select><br><br>
                        </div>
                    </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="modificar_usuario(); console.log('onclick');">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</form>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_registro_profesor" role="dialog">
        <div class="modal-dialog modal-sm" style="max-width: 750px!important;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Registro de profesor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="row">
                    
                    <div class="modal-body col-lg-12">
                        <div class="col-lg-12">
                            <label for="txt_idusu_p">introduzca el id del usuario</label>
                            <input type="number" class="form-control col-lg-12" id="txt_idusu_p"><br>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_nombre_p">Nombre</label>
                            <input type="text" class="form-control col-lg-12" id="txt_nombre_p" placeholder="Ingrese su nombre completo"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_poblacion_p">Población</label>
                            <input type="text" class="form-control col-lg-12" id="txt_poblacion_p" placeholder="Ingrese su ciudad"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_poblacion_p">Provincia</label>
                            <input type="text" class="form-control col-lg-12" id="txt_provincia_p" placeholder="Ingrese su ciudad"><br>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_codpostal_p">Código postal</label>
                            <input type="number" class="form-control" id="txt_codpostal_p"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_tel_p">Teléfono</label>
                            <input type="tel" class="form-control" id="txt_tel_p" placeholder="Ingrese su telefono"><br>
                        </div>
                    </div>
                </div>



                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="registrar_profesor(); console.log('onclick registrar');">Registrar Profesor</button>
                    <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        listar_usuario();
        $('#cbm_rol').select2();
        $('#cbm_tipousu').select2();


        listar_rol();
        listar_tipousu();




        $('#modal_registro').on('shown.bs.modal', function() {
            $('#txt_usu').focus();
        });
    });
    $('.card').CardWidget({
        animationSpeed: 500,
        collapseTrigger: '[data-widget="collapse"]',
        removeTrigger: '[data-widget="remove"]',
        collapseIcon: 'fa-minus',
        expandIcon: 'fa-plus',
        removeIcon: 'fa-times'
    })
</script>