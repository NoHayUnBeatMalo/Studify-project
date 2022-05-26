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
        let url;
        if (edit === false) {
            url = 'task-add.php';
        } else {
            url = 'task-edit.php';
        }

        console.log(url)
        console.log(postData)
        $.post(url, postData, function (response) {
            console.log('resp: --->' + response)
            fetchTask();
            $('#task-form').trigger('reset');
            $('#estado').attr("hidden", true);
        })
        e.preventDefault();
    });

    function fetchTask() {
        console.log(idusuario);
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            data: {
                idusuario
            },
            success: function (response) {
                console.log(response)
                let tasks = JSON.parse(response);
                console.log(tasks)
                let templatesinempezar = '';
                let templateenproceso = '';
                let templatecompletada = '';
                tasks.forEach(task => {
                    if (task.estado == 'EN PROCESO') {
                        function getRandomArbitrary(min, max) {
                            return Math.random() * (max - min) + min;
                          }
                        templateenproceso += `
                        <tr taskId= "${task.id}">
                            <td>${task.id}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td>${task.estado}
                                <div class="progress"> 
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: %"></div>
                                </div>
                            </td>
                            <td>
                                <button class="task-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `
                    } else if(task.estado == 'TERMINADO'){
                        templatecompletada += `
                        <tr taskId= "${task.id}">
                            <td>${task.id}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td style="background: #5CF951">

                            ${task.estado}</td>
                            <td>
                                <button class="task-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `
                    }else{
                        templatesinempezar += `
                        <tr taskId= "${task.id}">
                            <td>${task.id}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td>${task.estado}</td>
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
});