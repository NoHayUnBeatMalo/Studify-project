<?php
require 'config/database.php';
require 'config/config.php';
$db = new Database();
$con = $db->conectar();
$sqlCurso = $con->prepare("SELECT curso.idimgfk, curso.cod_curso, profesores.nombre, curso.nombre_curso, curso.descripcion, curso.horas_curso, curso.precio_curso, curso.descuento, curso.fechapublicacion, curso.participantes FROM tfg.curso INNER JOIN tfg.profesores ON curso.cod_profesor = profesores.id_profesor WHERE curso.estado='ACTIVO'");
$sqlCurso->execute();
$resultado = $sqlCurso->fetchAll(PDO::FETCH_ASSOC);
$idusuario = $_GET['idu'];





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda online</title>
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
                    <strong>Tienda online</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catálogo</a>
                        </li>
                    </ul>
                    <a href="clases/carrito.php" class="btn btn-primary">Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span> </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h2>
            <center>Nuestros cursos</center>
        </h2>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($resultado as $row) {
                    echo $row['idimgfk']; ?>

                    <div class="col">
                        <div class="card shadow-sm" cod_curso="<?php $row['cod_curso']; ?>">
                            <?php
                            $sqlImages = $con->prepare("SELECT images.image FROM tfg.images WHERE idimg='" . $row['idimgfk'] . "';");
                            $sqlImages->execute();
                            if ($sqlImages->rowCount() > 0) {

                                $imgData = $sqlImages->fetchAll(PDO::FETCH_ASSOC);

                                //Render image
                                header("Content-type: image/jpg");
                                echo $imgData['image'];
                            } else {
                                echo 'Image not found...';
                            }
                            ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombre_curso']; ?></h5>
                                <p class="card-text"><?php echo $row['descripcion']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="detalles.php?idprod=<?php echo $row['cod_curso']; ?>&token=<?php echo hash_hmac('sha1', $row['cod_curso'], KEY_TOKEN); ?>&idu=<?php echo $idusuario ?>" class="btn btn-primary">Detalles</a>
                                    </div>

                                    <a href="#" class="btn btn-success">Agregar</a>
                                    <p class="card-price text-muted">
                                        <?php if ($row['descuento'] > 0) {
                                            $precio_desc = $row['precio_curso'] - (($row['precio_curso'] * $row['descuento']) / 100);
                                            echo '<small style="color: red;"><del>' . number_format($row['precio_curso'], 2, ',', '.') . '</del></small>&nbsp;&nbsp;&nbsp;&nbsp;' . number_format($precio_desc, 2, ',', '.');
                                        } else {
                                            echo number_format($row['precio_curso'], 2, ',', '.');
                                        } ?>
                                        €</p>
                                </div>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><small>Horas del curso: </small><?php echo $row['horas_curso'] ?></li>
                                <li class="list-group-item"><small>Profesor: </small><?php echo $row['nombre'] ?></li>

                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>