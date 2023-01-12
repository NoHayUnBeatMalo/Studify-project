<?php
include_once __DIR__.'/../conexion.php';
include_once __DIR__.'/../configuracion.php';
include_once __DIR__.'/cursos/carritocompra.php';
$modo = isset($_GET["modo"])? $_GET["modo"]: '';
    if($modo=='vaciar') {
        session_destroy();
        header('Location: cursos/cursos.php');
    }



?>


<header style="background-color: rgb(106, 199, 70);" class="relative-top">
        <nav class="navbar navbar-expand-lg navbar-light  py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php?username=<?php echo $idusuario; ?>">Studify</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item active"><a class="nav-link" href="mostrarCarrito.php">Carrito(<?php if (empty($_SESSION['CARRITO'])) {echo 0; } else { echo count($_SESSION['CARRITO']); }; ?>)</a></li>
                
                        <li class="nav-item"><a class="nav-link" href="taskApp/index.php?idu=<?php echo $idusuario ?>">Lista de tareas</a></li>
                        <li class="nav-item"><a class="nav-item"><a class="nav-link" href="/cursos/cursos.php?idu=<?php echo $idusuario; ?>">Nuestros cursos</a></a></li>
                        <li class="nav-item"><a class="nav-link" href="perfil/perfil.php?idu=<?php echo $idusuario; ?>">Perfil</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>