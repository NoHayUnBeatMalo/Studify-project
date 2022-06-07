<?php
session_start();
$usuario = $_GET['idu'];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.72.0">
    <title>Perfil de usuario</title>

    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/">



    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php?username=<?php echo $idusuario ?>">Studify</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">

                    <li class="nav-item"><a class="nav-link" href="../calendar2/index.php?idu=<?php echo $idusuario ?>">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="../taskApp/index.php?idu=<?php echo $idusuario ?>">Lista de tareas</a></li>
                    <a class="nav-item"><a class="nav-link" href="../cursos/cursos.php?idu=<?php echo $idusuario; ?>">Nuestros cursos</a></a>
                    
                    <li class="nav-item"><a class="nav-link" href="perfil/perfil.php?idu=<?php echo $idusuario; ?>">Perfil</a></li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- Masthead-->
    



    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img id="img_profile" class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold" id="nombre_usuario_left"></span><span class="text-black-50" id="correo_usu"></span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Perfil de usuario</h4>
                        <div class="mt-5 top-right"><a class="btn btn-danger sesionclose-button" type="button" href="../../controlador/usuario/controlador_cerrar_session.php">Cerrar sesión</a></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Nombre de usuario</label><input type="text" class="form-control" id="txt_nombreusu" value="" placeholder="Nombre de usuario"></div>
                        <div class="col-md-12"><label class="labels">Nombre</label><input type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value=""></div>
                        <div class="col-md-12"><label class="labels">Apellidos</label><input type="text" class="form-control" id="txt_apellidos" placeholder="Apellidos" value=""></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Correo electrónico</label><input type="text" class="form-control" id="txt_correo"placeholder="Ingresa tu correo electrónico" value=""></div>
                        <div class="col-md-12"><label class="labels">Rol</label><input type="text" class="form-control" id="txt_rolid" placeholder="Habla con un administrador para cambiar tu rol" value="" readonly></div>
                        <div class="col-md-12"><label class="labels">Sexo</label><input type="text" id="txt_sexo" class="form-control col-md-8" readonly><button class="btn btn-sexo" class="col-md-4 form-control btn-secondary">Cambiar</button></div>
                        <div class="col-md-12"><label class="labels">Tipo de usuario</label><input type="text" class="form-control" id="txt_tipousuario" placeholder="enter address line 2" value="" readonly></div>
                        <div class="col-md-12"><label class="labels">Estado</label><input type="text" class="form-control" id="txt_estado" placeholder="enter address line 2" value="ACTIVO" readonly></div>
                        <div class="col-md-12"><label class="labels">Número de identificador único</label><input type="text" class="form-control" id="txt_idusu" value="" readonly></div>

                    </div>

                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Actualizar el perfil</button></div>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span id="tipo"></span></div><br>
                    <div id="seccionTipoUsu">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </main>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="perfil.js"></script>
</body>


</html>