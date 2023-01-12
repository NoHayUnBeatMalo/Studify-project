<?php
include_once '../../conexion.php';
include_once  '../../configuracion.php';
include_once  'carritocompra.php';
if (!isset($_SESSION)) {
    session_start();
}
$idusuario = $_GET['idu'];
if (!isset($idusuario)) {
    $idusuario = $_GET['username'];
}
//echo $idusuario;
$modo = isset($_GET['modo']) ? $_GET['modo'] : '';
if ($modo == 'vaciar') {
    session_destroy();
    header("Location: cursos.php?idu=$idusuario");
}



$secret_iv = 'Studify';
$iv = substr(hash('sha256', $secret_iv), 0, 16);

$sqlrol = "SELECT rol_id FROM usuarios WHERE idusuario = $idusuario";
$consultatipo = $pdo->prepare($sqlrol);
$consultatipo->execute();
$resultado = $consultatipo->fetch(PDO::FETCH_ASSOC);
$rol = $resultado['rol_id'];
//echo $tipo;
$sql = "SELECT tipo_id FROM usuarios WHERE idusuario = $idusuario";
$consultatipo = $pdo->prepare($sql);
$consultatipo->execute();
$tipo = $consultatipo->fetch(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda online</title>
    <link rel="stylesheet" href="styles/modal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style-principal.css">
</head>

<body>

    <header style="background-color: rgb(106, 199, 70);" class="relative-top">
        <nav class="navbar navbar-expand-lg navbar-light  py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../index.php?username=<?php echo $idusuario ?>">Studify</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item active"><a class="nav-link" href="mostrarCarrito.php?idu=<?php echo $idusuario; ?>">Carrito(<?php if (empty($_SESSION['CARRITO'])) {
                                                                                                                                            echo 0;
                                                                                                                                        } else {
                                                                                                                                            echo count($_SESSION['CARRITO']);
                                                                                                                                        }; ?>)</a></li>

                        <li class="nav-item"><a class="nav-link" href="../taskApp/index.php?idu=<?php echo $idusuario ?>">Lista de tareas</a></li>
                        <li class="nav-item"><a class="nav-link" href="cursos.php?idu=<?php echo $idusuario; ?>">Nuestros cursos</a></li>
                        <li class="nav-item"><a class="nav-link" href="../perfil/perfil.php?idu=<?php echo $idusuario; ?>">Perfil</a></li>
                        <?php

                        if ($rol == 1) {
                            echo '
                <li class="nav-item"><a class="nav-link" href="../../vista/index.php?idu=' . $idusuario . '">PANEL DE ADMIN</a></li>
                    ';
                        } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Masthead-->
    <div class="alert alert-secondary">
        Número de productos actual:
        <?php echo isset($_SESSION['CARRITO']) ? count($_SESSION['CARRITO']) : 0; ?>
        <a href="mostrarCarrito.php?idu=<?php echo $idusuario; ?>" class="badge badge-info">Ver carrito</a>
        <a class="nav-link badge badge-secondary" href="?modo=vaciar">Vaciar carrito</a>
        <br />
        <?php //echo $mensaje; 
        ?>
        <?php //print_r($_POST); 
        ?>

    </div>
    <main>
        <h2>
            <center>Nuestros cursos</center>
        </h2>
        <div class="container">
            <?php
            if ($tipo['tipo_id'] == 2) {
                echo '<center><button type="button" class="btn btn-secondary open-modal" data-open="modal1">Añadir nuevo curso</button></center>
                <br><br>';
            }
            ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php

                $sql = "SELECT * FROM curso INNER JOIN profesores WHERE cod_profesor=id_profesor";
                $selectcursos = $pdo->prepare($sql);
                $selectcursos->execute();
                $resultado = $selectcursos->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultado as $row) {

                ?>

                    <div class="col">
                        <div class="card shadow-sm" cod_curso="<?php $row['cod_curso']; ?>">


                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $row['nombre_curso']; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $row['descripcion']; ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="detalles.php?idprod=<?php echo $row['cod_curso']; ?>&token=<?php echo hash_hmac('sha1', $row['cod_curso'], 'Studify'); ?>&idu=<?php echo $idusuario ?>" class="btn btn-secondary">Detalles</a>
                                        <p class="card-price text-muted">
                                            <?php if ($row['descuento'] > 0) {
                                                $precio_desc = $row['precio_curso'] - (($row['precio_curso'] * $row['descuento']) / 100);
                                                echo '<small style="color: red;"><del>' . number_format($row['precio_curso'], 2, ',', '.') . '</del></small>&nbsp;&nbsp;&nbsp;&nbsp;' . number_format($precio_desc, 2, ',', '.');
                                            } else {
                                                echo number_format($row['precio_curso'], 2, ',', '.');
                                            } ?>
                                            €
                                        </p>
                                    </div>
                                    <div class="btn-group form">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_curso" id="id_curso" value="<?php echo openssl_encrypt($row['cod_curso'], 'AES-256-CBC', 'Studify', 0, $iv) ?>" />
                                            <input type="hidden" name="curso" id="curso" value="<?php echo openssl_encrypt($row['nombre_curso'], 'AES-256-CBC', 'Studify', 0, $iv) ?>" />
                                            <input type="hidden" name="precio" id="precio" value="<?php if ($row['descuento'] > 0) {
                                                                                                        $precio_descuento = $row['precio_curso'] - (($row['precio_curso'] * $row['descuento']) / 100);
                                                                                                        $precioenviar =  openssl_encrypt($precio_descuento, 'AES-256-CBC', 'Studify', 0, $iv);
                                                                                                    } else {
                                                                                                        $precioenviar = openssl_encrypt($row['precio_curso'], 'AES-256-CBC', 'Studify', 0, $iv);
                                                                                                    }
                                                                                                    echo $precioenviar; ?>" />


                                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, 'AES-256-CBC', 'Studify', 0, $iv) ?>" />
                                            <?php //echo openssl_encrypt(1, 'AES-256-CBC', 'Studify', 0, $iv)
                                            ?>
                                            <div class="form-group">
                                                <select class="form-control form-group" id="cantidad" name="cantidad">

                                                    <option value="<?php echo openssl_encrypt(1, 'AES-256-CBC', 'Studify', 0, $iv) ?>">1</option>
                                                    <option value="<?php echo openssl_encrypt(2, 'AES-256-CBC', 'Studify', 0, $iv) ?>">2</option>
                                                    <option value="<?php echo openssl_encrypt(3, 'AES-256-CBC', 'Studify', 0, $iv) ?>">3</option>
                                                    <option value="<?php echo openssl_encrypt(4, 'AES-256-CBC', 'Studify', 0, $iv) ?>">4</option>
                                                    <option value="<?php echo openssl_encrypt(5, 'AES-256-CBC', 'Studify', 0, $iv) ?>">5</option>
                                                </select>
                                            </div>

                                            <button class="btn btn-success" name="btnAccion" value="Agregar" type="submit">Añadir al carrito</button>
                                        </form>
                                    </div>


                                </div>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><small>Fecha del curso: </small>
                                    <?php echo $row['fechacurso'] ?>
                                </li>
                                <li class="list-group-item"><small>Profesor: </small>
                                    <?php echo $row['nombre'] ?>
                                </li>

                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </main>
    
<div class="modal" id="modal1">
  <div class="modal-dialog">
    <header class="modal-header">
      ...
      <button class="close-modal" aria-label="close modal" data-close>✕</button>
    </header>
    <section class="modal-content">...</section>
    <footer class="modal-footer">...</footer>
  </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        const openEls = document.querySelectorAll("[data-open]");
const isVisible = "is-visible";
for(const el of openEls) {
  el.addEventListener("click", function() {
    const modalId = this.dataset.open;
    document.getElementById(modalId).classList.add(isVisible);
  });
}
const closeEls = document.querySelectorAll("[data-close]");
for (const el of closeEls) {
  el.addEventListener("click", function() {
    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
  });
}

document.addEventListener("click", e => {
  if (e.target == document.querySelector(".modal.is-visible")) {
    document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }
});
document.addEventListener("keyup", e => {
  if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
    document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }
});
    </script>

</body>

</html>