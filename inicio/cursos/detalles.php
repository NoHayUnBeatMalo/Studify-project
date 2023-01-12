<?php
include '../../conexion.php';
include '../../configuracion.php';

$id = $_GET['idprod'];
$token = $_GET['token'];
$token_tmp = hash_hmac('sha1', $id, KEY);
echo $token_tmp;
$ownprod = false;
$idusuario = $_GET['idu'];




$comparador = strcmp($token, $token_tmp);
if ($comparador == 0) {
    $querycount = "SELECT count(cod_curso) FROM tfg.curso WHERE cod_curso='" . $id . "' AND estado='ACTIVO'";
    $sql = $pdo->prepare($querycount);
    $sql->execute();
    if ($sql->fetchColumn() > 0) {
        $queryselectprod = "SELECT curso.nombre_curso, profesores.nombre, curso.descripcion, curso.precio_curso, curso.descuento, profesores.id_usuario_profesor FROM tfg.curso INNER JOIN tfg.profesores ON curso.cod_profesor=profesores.id_profesor WHERE cod_curso='" . $id . "' AND estado='ACTIVO' LIMIT 1";
        $consulta = $pdo->prepare($queryselectprod);
        $consulta->execute();
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['nombre_curso'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio_curso'];
        $descuento = $row['descuento'];
        $propietario = $row['id_usuario_profesor'];

        if ($propietario == $idusuario) {
            $ownprod = true;
        }

        $precio_desc = $precio - (($precio * $descuento) / 100);
        $dir_images = 'images/productos/' . $id . '/';
        $rutaImg = $dir_images . 'principal.jpg';

        if (!file_exists($rutaImg)) {
            $rutaImg = 'images/no-photo.jpg';
        }
        $imagenes = array();
        if (file_exists($dir_images)) {
            $dir = dir($dir_images);
            while (($archivo = $dir->read()) != false) {
                if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
                    $images = $dir_images . $archivo;
                    $imagenes[] = $images;
                }
            }
            $dir->close();
        }


        $queryselecttemas = "SELECT idtema, titulotema, descripciontema FROM tfg.temas WHERE idcursotema = '$id'";
        $arraytemas = array();
        $consultatemas = $pdo->prepare($queryselecttemas);
        $consultatemas->execute();
        while ($fila = $consultatemas->fetch(PDO::FETCH_ASSOC)) {
            $arraytemas[] = $fila;
        }
    } else {
        echo 'Error select data';
    }
} else {
    echo 'Error con token';
    exit;
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style-principal.css">
</head>

<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <strong>Nuestros cursos</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarHeader">
                    
                    <a href="clases/carrito.php" class="btn btn-primary">Carrito<span id="num_cart" class="badge bg-secondary"><?php print $num_cart; ?></span> </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <?php if ($ownprod == true) {
                echo '<div class="row">
                <a name="edit-prod" id="edit-prod" class="btn btn-dark justify-content-center" onclick="abrirModalEditar()" role="button">EDITAR CURSO</a><br>
            </div>
            <br>';
            } ?>

            <div class="row">
                <div class="col-md-6 order-md-1">

                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <!--
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img style="opacity: 0.5;" src="<?php echo $rutaImg; ?>" alt="" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 style="color: #000"><?php echo $nombre; ?></h5>
                                    <p style="color: #000"><?php echo $descripcion; ?></p>
                                </div>
                            </div>

                            <?php foreach ($imagenes as $img) { ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $img ?>" class="d-block w-100">
                                </div>

                            <?php } ?>

                        </div>
                        <!--
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                            -->
                    </div>
                </div>
                <div class="col-md-6 order-md-2">
                    <h2 class="curso-item-title"><?php echo $nombre; ?></h2>
                    
                    <?php if ($descuento > 0) { ?>
                        <p class="curso-item-price" style="color: red"><del><?php echo MONEDA . number_format($precio, 2, ",", "."); ?></del></p>
                        <h2 class="curso-item-price">
                            <?php echo MONEDA . number_format($precio_desc, 2, ",", "."); ?>
                            <small class="text-success"><?php echo $descuento; ?>% de descuento</small>
                        </h2>
                    <?php } else { ?>
                        <h2 class="curso-item-price"><?php echo MONEDA . number_format($precio, 2, ",", "."); ?></h2>
                    <?php } ?>
                    <p class="lead">
                        <?php echo $descripcion ?>
                    </p>
                    <h4><b>Temas del curso: </b></h4>
                    <div class="temas">
                        <?php foreach ($arraytemas as $key => $tema) { ?>
                            <h6><?php echo $arraytemas[$key]['titulotema'] ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="tema.php?idtema=<?php echo $arraytemas[$key]['idtema'] ?>&iu=<?php echo $idusuario ?>">Ir al tema</a></h6>
                            <p><?php echo $arraytemas[$key]['descripciontema'];
                                echo $arraytemas[$key]['idtema'];


                                ?></button></p>
                        <?php } ?>
                    </div>

                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button type="button" class="btn btn-primary">Comprar ahora</button>
                        <button type="button" class="btn btn-outline-primary" onclick="addProducto('<?php echo $id; ?>', '<?php echo $token_tmp; ?>')">Añadir a la lista de deseos</button>

                    </div>

                </div>
            </div>
        </div>

    </main>
    <form autocomplete="false" onsubmit="return false">
        <div class="modal fade" id="modal_cupon" role="dialog">
            <div class="modal-dialog modal-sm" style="max-width: 750px!important;">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Aplicar cupón de descuento</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->

                    <div class="row">

                        <div class="modal-body col-lg-4">
                            <div class="col-lg-12">
                                <label for="txt_cupon">Añade el código de descuento</label>
                                <input type="text" class="form-control col-lg-12" id="txt_cupon" placeholder="Ingrese su código de descuento"><br>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="aplicarCuponDescuento(); console.log('onclick');">Registrar</button>
                        <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <form autocomplete="false" onsubmit="return false">
        <div class="modal fade" id="modalEditarCurso" role="dialog">
            <div class="modal-dialog modal-sm" style="max-width: 750px!important;">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modificar curso</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->

                    <div class="row">

                        <div class="modal-body col-lg-6">
                            <div class="col-lg-12">
                                <label for="txt_cupon">Nombre del curso</label>
                                <input type="text" class="form-control col-lg-12" id="txt_nombre" placeholder="Ingrese su código de descuento"><br>
                            </div>
                        </div>
                        <div class="modal-body col-lg-6">
                            <div class="col-lg-12">
                                <label for="txt_cupon">Descripcion del curso</label>
                                <input type="text" class="form-control col-lg-12" id="txt_descripcion" placeholder="Ingrese su código de descuento"><br>
                            </div>
                        </div>
                        

                    </div>
                    <div class="row">
                    <div class="modal-body col-lg-4">
                            <div class="col-lg-12">
                                <label for="txt_cupon">Horas del curso</label>
                                <input type="text" class="form-control col-lg-12" id="txt_horas" placeholder="Ingrese su código de descuento"><br>
                            </div>
                        </div>

                        <div class="modal-body col-lg-4">
                            <div class="col-lg-12">
                                <label for="txt_cupon">Precio del curso</label>
                                <input type="text" class="form-control col-lg-12" id="txt_precio" placeholder="Ingrese su código de descuento"><br>
                            </div>
                        </div>
                        <div class="modal-body col-lg-4">
                            <div class="col-lg-12">
                                <label for="txt_cupon">Añade un descuento</label>
                                <input type="text" class="form-control col-lg-12" id="txt_descuento" placeholder="Ingrese su código de descuento"><br>
                            </div>
                        </div>
                        

                    </div>
                    <div class="row">
                        <div class="modal-body col-lg-4">
                            <div class="col-lg-12">
                            <!--    
                            <select class="form-control col-lg-6" id="txt_categoria" >
                                    <?php
                                    /* $selectCategorias = 'SELECT * FROM categoriascurso';
                                    $consultacat = $con->query($selectCategorias);
                                    foreach($consultacat as $cat){
                                        echo '<option value="'.$cat['nombrecat'].'">'.$cat['nombrecat'].'</option>';
                                    }
                                    */
                                    ?>
                                </select>
                                -->
                            </div>
                        </div>

                        <div class="modal-body col-lg-4">
                            <div class="col-lg-12">
                                <?php if($estado = 'ACTIVO'){
                                    echo '<button type="button" class="form-control col-lg-6 btn btn-warning" id="deactivate">Desactivar</button><br>';
                                }else{
                                    echo '<button type="button" class="form-control col-lg-6 btn btn-success" id="activate">Activar</button><br>';
                                } ?>
                                </div>
                        </div>
                        

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="aplicarCuponDescuento(); console.log('onclick');">Registrar</button>
                        <button type="button" class="btn btn-danger" id="btn-modal-close" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">

    </script>
    <script src="js/curso.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        function abrirModalCupon() {
            $('#modal_cupon').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_cupon').modal('show');
        }
        function abrirModalEditar(){
            $('#modalEditarCurso').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modalEditarCurso').modal('show');
        }
        $('#edit-prod').on('click', function(){
            abrirModalEditar();
        });
        $(document).on('click', '#edit-prod', function () {
            let element = $(this)[0].parentElement;
            console.log(element)

        });

        
    </script>
</body>

</html>