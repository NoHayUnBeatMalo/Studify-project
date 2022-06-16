<?php 
session_start();
$idusuario = $_GET['username'];
if(isset($_SESSION['S_IDUSUARIO'])){
    session_destroy();
    header('Location: ../login/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inicio</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php?username=<?php echo $idusuario ?>">Studify</a>
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
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">LA MEJOR APLICACIÓN PARA AYUDARTE A ESTUDIAR</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">STUDIFY es una aplicación pensada para ayudar a personas que están en proceso de terminar sus estudios. Para ello cuenta con un calendario único, una lista para que apuntes tus tareas y un listado de cursos a los que te puedes inscribir</p>
                        <a class="btn btn-primary btn-xl" href="#about">Descubre más</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">¡Tenemos lo que necesitas!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Studify tiene todo lo que necesitas en una sola aplicación</p>
                        <a class="btn btn-light btn-xl" href="#services">Muestrame más</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Tus servicios</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Lista de tareas</h3>
                            <p class="text-muted mb-0">La lista de tareas te va a permitir crecerte con la presión, ya que con ella podrás organizarte como tu quieras.<br>¡Conseguirás tener todo al día!</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Calendario</h3>
                            <p class="text-muted mb-0">Sabemos lo apretada que tiene un estudiante su agenda, ya sea con exámenes, tareas diarias, trabajos, presentaciones...Por ello te ofrecemos un calendario en el que apuntar lo que tengas que hacer</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Cursos Studify</h3>
                            <p class="text-muted mb-0">¿De qué vale un buen estdiante si no tiene un buen profesor? Esta pregunta nos la hemos hecho muchas veces por ello queremos ofrecerles cursos con los mejores profesores del mercado.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/cursos01.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/cursos01.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Atiende</div>
                                <div class="project-name">Concéntrate</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 portfolio-box">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/cursos02.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/cursos02.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Toma apuntes</div>
                                <div class="project-name">Se ordenado</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/cursos03.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/cursos03.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Repasa lo aprendido</div>
                                <div class="project-name">Lee en voz alta</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 portfolio-box">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/cursos04.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/cursos04.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Organiza tu tiempo</div>
                                <div class="project-name">Establecer plazos y metas</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/cursos05.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/cursos05.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Compartir responsabilidades</div>
                                <div class="project-name">Pide ayuda si lo necesitas</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 portfolio-box">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/cursos06.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/cursos06.jpg" alt="..." />
                            <div class="portfolio-box-caption p-3">
                                <div class="project-category text-white-50">Descansa</div>
                                <div class="project-name">Ten un sueño tranquilo</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Free Download at Start Bootstrap!</h2>
                <a class="btn btn-light btn-xl" href="https://startbootstrap.com/theme/creative/">Download Now!</a>
            </div>
        </section>
        <!-- Contact-->
        
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2022 - Company Name</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
