<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.9/dist/sweetalert2.all.min.js"></script>
    
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../../index.php?username=<?php echo $_SESSION['S_IDUSUARIO'] ?>">Studify</a>
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
        
    <div class="container">
        <div class="col-md-11 offset-md-0.5">

            <div id='calendar'></div>
        </div>
    </div>

    <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <form id="formulario">
                    
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            
                        <input type="hidden" id="idusuario" name="idusuario" value="<?php $_SESSION['S_IDUSUARIO']; ?>">
                            <input type="hidden" id="id" name="id" ">
                            <input type="text" class="form-control" id="title" name="title">
                            <label for="title" class="form-label">Evento</label>
                        </div>
                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="description" name="description">
                            <label for="description" class="form-label">Descripcion</label>
                        </div>
                        <div class="form-floating mb-3">

                            <input type="date" class="form-control" id="start" name="start">
                            <label for="start" class="form-label">Fecha inicio</label>
                        </div>
                        <div class="form-floating mb-3">

                            <input type="date" class="form-control" id="end" name="end">
                            <label for="end" class="form-label">Fecha fin</label>
                        </div>
                        
                        <div class="form-floating mb-3">

                            <input type="color" class="form-control" id="color" name="color">
                            <label for="color" class="form-label">Color</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="button" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-danger" id="btnEliminar" type="button">Eliminar</button>
                        <button class="btn btn-info" id="btnAccion" type="submit">Registrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




    
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
        <script>
            const base_url = 'http://localhost/Studify/inicio/calendar2/';
        </script>
        <script src="app.js"></script>

</body>

</html>