$(document).ready(function () {
    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    var idusuario = urlParams.get('idu');
    console.log(idusuario)
    console.log("jQuery is working");
    $('#task-result').hide();
    fetchTask();

    $('#search').keyup(function (e) {

        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: {
                    search
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
    });
    //fetch 
    function fetchTask() {
        console.log(idusuario);
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
                    if (task.estado == 'EN PROCESO') {

                        templateenproceso += `
                        <tr taskId= "${task.id}">
                            <td>${task.id}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td>${task.estado}
                                <div class="progress"> 
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 65%"></div>
                                </div>
                            </td>
                            <td><button class="btn btn-primary puntosClave">Puntos clave</button></td>
                            <td>
                                <button class="task-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `
                    } else if (task.estado == 'TERMINADO') {
                        templatecompletada += `
                        <tr taskId= "${task.id}">
                            <td>${task.id}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td >
                                <button class="btn btn-success " style="background: #5CF951">${task.estado}</td></button>
                            
                            <td hidden><button class="btn btn-primary puntosClave"></button></td>
                            <td>
                                <button class="task-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `
                    } else {
                        templatesinempezar += `
                        <tr taskId= "${task.id}">
                            <td>${task.id}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td>${task.estado}</td>
                            <td class="td-puntosclave">` + getPuntosClave();
                        console.log(getPuntosClave()); + `</td>
                            <td>
                                <button class="task-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
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
    //eliminar tarea 
    $(document).on('click', '.task-delete', function () {
        if (confirm('Are you sure you want to delete it?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');
            $.post('task-delete.php', {
                id
            }, function (response) {
                fetchTask();
            });
        }
    });
    //mostrar datos para editar
    $(document).on('click', '.task-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskId');
        $.post('task-single.php', {
            id: id
        }, function (response) {
            const task = JSON.parse(response);
            console.log(task)
            $('#name').val(task.name);
            $('#description').val(task.description);
            $('#taskId').val(task.id);
            $('#estado').val(task.estado);
            $('#estado').attr("hidden", false);
            edit = true;
        });
    });
    //modal abrir
    function abrirModalPuntosClave() {
        $('#modal_puntosclave').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#modal_puntosclave').modal('show');
    }
    $(document).on('click', '.puntosClave', function () {
        abrirModalPuntosClave();
    });
    $(document).on('click', '.td-puntosclave', function () {
        let element = $(this)[0].parentElement.parentElement;
        let idtarea = $(element).attr('taskId');
        getPuntosClave(idtarea);
        abrirModalPuntosClave()
    })

    function getPuntosClave(idtarea) {

        $.ajax({
            url: 'task-list-puntosclave.php',
            type: 'POST',
            data: {
                idusuario,
                idtarea

            },
            success: function (response) {
                console.log('res task list puntos clave: ------> ' + response)
                let puntosClave = JSON.parse(response);
                console.log(puntosClave)
                let template = '';
                puntosClave.forEach(puntoClave => {
                    console.log(puntosClave)
                    console.log('pc:----->' + puntoClave)
                    if (response == 'undefined') {
                        template += `
                                <button class="btn btn-primary puntosClave">Puntos clave</button>
                        `
                    } else if (puntosClave.idusu == idusuario) {
                        descriptionPuntosClave = puntoClave.lista;
                        console.log(descriptionPuntosClave)
                    }
                })

                $('.td-puntosClave').html(template);
            }
        });

    }
});