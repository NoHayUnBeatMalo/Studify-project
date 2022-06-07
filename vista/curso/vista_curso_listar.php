<script type="text/javascript" src="../js/cursos.js"></script>
<div class="col-md-12">
    <div class="card card-warning shadow">
        <div class="card-header">
            <h3 class="card-title">Mantenimiento de cursos</h3>

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
            <table id="tabla_cursos" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre de curso</th>
                        <th>Profesor</th>
                        <th>Horas</th>
                        <th>Precio</th>
                        <th>Fecha de publicación</th>
                        <th>Participantes</th>
                        <th>Estado</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <br><br>

                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nombre de curso</th>
                        <th>Profesor</th>
                        <th>Horas</th>
                        <th>Precio</th>
                        <th>Fecha de publicación</th>
                        <th>Participantes</th>
                        <th>Estado</th>
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
                    <h4 class="modal-title">Registro de Cursos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->

                <div class="row">
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_nombrecurso">Nombre del curso: </label>
                            <input type="text" class="form-control col-lg-24" id="txt_nombrecurso" placeholder="Ingrese el nombre del curso" required><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_nombreprofesor">Nombre del profesor que lo imparte</label>
                            <input type="text" class="form-control col-lg-12" id="txt_nombreprofesor" placeholder="Ingrese su nombre completo" required><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_horas">Horas del curso</label>
                            <input type="text" class="form-control col-lg-12" id="txt_horas" placeholder="Ingrese las horas del curso. Una aproximación" required><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_precio">Precio</label>
                            <input type="number" class="form-control" id="txt_precio" min="0.00" max="10000.00" step="0.01" required><br>
                        </div>
                    </div>

                    <div class="modal-body col-lg-6" hidden>
                        <div class="col-lg-12">
                            <label for="txt_codprofesor">Código del profesor</label>
                            <input type="email" class="form-control" id="txt_codprofesor"><br>
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
                    <h4 class="modal-title">Edición de curso</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->

                <div class="row">
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <input type="text" id="txtidusuario">
                            <label for="txt_nombrecurso_editar">Nombre del curso</label>
                            <input type="text" class="form-control col-lg-24" id="txt_nombrecurso_editar" placeholder="Ingrese nombre del curso" disabled><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_nombreprofesor_editar">Nombre del profesor</label>
                            <input type="text" class="form-control col-lg-12" id="txt_nombreprofesor_editar" placeholder="Ingrese el nombre del profesor"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-4">
                        <div class="col-lg-12">
                            <label for="txt_horas_editar">Horas curso</label>
                            <input type="number" class="form-control col-lg-12" id="txt_horas_editar"><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_preciocurso_editar">Precio del curso</label>
                            <input type="number" class="form-control" id="txt_preciocurso_editar" step="0.01"><br>
                        </div>
                    </div>
                    <div class="modal-body col-lg-6">
                        <div class="col-lg-12">
                            <label for="txt_participantescurso_editar">Participantes</label>
                            <input type="number" class="form-control" id="txt_participantescurso_editar"><br>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="modificar_curso(); console.log('onclick');">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        listar_curso();
        $('#modal_registro').on('shown.bs.modal', function() {
            $('#txt_nombrecurso').focus();
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