<?php
require 'config/database.php';
require 'config/config.php';
$db = new Database();
$con = $db->conectar();
$sqlCurso = $con->prepare("SELECT curso.cod_curso, profesores.nombre, curso.nombre_curso, curso.descripcion, curso.fechacurso, curso.precio_curso, curso.descuento, curso.fechapublicacion FROM tfg.curso INNER JOIN tfg.profesores ON curso.cod_profesor = profesores.id_profesor WHERE curso.estado='ACTIVO'");
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
    <nav style="background-color: rgb(106, 199, 70);" class="navbar navbar-expand-lg navbar-light relative-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php?username=<?php echo $idusuario ?>">Studify</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">

                    <li class="nav-item"><a class="nav-link" href="calendar2/index.php?idu=<?php echo $idusuario ?>">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="taskApp/index.php?idu=<?php echo $idusuario ?>">Lista de tareas</a></li>
                    <a class="nav-item"><a class="nav-link" href="cursos/cursos.php?idu=<?php echo $idusuario; ?>">Nuestros cursos</a></a>

                    <li class="nav-item"><a class="nav-link" href="perfil/perfil.php?idu=<?php echo $idusuario; ?>">Perfil</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->

    <main>
        <h2>
            <center>Nuestros cursos</center>
        </h2>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($resultado as $row) {
                ?>

                    <div class="col">
                        <div class="card shadow-sm" cod_curso="<?php $row['cod_curso']; ?>">


                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombre_curso']; ?></h5>
                                <p class="card-text"><?php echo $row['descripcion']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="detalles.php?idprod=<?php echo $row['cod_curso']; ?>&token=<?php echo hash_hmac('sha1', $row['cod_curso'], KEY_TOKEN); ?>&idu=<?php echo $idusuario ?>" class="btn btn-primary">Detalles</a>
                                    </div>

                                    <a href="checkout.html" id="add" class="btn btn-success btn-add">Agregar</a>
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
                                <li class="list-group-item"><small>Fecha del curso: </small><?php echo $row['fechacurso'] ?></li>
                                <li class="list-group-item"><small>Profesor: </small><?php echo $row['nombre'] ?></li>

                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#add').click(function() {
                alert($(this).attr('id'))
            })
        })

        function addCurso() {
            const url = 'clases/addcurso.php';
            console.log(this)


            let formData = new FormData();
            formData.append('id', id);
            console.log(formData)
            console.log(id)
            fetch(url, {
                    method: 'POST',
                    body: formData,
                }).then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.ok) {
                        let elemento = document.getElementById('num_cart');
                        elemento.innerHTML = data.numero;
                    }
                })
        }
    </script>
</body>

</html>