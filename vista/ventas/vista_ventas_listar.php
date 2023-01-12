<script type="text/javascript" src="../js/ventas.js"></script>
<div class="col-md-12">
    <div class="card card-warning shadow">
        <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido de ventas</h3>

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
                    <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                        <span class="input-group-addon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </div>
                </div>

            </div>
            <table id="tabla_ventas" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id venta</th>
                        <th>Clave de la transacción</th>
                        <th>Datos de paypal</th>
                        <th>Fecha de venta</th>
                        <th>Correo</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <br><br>

                <tfoot>
                <tr>
                        <th>Id venta</th>
                        <th>Clave de la transacción</th>
                        <th>Datos de paypal</th>
                        <th>Fecha de venta</th>
                        <th>Correo</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>