<?php
session_start();

if (!isset($_SESSION['S_IDUSUARIO']) || !isset($_SESSION['S_ROL'])) {
    header('Location: http://localhost/Studify-project/login/index.php');
    
}
if ($_SESSION['S_ROL'] == '2') {
    header('Location: http://localhost/Studify-project/inicio/index.php?username='.$_SESSION['S_IDUSUARIO']);
}

    



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Studify || ADMIN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plantilla/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plantilla/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plantilla/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../plantilla/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plantilla/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plantilla/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plantilla/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="../plantilla/plugins/datatables/jquery.dataTables.min.js">

    <link rel="stylesheet" href="../plantilla/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="../plantilla/plugins/select2/css/select2.min.css">

</head>
<style>
    .swal2-popup {
        font-size: 16rem;
    }
    #tabla_usuario{
        border-collapse: separate;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../plantilla/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- User dropdown -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img id="img_nav" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"><?php echo $_SESSION['S_USER']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img id="img_subnav" class="img-circle elevation-2" alt="User Image">

                            <p>
                                <?php echo $_SESSION['S_USER']; ?>

                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat" onclick="abrir_modal_editar_contrasena()">Cambiar contraseña</a>
                            <a href="../controlador/usuario/controlador_cerrar_session.php" class="btn btn-default btn-flat float-right">Salir</a>
                        </li>
                    </ul>
                </li>
                <!-- Full screen -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- Control adminle -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../inicio/index.php?username=<?php echo $_SESSION['S_IDUSUARIO']; ?>" class="brand-link">
                <img src="../plantilla/docs/assets/img/StudifyLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Studify</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img id="img_lateral" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['S_USER']; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header">PANEL DE ADMINISTRADOR</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active admin">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>
                                    Administrador
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a onclick="cargar_contenido('contenido_principal', 'usuario/vista_usuario_listar.php')" class="nav-link active admin">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>

                                            Usuario

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a onclick="cargar_contenido('contenido_principal', 'curso/vista_curso_listar.php')" class="nav-link active admin">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>

                                            Cursos

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a onclick="cargar_contenido('contenido_principal', 'profesor/vista_profesor_listar.php')" class="nav-link active admin">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>

                                            Profesores

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a onclick="cargar_contenido('contenido_principal', 'estudiante/vista_estudiante_listar.php')" class="nav-link active admin">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>

                                            Estudiantes

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a onclick="cargar_contenido('contenido_principal', 'ventas/vista_ventas_listar.php')" class="nav-link active admin">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>

                                            Ventas

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a onclick="cargar_contenido('contenido_principal', 'ventas/vista_ventas_detalles_listar.php')" class="nav-link active admin">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>

                                            Detalle de ventas

                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-header">----------------------------------------------</li>
                        
                        <li class="nav-item">
                            <a href='../inicio/taskApp/index.php?idu=<?php echo $_SESSION['S_IDUSUARIO']  ?>' );" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Lista de tareas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='../inicio/cursos/cursos.php?idu=<?php echo $_SESSION['S_IDUSUARIO']  ?>' );" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Cursos Studify
                                </p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a onclick="cargar_contenido('contenido_principal', 'perfil/vista_perfil.php?idu=<?php echo $_SESSION['S_IDUSUARIO']  ?>');" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Perfil
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <input type="text" hidden id="txtidprincipal" value="<?php echo $_SESSION['S_IDUSUARIO'] ?>">
                <input type="text" hidden id="usuarioprincipal" value="<?php echo $_SESSION['S_USER'] ?>">
                <input type="text" hidden id="txttipoid" value="<?php echo $_SESSION['S_IDTIPO'] ?>">
                <input type="text" hidden id="txtrol" value="<?php echo $_SESSION['S_ROL'] ?>">
                
                <div class="row" id="contenido_principal">
                    <div class="col-md-12">
                        <div class="card card-warning shadow">
                            <div class="card-header">
                                <h3 class="card-title">Bienvenido al contenido principal</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                Contenido principal
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; Studify.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Aitor Vázquez García</b>
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <div class="modal fade" id="modal_editar_contra" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modificar contras&ntilde;a</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->


                <div class="modal-body col-lg-12">
                    <div class="col-lg-12">
                        <input type="text" id="txtcontra_bd" hidden>
                        <label for="txt_contra_actual_editar">Contrase&ntilde;a actual</label>
                        <input type="text" class="form-control col-lg-24" id="txt_contra_actual_editar" placeholder="Ingrese la contrase&ntilde;a actual"><br>
                    </div>
                </div>
                <div class="modal-body col-lg-12">
                    <div class="col-lg-12">
                        <label for="txt_contra_nueva_editar">Nueva contrase&ntilde;a</label>
                        <input type="text" class="form-control col-lg-24" id="txt_contra_nueva_editar" placeholder="Ingrese la contrase&ntilde;a nueva"><br>
                    </div>
                </div>
                <div class="modal-body col-lg-12">
                    <div class="col-lg-12">
                        <label for="txt_contra_repetir_editar">Repetir contrase&ntilde;a</label>
                        <input type="text" class="form-control col-lg-24" id="txt_contra_repetir_editar" placeholder="Repita la contrase&ntilde;a"><br>
                    </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="editar_contrasena(); console.log('onclick');">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="../plantilla/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plantilla/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        var idioma_espanol = {
            select: {
                rows: "%d fila seleccionada"
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b>No se encontraron datos</b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",
            },
            "oAria": {
                "sSortAscending": "Activar para ordenar la columna de manera ascendente",
                "sSortDescending": "Activar para ordenar la columna de manera descendente"
            }
        }


        function cargar_contenido(contenedor, contenido) {
            $("#" + contenedor).load(contenido);
        }
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plantilla/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plantilla/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <!--<script src="../plantilla/plugins/jqvmap/jquery.vmap.min.js"></script>-->
    <!-- <script src="../plantilla/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
    <!-- jQuery Knob Chart -->
    <script src="../plantilla/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plantilla/plugins/moment/moment.min.js"></script>
    <script src="../plantilla/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plantilla/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plantilla/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plantilla/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../plantilla/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../plantilla/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is y for demo purposes) -->
    <!-- <script src="../plantilla/dist/js/pages/dashboard.js"></script>-->

    <script src="../plantilla/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="../plantilla/plugins/select2/js/select2.min.js"></script>
    <script src="../plantilla/plugins/select2/js/select2.full.min.js"></script>
    <script src="../login/vendor/sweetalert2/sweetalert2.js"></script>

    <script src="../js/usuario.js"></script>
    <script>
        $(document).ready(function() {
            
            traer_datos_usuario();
        });
        
    </script>
</body>

</html>