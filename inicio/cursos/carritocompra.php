
    <?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $secret_iv = 'Studify';
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    //echo 'dentro de carritocompra';
$numcursos = 0;
$mensaje = '';
if(isset($_POST["btnAccion"])) {
        //echo 'Btn active';
    switch($_POST["btnAccion"]) {
            case 'Agregar':
                //echo '<br>Agregar';
            if(is_numeric(openssl_decrypt($_POST['id_curso'],'AES-256-CBC', 'Studify', 0, $iv))) {
                    //echo $_POST['id_curso'];
                $idcurso = openssl_decrypt($_POST['id_curso'],'AES-256-CBC', 'Studify', 0, $iv);
                //$mensaje .= 'Ok ID curso correcto->'.$idcurso;
                } else {
                    $mensaje .= 'No se ha podido introducir el idcurso';
                    break;
                    }
            if(is_string(openssl_decrypt($_POST['curso'],'AES-256-CBC', 'Studify', 0, $iv))) {
                    //echo $_POST['curso'];
                $nombrecurso =   openssl_decrypt($_POST['curso'],'AES-256-CBC', 'Studify', 0, $iv);
                //$mensaje .= '<br />Ok Nombre curso correcto->'.$nombrecurso;
                } else {
                    $mensaje .= '<br />No se ha podido introducir el nombre del curso';
                    break;
                    }
             if(is_numeric(openssl_decrypt($_POST['precio'],'AES-256-CBC', 'Studify', 0, $iv))) {
                    //echo $_POST['precio'];
                $precio1 =   openssl_decrypt($_POST['precio'],'AES-256-CBC', 'Studify', 0, $iv);
                //$mensaje .= '<br />Ok Precio curso correcto->'.$precio1;
                } else {
                    $mensaje .= '<br />No se ha podido introducir el Precio';
                    break;
                    }
             if(is_numeric(openssl_decrypt($_POST['cantidad'],'AES-256-CBC', 'Studify', 0, $iv))) {
                    //echo $_POST['cantidad'];
                $cantidad1 =   openssl_decrypt($_POST['cantidad'],'AES-256-CBC', 'Studify', 0, $iv);
                //$mensaje .= '<br />Ok cantidadd correcto->'.$cantidad1;
                } else {
                    $mensaje .= '<br />No se ha podido introducir la cantidad';
                    break;
                    }
            if(!isset($_SESSION['CARRITO'])) {

                 $cursos = array(
                     'id_cursos'=>$idcurso,
                     'curso'=>$nombrecurso,
                     'precio'=>$precio1,
                     'cantidad'=>$cantidad1
                    );
                 $_SESSION['CARRITO'][]=$cursos;
                 $mensaje .= 'Nuevo curso agregado<br>';
             } else {
                 $numcursos = count($_SESSION['CARRITO']);
                 $cursos = array(
                     'id_cursos'=>$idcurso,
                     'curso'=>$nombrecurso,
                     'precio'=>$precio1,
                     'cantidad'=>$cantidad1
                    );
                 $val = array_push($_SESSION['CARRITO'], $cursos);
                 
                //echo json_encode($val);
             }
                //echo json_encode($_SESSION['CARRITO']);
            //$mensaje2 = print_r($_SESSION['CARRITO'], TRUE);
            echo $mensaje;
             break;
            
            //CÓDIGO PARA ELIMINAR
        case 'Eliminar':
            if(is_numeric(openssl_decrypt($_POST['id_cursos'],'AES-256-CBC', 'Studify', 0, $iv))) {
                $idcurso =   openssl_decrypt($_POST['id_cursos'],'AES-256-CBC', 'Studify', 0, $iv);
                    //echo json_encode($_SESSION['CARRITO']);
                foreach($_SESSION['CARRITO'] as $indice=>$cursos) {
                    
                    if($cursos['id_cursos'] == $idcurso) {
                        //echo "<script>alert('Elemento a borrar: ".$_SESSION['CARRITO'][$indice]['id_cursos']."')</script>";
                        unset($_SESSION['CARRITO'][$indice]);
                        //echo "<script>alert('curso borrado correctamente');</script>";
                        array_filter($_SESSION['CARRITO']);
                        sort($_SESSION['CARRITO']);

                    }
                }
                } 
             break;
        //CÓDIGO PARA PAGAR
        case 'Pagar':
         default :
             $mensaje = 'Noooooo';
            }
    } 

?>