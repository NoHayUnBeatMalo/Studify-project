<?php
session_start();
$idusuario = $_GET['idu'];
require '../../conexion.php';
$sql = "SELECT idusuario, nombre_usuario, nombre, apellidos, fecha_nacimiento, correo, rol_id, sexo, tipo_id FROM usuarios WHERE idusuario=$idusuario";
$datosusu = $pdo->prepare($sql);
$datosusu->execute();
while ($resultado = $datosusu->fetch(PDO::FETCH_ASSOC)) {
    $nombreusu = $resultado['nombre_usuario'];
    $nombre = $resultado['nombre'];
    $apellidos = $resultado['apellidos'];
    $fechanacimiento = $resultado['fecha_nacimiento'];
    $correo = $resultado['correo'];
    $rolid = $resultado['rol_id'];
    $sexo = $resultado['sexo'];
    $tipoid = $resultado['tipo_id'];
}
if ($rolid == 1) {
    $rol = 'ADMINISTRADOR';
} else {
    $rol = 'INVITADO';
}
if ($tipoid == 1) {
    $tipo = 'ESTUDIANTE';
    $url = 'datos_estudiante.php';
} else {
    $tipo = 'PROFESOR';
    $url = 'datos_profesor.php';
}

echo $rol;
echo $tipo;
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="perfil.js" type="text/javascript">
        $(document).ready(function() {
            console.log('ready')
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var idusuario = urlParams.get('idu');
            console.log(idusuario);
            var arrayusu = traerDatosUsuario(idusuario)
            console.log(arrayusu);
            $('.btn-sexo').on('click', function() {

                sexo = $('#txt_sexo').val();
                console.log(sexo)

                $.ajax({
                    url: 'cambiarsexo.php',
                    data: {
                        idusuario,
                        sexo
                    },
                    type: 'POST',
                    success: function(resp) {
                        console.log('onclick' + resp)
                        traerDatosUsuario(idusuario)
                    }

                })
            })

        });
        
        $('#updateUser').on('click', function() {
            nombreusuario = $('#txt_nombreusu').val();
            nombre = $('#txt_nombre').val();
            apellidos = $('#txt_apellidos').val();
            corr = $('#txt_correo').val();
            telefono = $('#txt_tel').val();
            provincia = $('#txt_provincia').val();
            poblacion = $('#txt_poblacion').val();
            codigopostal = $('#txt_codpostal').val();
            console.log(nombreusuario, nombre, apellidos, corr)
            idusuario = $('#txt_idusu').val();

            $.ajax({
                url: 'update_datos.php',

                type: 'POST',
                data: {
                    idusuario,
                    nombreusuario,
                    nombre,
                    apellidos,
                    correo: corr,
                    telefono,
                    provincia,
                    poblacion,
                    codigopostal
                },
                success: function(resp) {
                    window.location.reload();
                }

            })
        })
    
    </script>
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


    <header style="background-color: rgb(106, 199, 70);" class="relative-top">
        <nav class="navbar navbar-expand-lg navbar-light  py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../../index.php?username=<?php echo $idusuario ?>">Studify</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item active"><a class="nav-link" href="../cursos/mostrarcarrito.php?idu=<?php echo $idusuario; ?>">Carrito(<?php if (empty($_SESSION['CARRITO'])) {
                                                                                                                                                        echo 0;
                                                                                                                                                    } else {
                                                                                                                                                        echo count($_SESSION['CARRITO']);
                                                                                                                                                    }; ?>)</a></li>

                        <li class="nav-item"><a class="nav-link" href="../taskApp/index.php?idu=<?php echo $idusuario ?>">Lista de tareas</a></li>
                        <li class="nav-item"><a class="nav-item"><a class="nav-link" href="../cursos/cursos.php?idu=<?php echo $idusuario; ?>">Nuestros cursos</a></a></li>
                        <li class="nav-item"><a class="nav-link" href="perfil.php?idu=<?php echo $idusuario; ?>">Perfil</a></li>
                        <?php if ($rolid == 1) {
                            echo '<li class="nav-item"><a class="nav-item"><a class="nav-link" href="../../vista/index.php" ?>PANEL DE ADMINISTRADOR</a></a></li>
                            ';
                        } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Masthead-->




    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-2 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img id="img_profile" class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold" id="nombre_usuario_left"></span><span class="text-black-50" id="correo_usu"></span><span><?php echo $correo; ?> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Perfil de usuario</h4>
                        <div class="mt-5 top-right"><a class="btn btn-danger sesionclose-button" type="button" href="../../controlador/usuario/controlador_cerrar_session.php">Cerrar sesión</a></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Nombre de usuario</label><input type="text" class="form-control" id="txt_nombreusu" value="<?php echo $nombreusu ?>" placeholder="Nombre de usuario"></div>
                        <div class="col-md-12"><label class="labels">Nombre</label><input type="text" class="form-control" id="txt_nombre" placeholder="Nombre" value="<?php echo $nombre; ?>"></div>
                        <div class="col-md-12"><label class="labels">Apellidos</label><input type="text" class="form-control" id="txt_apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Correo electrónico</label><input type="text" class="form-control" id="txt_correo" placeholder="Ingresa tu correo electrónico" value="<?php echo $correo; ?>"></div>
                        <div class="col-md-12"><label class="labels">Rol</label><input type="text" class="form-control" id="txt_rolid" placeholder="Habla con un administrador para cambiar tu rol" value="<?php echo $rol; ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Sexo</label><input type="text" id="txt_sexo" class="form-control col-md-8" readonly value='<?php echo $sexo; ?>'><button class="btn btn-sexo" class="col-md-4 form-control btn-secondary">Cambiar</button></div>
                        <div class="col-md-12"><label class="labels">Tipo de usuario</label><input type="text" class="form-control" id="txt_tipousuario" value="<?php echo $tipo; ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Número de identificador único</label><input type="text" class="form-control" id="txt_idusu" value="<?php echo $idusuario; ?>" readonly></div>

                    </div>

                    <div class="mt-5 text-center"><button id="updateUser" class="btn btn-primary profile-button" type="button">Actualizar el perfil</button></div>

                </div>
            </div>
            <div class="col-md-5 border-right" id="template-profesor">
                <div class="p-4 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3"> PERFIL DE PROFESOR
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Identificador de profesor</label><input type="text" class="form-control" id="txt_p_idpro" value="" readonly></div>
                        <div class="col-md-12"><label class="labels">Nombre</label><input type="text" class="form-control" id="txt_p_nombre" placeholder="Población" value=""></div>
                        <div class="col-md-12"><label class="labels">Poblacion</label><input type="text" class="form-control" id="txt_p_poblacion" placeholder="Codigo postal" value="<?php $codprof ?>"></div>
                        <div class="col-md-12"><label class="labels">Código postal</label><input type="text" class="form-control" id="txt_p_codpostal" placeholder="Provincia" value=""></div>
                        <div class="col-md-12"><label class="labels">Provincia</label><input type="text" class="form-control" id="txt_p_provincia" placeholder="Provincia" value=""></div>
                        <div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" id="txt_p_tel" placeholder="Teléfono" value=""></div>

                    </div>


                    <div class="mt-5 text-center"><button id="updateProf" class="btn btn-primary profile-button" type="button">Actualizar el perfil de estudiante</button></div>

                </div>
            </div>
            <div class="col-md-5 border-right" id="template-estudiante">
                <div class="p-4 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">PERFIL DE ESTUDIANTE
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Identificador de estudiante</label><input type="text" class="form-control" id="txt_e_idest" value="" readonly></div>
                        <div class="col-md-12"><label class="labels">Población</label><input type="text" class="form-control" id="txt_e_poblacion" placeholder="Población" value=""></div>
                        <div class="col-md-12"><label class="labels">Código postal</label><input type="text" class="form-control" id="txt_e_codpostal" placeholder="Codigo postal" value=""></div>
                        <div class="col-md-12"><label class="labels">Provincia</label><input type="text" class="form-control" id="txt_e_provincia" placeholder="Provincia" value=""></div>
                        <div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" id="txt_e_tel" placeholder="Teléfono" value=""></div>

                    </div>


                    <div class="mt-5 text-center"><button id="updateEst" class="btn btn-primary profile-button" type="button">Actualizar el perfil de estudiante</button></div>

                </div>
                <?php



                if ($tipoid == 1) {
                    $sqlEst = "SELECT * FROM estudiantes WHERE id_usuario_estudiante='$idusuario'";
                    $selectDatosEst = $pdo->prepare($sqlEst);
                    $selectDatosEst->execute();
                    while ($resEst = $selectDatosEst->fetch(PDO::FETCH_ASSOC)) {
                        $idest = $resEst['id_estudiante'];
                        $poblacionest  = $resEst['poblacion'];
                        $codpostalest  = $resEst['codigo_postal'];
                        $provinciaest  = $resEst['provincia'];
                        $telest = $resEst['telefono'];
                    }
                } else if ($tipoid == 2) {
                    $sqlEst = "SELECT * FROM profesores WHERE id_usuario_profesor='$idusuario'";
                    $selectDatosEst = $pdo->prepare($sqlEst);
                    $selectDatosEst->execute();
                    while ($resEst = $selectDatosEst->fetch(PDO::FETCH_ASSOC)) {
                        $idprof = $resEst['id_profesor'];
                        $poblacionprof  = $resEst['poblacion'];
                        $codpostalprof  = $resEst['codigo_postal'];
                        $provinciaprof  = $resEst['provincia'];
                        $telprof = $resEst['telefono'];
                        $nomProf = $resEst['nombre'];
                    }
                }

                ?>
            </div>
        </div>
    </div>
    </div>
    <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
        <b5-col>
            <div class="col-md-12">
        </b5-col>
    </div>
    </div>
   <script>
    idusuario = $('#txt_idusu').val();
    tipo = $('#txt_tipousuario').val();
    rol = $('txt_rolid').val();
    if(rol == 'ADMINISTRADOR'){
        $('#template-profesor').remove();
        $('#template-estudiante').remove();
    }
    if(tipo == 'ESTUDIANTE'){
            $('#template-profesor').remove();
            $.ajax({
                url: 'datos-estudiante.php',
                type: 'POST',
                data: {idusuario : idusuario},
                success: function(res){
                    respuesta = JSON.parse(res)
                    console.log(respuesta)
                    
                    $('#txt_e_idest').val(respuesta['id_estudiante']);
                    $('#txt_e_poblacion').val(respuesta['poblacion']);
                    $('#txt_e_codpostal').val(respuesta['codigo_postal']);
                    $('#txt_e_provincia').val(respuesta['provincia']);
                    $('#txt_e_tel').val(respuesta['telefono']);
                }
            })
        }else if(tipo == 'PROFESOR'){
            $('#template-estudiante').remove();
            $.ajax({
                url: 'datos-profesor.php',
                type: 'POST',
                data: {idusuario : idusuario},
                success: function(res){
                    respuesta = JSON.parse(res)
                    console.log(respuesta)
                    
                    $('#txt_p_idpro').val(respuesta['id_profesor']);
                    $('#txt_p_nombre').val(respuesta['nombre']);
                    $('#txt_p_poblacion').val(respuesta['poblacion']);
                    $('#txt_p_codpostal').val(respuesta['codigo_postal']);
                    $('#txt_p_provincia').val(respuesta['provincia']);
                    $('#txt_p_tel').val(respuesta['telefono']);
                }
            })
        }else{
            
        $('#template-profesor').remove();
        $('#template-estudiante').remove();
        }
   </script>
</body>


</html>