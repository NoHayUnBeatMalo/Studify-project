<script type="text/javascript" src="../js/profesor.js"></script>
<div class="col-md-12">
    <div class="card card-warning shadow">
        <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido de profesores</h3>

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
            <table id="tabla_profesor" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id usuario</th>
                        <th>Id profesor</th>
                        <th>Nombre</th>
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
                        <th>Id profesor</th>
                        <th>Nombre</th>
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
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar" role="dialog">
        <div class="modal-dialog modal-sm" style="max-width: 750px!important;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edición de profesor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->

                <div class="row">
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <input type="text" id="txtidprofesor" hidden>
                            <input type="text" id="txtidusu" hidden>
                            <label for="txt_nombre_editar">Nombre</label>
                            <input type="text" class="form-control col-lg-24" id="txt_nombre_editar" placeholder="Ingrese usuario"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_poblacion">Poblacion</label>
                            <input type="text" class="form-control col-lg-12" id="txt_poblacion_editar" placeholder="Ingrese su nombre"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
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
                            <input type="tel" class="form-control" id="txt_tel_editar" placeholder="Ingrese usuario"><br>
                        </div>
                    </div>
                </div>
                


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="modificar_profesor(); console.log('onclick mod');">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        listar_profesor();
        
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