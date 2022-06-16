<script type="text/javascript" src="../js/estudiante.js"></script>
<div class="col-md-12">
    <div class="card card-warning shadow">
        <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido de estudiantes</h3>

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
            <table id="tabla_estudiante" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id usuario</th>
                        <th>Id Estudiante</th>
                        <th>Poblacion</th>
                        <th>Provincia</th>
                        <th>Código postal</th>
                        <th>Teléfono</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <br><br>

                <tfoot>
                    <tr>
                        <th>Id usuario</th>
                        <th>Id Estudiante</th>
                        <th>Poblacion</th>
                        <th>Provincia</th>
                        <th>Código postal</th>
                        <th>Teléfono</th>
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
                    <h4 class="modal-title">Registro de estudiante</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->

                <div class="row">
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_poblacion_e">Id del usuario</label>
                            <input type="text" class="form-control col-lg-12" id="txt_idusuario_e" placeholder="Ingrese el id de usuario"><br>
                        </div>
                    </div>

                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_poblacion_e">Población</label>
                            <input type="text" class="form-control col-lg-12" id="txt_poblacion_e" placeholder="Ingrese su ciudad"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_poblacion_e">Provincia</label>
                            <input type="text" class="form-control col-lg-12" id="txt_provincia_e" placeholder="Ingrese su ciudad"><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_codpostal_e">Código postal</label>
                            <input type="number" class="form-control" id="txt_codpostal_e"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_tel_e">Teléfono</label>
                            <input type="tel" class="form-control" id="txt_tel_e" placeholder="Ingrese su telefono"><br>
                        </div>
                    </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="registrar_estudiante(); console.log('onclick');">Registrar</button>
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
                            <input type="text" id="txtidestudiante" >
                            <input type="text" id="txtidusu" >
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_poblacion_editar">Poblacion</label>
                            <input type="text" class="form-control col-lg-12" id="txt_poblacion_editar" placeholder="Ingrese su nombre"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_provincia_editar">Provincia</label>
                            <input type="text" class="form-control col-lg-12" id="txt_provincia_editar" placeholder="Ingrese sus apellidos"><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_codpostal_editar">Código postal</label>
                            <input type="number" class="form-control" id="txt_codpostal_editar"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_tel_editar">Teléfono</label>
                            <input type="email" class="form-control" id="txt_tel_editar" placeholder="Ingrese usuario"><br>
                        </div>
                    </div>
                </div>
                


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="modificar_estudiante(); console.log('onclick');">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        listar_estudiante();

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