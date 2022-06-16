<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/litera/bootstrap.min.css">
    <title>Lista de tareas</title>
    <link rel="stylesheet" href="cronometro/cronometro.css">
</head>

<body>
    <header style="background-color: rgb(106, 199, 70);" class="relative-top">
        <nav class="navbar navbar-expand-lg navbar-light  py-3" id="mainNav">
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
    </header>

    <!-- Masthead-->

    <div class="container p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form id="task-form">
                            <input type="hidden" id="taskId">
                            <div class="form-group">
                                <input type="text" id="name" placeholder="Task name" class="form-control">
                            </div><br>
                            <div class="form-group">
                                <textarea id="description" cols="30" rows="10" class="form-control" placeholder="Task description"></textarea>
                            </div><br>
                            <div class="form-group">
                                <select id="estado" hidden class="form-control">
                                    <option value="SIN EMPEZAR">SIN EMPEZAR</option>
                                    <option value="EN PROCESO">EN PROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                </select>
                            </div><br>
                            <button type="submit" class="btn btn-success btn-block text-center">Guardar tarea</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card my-4" id="task-result">
                    <div class="card-body">
                        <ul id="container"></ul>
                    </div>
                </div>
                <table class="table table-bordered table-sm">
                    <h3>
                        <center>Tareas en proceso</center>
                    </h3>
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Estado</td>
                            <td>Punto Clave</td>
                        </tr>
                    </thead>
                    <tbody id="tasks-en-proceso">

                    </tbody>
                </table>
                <table class="table table-bordered table-sm">
                    <h3>
                        <center>Tareas sin empezar</center>
                    </h3>
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Estado</td>
                            <td>Punto Clave</td>
                        </tr>
                    </thead>
                    <tbody id="tasks-sin-empezar">

                    </tbody>
                </table>
                <table class="table table-bordered table-sm">
                    <h3>
                        <center>Tareas completadas</center>
                    </h3>
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="tasks-completed">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade principal" id="modal_puntosclave" tabindex="-1" aria-labelledby="modal_puntosclaveLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_puntosclaveLabel">Lista de puntos clave de la tarea</h5>
                    </div>

                    <div class="modal-body">
                        
                        <ul class="list" id="listadoPuntosClave" tareapc=''>

                        </ul>
                        <form >

                            <div class=" mb-3">

                            <label for="addpuntoclave" class="col-form-label">Nuevo punto clave:</label>
                            <input type="text" class="form-control" id="addpuntoclave">

                    </div>
                    <button type="button" class="btn btn-success btnaddpuntoclave">Añadir</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade principal" id="modal_cronometro" aria-labelledby="modal_cronometroLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_cronometroLabel">Cronómetro</h5>
                </div>

                <div class="modal-body crmt">
                    <div class="circle">
                        <div id="stopwatch" class="stopwatch">00:00</div>
                        <div class="buttons">
                            <div class="stop" onclick="stop()"></div>
                            <div id="play-pause" class="paused" onclick="playPause();"></div>
                        </div>
                    </div>
                    <div class="seconds-sphere" id="seconds-sphere"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade principal" id="modal_temporizador" aria-labelledby="modal_temporizadorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_temporizadorLabel">Cronómetro</h5>
                </div>

                <div class="modal-body">
                    <div id="contenedorInputs">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-control-label">Minutos</label>
                                <div>
                                    <input class="input form-control" id="minutos" type="number" placeholder="Minutos">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-control-label">Segundos</label>
                                <div>
                                    <input class="input form-control" id="segundos" type="number" placeholder="Segundos">
                                </div>
                            </div>
                        </div>

                    </div>
                    <h2 id="tiempoRestante" class="text-center">00:00.0</h2>
                    <div class="row">
                        <button type="button" id="btnIniciar" class="btn btn-success col-md-12 ms-auto" onclick="iniciarTemporizador()"><span class="mdi mdi-play">Iniciar</span></button>
                        <button type="button" id="btnPausar" class="btn btn-success col-md-12 ms-auto" onclick="pausarTemporizador()"><span class="mdi mdi-pause">Pausar</span></button>
                        <button type="button" id="btnDetener" class="btn btn-success col-md-12 ms-auto" onclick="detenerTemporizador()"><span class="mdi mdi-stop">Detener</span></button>
                    </div>
                </div>

                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="app.js"></script>
    <script src="cronometro/cronometro.js"></script>
    <script src="temporizador/temporizador.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>