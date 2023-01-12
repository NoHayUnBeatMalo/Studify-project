

var table = $('#tabla_ventas').DataTable();

var listar_ventas = function () {

    $.ajax({
        url: '../controlador/ventas/controlador_listar_ventas.php',
        
        type: 'POST'
    }).done(function (res) {
        const dataNS = JSON.parse(res);

        console.log(dataNS)

        table = $('#tabla_ventas').DataTable({
            'serverSide': false,
            'ordering': false,
            'orderCellsTop': true,
            'fixedHeader': true,
            'paging': false,
            'responsive': true,
            'searching': {
                'regex': true
            },
            'lengthMenu': [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],

            'pageLength': 10,

            'destroy': true,

            'async': false,

            'processing': true,

            data: dataNS,
            'columns': [{
                    data: 'id_venta'
                },
                {
                    data: 'clavetransaccion'
                },
                {
                    data: 'datos_paypal'
                },
                {
                    data: 'fecha'
                },
                {
                    data: 'correo'
                },
                {
                    data: 'total'
                },
                {
                    data: 'estatus'
                },
            ],


            'language': idioma_espanol,
            select: true
        });
    });
}
listar_ventas();