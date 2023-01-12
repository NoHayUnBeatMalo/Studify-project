
var table = $('#tabla_ventas_detalle').DataTable();

var listar_ventas_detalle = function () {

    $.ajax({
        url: '../controlador/ventas/controlador_listar_ventas_detalle.php',
        
        type: 'POST'
    }).done(function (res) {
        const dataNS = JSON.parse(res);
        console.log(res)
        console.log(dataNS)

        table = $('#tabla_ventas_detalle').DataTable({
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
                    data: 'id_venta_detalle'
                },
                {
                    data: 'id_venta'
                },
                {
                    data: 'id_producto'
                },
                {
                    data: 'precio_unitario'
                },
                {
                    data: 'cantidad'
                },
            ],


            'language': idioma_espanol,
            select: true
        });
    });
}
listar_ventas_detalle();