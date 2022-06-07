$(document).ready(function () {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idusuario = urlParams.get('idu');
    console.log(idusuario)

    function traerDatosUsuario(idusuario){
        $.ajax({
            url: 'traer_datos_usuario.php',
            type: 'POST',
            data:{idusuario},
            success: function(resp){
                console.log(resp)
            }
        })
    }


})