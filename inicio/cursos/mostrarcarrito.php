<?php 
include_once __DIR__.'/../../conexion.php';
include_once __DIR__.'/../../configuracion.php';
include_once __DIR__.'/carritocompra.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(isset($_SESSION['CARRITO'])){
    //echo json_encode($_SESSION['CARRITO']);
}
$idusuario = $_GET['idu'];
//echo 'ID usu: '.$idusuario;
$modo = isset($_GET["modo"])? $_GET["modo"]: '';
    if($modo=='vaciar') {
        session_destroy();
        header('Location: cursos.php');
    }

    $secret_iv = 'Studify';
    $iv = substr(hash('sha256', $secret_iv), 0, 16);


    $sql = "SELECT rol_id FROM usuarios WHERE idusuario = $idusuario";
    $consultarol = $pdo->prepare($sql);
    $consultarol->execute();
    $rol = $consultarol->fetch(PDO::FETCH_ASSOC);
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
    <link href="../css/styles.css" rel="stylesheet" />
</head>

    <header style="background-color: rgb(106, 199, 70);" class="relative-top">
    <nav class="navbar navbar-expand-lg navbar-light  py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php?username=<?php echo $idusuario ?>">Studify</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item active"><a class="nav-link" href="mostrarCarrito.php?idu=<?php echo $idusuario; ?>">Carrito(<?php if (empty($_SESSION['CARRITO'])) {echo 0; } else { echo count($_SESSION['CARRITO']); }; ?>)</a></li>
            
                    <li class="nav-item"><a class="nav-link" href="../taskApp/index.php?idu=<?php echo $idusuario; ?>">Lista de tareas</a></li>
                    <li class="nav-item"><a class="nav-item"><a class="nav-link" href="cursos.php?idu=<?php echo $idusuario; ?>">Nuestros cursos</a></a></li>
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
<h3>Lista del Carrito</h3>

<?php if(!empty($_SESSION['CARRITO'])) { ?>

<table class=" w-100 table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center"></th>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Curso</th>
            <th scope="col" class="text-center">Precio</th>
            <th scope="col" class="text-center">Cantidad</th>
            <th scope="col" class="text-center">Precio base</th>
            <th scope="col" class="text-center">IVA</th>
            <th scope="col" class="text-center">Total</th>
            <th scope="col" class="text-center">--</th>
        </tr>
    </thead>
    <?php 
    $total = 0; 
    $total_iva = 0;
    $total_total = 0;
    $contador = 0;

    ?>    
    <?php foreach($_SESSION['CARRITO'] as $indice=>$cursos) { ?>
        <tr>
            <td scope="row" class="text-center"><?php echo ++$contador;?></td>
            <td class="text-center"><?php echo $cursos['id_cursos']?></td>
            <td class="text-center"><?php echo $cursos['curso']?></td>
            <td class="text-center"><?php echo $cursos['precio'];?></td>
            <td class="text-center"><?php echo $cursos['cantidad']?></td>
            <td class="text-center"><?php echo $cursos['precio']*$cursos['cantidad']?></td>
            <td class="text-center"><?php echo $cursos['precio']*$cursos['cantidad']*0.04?></td>
            <td class="text-center" id="totalapagar"><?php echo $cursos['precio']*$cursos['cantidad']*IVA?></td>
            <td class="text-center">
                <form action="" method="post">
                    <input type="hidden" name="id_cursos" id="id_cursos" value="<?php echo openssl_encrypt($cursos['id_cursos'],'AES-256-CBC','Studify', 0, $iv); ?>" />
                    <button class="btn btn-danger" name="btnAccion" value="Eliminar" type="submit">Eliminar</button>
                   
                </form>
                </td>
        </tr>
    <?php 
    $total = $total+($cursos['precio']*$cursos['cantidad']);
    $total_iva = $total_iva+($cursos['precio']*$cursos['cantidad']*0.04);
    $total_total = $total_total+($cursos['precio']*$cursos['cantidad']*IVA);
    ?>
    <?php } ?> 
        <tr>
            <td colspan="5" align="right"><h3>TOTAL</h3></td>
            <td align="right"><h3><?php echo number_format($total,2,',','.');?></h3></td>
            <td align="right"><h3><?php echo number_format($total_iva,2,',','.');?></h3></td>
            <td align="right"><h3><?php echo number_format($total_total,2,',','.');?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="8">
                <form action="pagar.php?idu=<?php echo $idusuario; ?>" method="post" >
                    <div class="alert alert-success">
                    <div class="totalapagar" hidden><?php echo number_format($total_total,2,',','.');?></div>
                <div class="form-group">
                    <label for="mail">Correo de contacto</label>
                    <input id="mail" name="mail" type="email" class="form-control" placeholder="Introduce tu mail" required />
                    <small id="emailhelp" class="form-text" text-muted >Los cursos se enviarán a este correo</small>
                </div>
                <button class="btn btn-success btn-lg btn-block" name="btnAccion" value="pagar" type="submit">Proceder a pagar</button>
                        </div>
                </form>
            </td>
        </tr>
    </tbody>
    
</table>

<?php } else { ?>
<div class="alert alert-danger">No hay cursos en el carrito</div>
<?php } ?>
