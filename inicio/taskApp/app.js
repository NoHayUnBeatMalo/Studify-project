$(document).ready(function () {
    const valores = window.location.search
    const urlParams = new URLSearchParams(valores);

    var idusuario = urlParams.get('idu');
    console.log('idus: ' + idusuario)
    console.log("jQuery is working");
    $('#task-result').hide();
    fetchTask();
    
    console.log(idusuario);

    function fetchTask() {
        //enviar
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            data: {
                idusuario
            },
            success: function (response) {
                console.log(response)
                //parseamos la respuesta
                let tasks = JSON.parse(response);
                console.log(tasks)
                let templatesinempezar = '';
                let templateenproceso = '';
                let templatecompletada = '';
                //recogida 1 a 1
                tasks.forEach(task => {
                    console.log(task)
                    console.log(task.idtarea)
                    if (task.estado == 'EN PROCESO') {

                        templateenproceso += `
                        <tr taskId= "${task.idtarea}">
                            <td>${task.idtarea}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td>${task.estado}
                                <div class="progress"> 
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 65%"></div>
                                </div>
                            </td>
                            
                            <td>
                                <button class="task-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                            <td>
                                <button class="show-cronometro btn btn-secondary"><a href="#">
                                    Cronómetro
                                </button>
                                
                            </td>
                            <td><button class="show-tempo btn btn-secondary"><a href="#">
                            Temporizador
                        </button></td>
                        </tr>
                    `
                    } else if (task.estado == 'TERMINADO') {
                        templatecompletada += `
                        <tr taskId= "${task.idtarea}">
                            <td>${task.idtarea}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td>
                                <button class="task-delete btn btn-danger w-100">
                                    Delete
                                </button>
                            </td>
                           
                        </tr>
                    `
                    } else {
                        console.log(task)
                        templatesinempezar += `
                        <tr taskId= "${task.idtarea}">
                            <td>${task.idtarea}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td>${task.estado}</td>
                            <button class="task-delete btn btn-danger">
                                Delete
                            </button>
                            </td>
                            <td>
                                <button class="task-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                            <td>
                                <button class="show-cronometro btn btn-secondary" ><a href="#">Cronómetro</a>
                                </button>
                                
                            </td>
                            <td><button class="show-tempo btn btn-secondary"><a href="#">
                            Temporizador
                        </button></td>
                        </tr>
                    `
                    }

                });
                $('#tasks-en-proceso').html(templateenproceso);
                $('#tasks-sin-empezar').html(templatesinempezar);
                $('#tasks-completed').html(templatecompletada)
            }
        });
        edit = false;
    }
    //boton enviar 
    $('#task-form').submit(e => {
        //objeto que guarde los valores de los inputs
        const postData = {
            name: $('#name').val(),
            description: $('#description').val(),
            id: $('#taskId').val(),
            estado: $('#estado').val(),
            idusuario: idusuario
        };

        console.log('postData: ----> ' + JSON.stringify(postData))
        console.log(edit)
        //definimos donde enviar en funcion de si es editar o añadir 
        let url;
        if (edit === false) {
            url = 'task-add.php';
        } else {
            url = 'task-edit.php';
        }

        console.log(url)
        console.log(postData)

        //enviar 
        $.post(url, postData, function (response) {
            console.log('resp: --->' + response)
            fetchTask();
            $('#task-form').trigger('reset');
            $('#estado').attr("hidden", true);
        })
        //evitar recarga
        e.preventDefault();
        edit == false;
    });
    $(document).on('click', '.task-delete', function () {
        if (confirm('¿Estás seguro que quieres eliminarla? No la podrás recuperar después')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');

            $.post('task-delete.php', {
                id
            }, function (response) {
                fetchTask();
            });
        }
    });

    $(document).on('click', '.show-cronometro', function () {
        abrirModalCronometro();
    })
    $(document).on('click', '.show-tempo', function () {
        abrirModalTemporizador();
    })

   
    
    $('#search').keyup(function (e) {

        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: {
                    search,
                    idusuario
                },
                success: function (response) {
                    let tasks = JSON.parse(response);
                    let template = '';
                    tasks.forEach(task => {
                        template += `<li>
                    ${task.name}
                    </li>`
                    });
                    $('#container').html(template);
                    $('#task-result').show();
                }

            });

        }
    });

    //mostrar datos para editar
    $(document).on('click', '.task-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        console.log(element)
        let id = $(element).attr('taskId');
        console.log(id)
        $.post('task-single.php', {
            id: id,
            idusuario: idusuario
        }, function (response) {
            const task = JSON.parse(response);
            console.log(task)
            $('#name').val(task[0].name);
            $('#description').val(task[0].description);
            $('#taskId').val(id);
            $('#estado').val(task[0].estado);
            $('#estado').attr("hidden", false);
            edit = true;
            console.log(edit)
        });
    });

  

    function abrirModalCronometro() {
        $('#modal_cronometro').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#modal_cronometro').modal('show');
    }

    function abrirModalTemporizador() {
        $('#modal_temporizador').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#modal_temporizador').modal('show');
    }
  



});