<?php

include 'carritocompra.php';
include '../../conexion.php';
include '../../configuracion.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$idusuario = $_GET['idu'];
$sql = "SELECT rol_id FROM usuarios WHERE idusuario = $idusuario";
$consultarol = $pdo->prepare($sql);
$consultarol->execute();
$rol = $consultarol->fetch(PDO::FETCH_ASSOC);

?>

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
    <link href="../css/styles.css" rel="stylesheet" />
</head>
<header style="background-color: rgb(106, 199, 70);" class="relative-top">
    <nav class="navbar navbar-expand-lg navbar-light  py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php?username=<?php echo $idusuario ?>">Studify</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item active"><a class="nav-link" href="mostrarCarrito.php?idu=<?php echo $idusuario; ?>">Carrito(<?php if (empty($_SESSION['CARRITO'])) {
                                                                                                                                        echo 0;
                                                                                                                                    } else {
                                                                                                                                        echo count($_SESSION['CARRITO']);
                                                                                                                                    }; ?>)</a></li>

                    <li class="nav-item"><a class="nav-link" href="../taskApp/index.php?idu=<?php echo $idusuario; ?>">Lista de tareas</a></li>
                    <li class="nav-item"><a class="nav-item"><a class="nav-link" href="../cursos/cursos.php?idu=<?php echo $idusuario; ?>">Nuestros cursos</a></a></li>
                    <li class="nav-item"><a class="nav-link" href="../perfil/perfil.php?idu=<?php echo $idusuario; ?>">Perfil</a></li>
                    <?php
                        if($rol['rol_id'] == 1){
                            echo '<li class="nav-item"><a class="nav-item"><a class="nav-link" href="../../vista/index.php">PANEL DE ADMINISTRADOR</a></a></li>
                        
                            ';
                        }

?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php
if ($_POST) {
    $totalpagar = 0.0;
    $correo = isset($_POST["mail"]) ? $_POST["mail"] : 'Studifyadmin@gmail.com';
    $Sid = session_id();
    //echo $Sid;
    foreach ($_SESSION['CARRITO'] as $indice => $productos) {
        $totalpagar = $totalpagar + ($productos['precio'] * $productos['cantidad']);
    }
    $sqlinsert = $pdo->prepare("INSERT INTO ventas(clavetransaccion, datos_paypal, correo, total, estatus) VALUES ('$Sid', '$Sid','$correo','$totalpagar','pendiente');");
    $sqlinsert->execute();
    $id_venta = $pdo->lastInsertID();


    foreach ($_SESSION['CARRITO'] as $indice => $productos) {
        //echo '<br><br>';
        //echo json_encode($productos);
        $id_producto = $productos['id_cursos'];
        $total = $productos['precio'];
        $sqlinsert_detalle = $pdo->prepare("INSERT INTO ventas_detalle (id_venta,id_producto,precio_unitario,cantidad) VALUES ($id_venta,$id_producto,$total,1) ");
        $sqlinsert_detalle->execute();
    }
}
?>

<script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
<script>
    paypal.Buttons().render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
</script>
<br>

<div class="m0 row justify-content-center">
    <div class="col-auto bg-success p-5 text-center">
        <h1>Studify</h1><span><?php
                                        $fechaActual = date('d/m/y h:i:s');
                                        echo $fechaActual;
                                        ?></span>
        <h5>Gracias por confiar en nosotros</h5>
        <p>Si has tenido algún problema con el pago escribenos a<br>studify.supp@gmail.com</p>
        <h1></h1>
        <hr>
        <table>

            <thead>
                <th>
                    Id del curso:
                </th>
                <th>Id del producto</th>

                <th>Precio</th>
                <th>Cantidad</th>
            </thead>
            <tbody>
                <?php
                foreach ($_SESSION['CARRITO'] as $carrito) {
                    $idcurso = $carrito['id_cursos'];
                    echo '<tr><td>' . $idcurso . '</td>';
                    $curso = $carrito['curso'];
                    echo '<td>' . $curso . '</td>';
                    $precio = number_format($carrito['precio'], 2);
                    echo '<td>' . $precio . '</td>';
                    $cant = $carrito['cantidad'];
                    echo '<td>' . $cant . '</td></tr>';
                }
                ?>
            </tbody>
            <tfoot>
                <th>
                    Id del curso:
                </th>
                <th>Id del producto</th>

                <th>Precio</th>
                <th>Cantidad</th>
            </tfoot>
        </table>
        
        <p>IVA (<span><?php echo IVA ?> </span>) ya includo en los precios</p> 
        <p class="lead">
            Estás a punto de pagar con PayPal la cantidad de:
        <h4><?= number_format($totalpagar, 2) ?></h4>

    </div>
    <div class="jumbotron text-center">
        <h1 class="display-4">¡Paso final! Developer PayPal</h1>
        <hr />

        <div id="paypal-button-container"></div>

        </p>


    </div>

</div>



<!-- https://developer.paypal.com/docs/archive/checkout/how-to/customize-flow/?mark=interactive%20code%20demo#interactive-code-demo -->

<!-- 
Crear cuemta sandbox
https://www.sandbox.paypal.com/us/home


-->

<script>
    paypal.Buttons.render({
        env: 'sandbox', //sandbox or production
        style: {
            label: 'checkout', // checkout o credit o pay o Buynow
            size: 'responsive', //small medium large o responsive
            shape: 'pill', //pill o rect
            color: 'gold' //gold, blue, silver,black
        },
        //PAypal clientid y create de la app Tienda
        //Datos del registro como cuenta personal o de negocio
        client: {
            sandbox: 'AZDXDFGTREGY', //Token sandbox(nos lo da en el registro)
            production: 'insert client id de paypal'
        },
        //codigo cuando el usuario pulse el botón click
        payment: function(data, actions) {
            console.log(data);
            window.alert("hola");
            return actions.paymenyt.create({
                payment: {
                    transactions: [{
                            amount: {
                                total: '<?= number_format($totalpagar, 2) ?>',
                                currency: 'EUR'
                            },
                            description: "Compra de productos a Grouplance : <?= number_format($totalpagar, 2) ?>",
                            custom: "<?= $Sid ?>#<?php echo openssl_decrypt($id_venta, COD, KEY) ?>"
                        }

                        //window.location = "verificadorpago.php?paymentToken=" + data.paymentToken;
                    ]
                }

            })
        },
        //Esperar que el pago de paypal sea autorizado
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                window.alert('PAGO COMPLETADO');
                console.log(data);
                window.location = "verificadorpago.php?paymentToken=" + data.paymentToken + data.paymentID;
            });
        }

    }, '#paypal-button-container');
</script>