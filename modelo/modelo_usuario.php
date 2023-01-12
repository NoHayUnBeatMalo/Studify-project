<?php

include_once __DIR__.'/../conexion.php';
function encrypt_decrypt($action, $string)
{
    /*
        * encriptar: encrypt_decrypt( 'encrypt', $string );
        * desencriptar: encrypt_decrypt( 'decrypt', $string ) ;
        */
    $output = false;
    //seteamos el método
    //seteamos la key
    // hash
    $key = hash('sha256', 'WS-SERVICE-KEY');
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', 'WS-SERVICE-VALUE'), 0, 16);
    if ($action == 'encrypt') {
        //encriptamos con ssl y retornamos la respuesta
        $output = base64_encode(openssl_encrypt($string, 'AES-256-CBC', $key, 0, $iv));
    } else if ($action == 'decrypt') {
        //desencriptamos con ssl y retornamos la respuesta
        $output = openssl_decrypt(base64_decode($string), 'AES-256-CBC', $key, 0, $iv);
    }
    //sino retorna false
    return $output;
}


class Modelo_Usuario
{


    //private $conexion;
    function __construct()
    {
        include_once __DIR__.'/../conexion.php';
    }
    function verificarUsuario($user, $contra)
    {

        
        include __DIR__.'/../conexion.php';
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$user'";

        $getData = $pdo->prepare($sql);
        $getData->execute();
        $resultado = $getData->fetch(PDO::FETCH_ASSOC);
        
            $contraDB = $resultado['contrasena'];
        
        $desencriptada = encrypt_decrypt('decrypt', $contraDB);
        if ($desencriptada == $contra) {
            return json_encode($resultado);
        }
    }
    function usuarioLibre($usuario){
        include __DIR__.'/../conexion.php';
        $sql = "SELECT idusuario FROM usuarios WHERE nombre_usuario = :usuario";
        $selectUsu = $pdo->prepare($sql);
        $selectUsu->bindParam(':usuario', $usuario);
        $res = $selectUsu->execute();
        return $res;
    }
    function cambiarTipoId($idusuario, $tipo)
    {
        
        
        include __DIR__.'/../conexion.php';
        $sql = "UPDATE usuarios SET tipo_id=:tipoid WHERE idusuario=:idusu;";
        $selectipo = $pdo->prepare($sql);
        $selectipo->bindParam(":tipoid", $tipo);
        $selectipo->bindParam(":idusu", $idusuario);
        $selectipo->execute();


        /*
        $consulta = $this->conexion->consulta("UPDATE usuarios SET tipo_id=".$tipo." WHERE idusuario=".$idusuario.";");
        if(!$consulta){
            echo 1;
        }else{
            echo 0;
        }
        */
    }

    function listarUsuario()
    {
        
        include __DIR__.'/../conexion.php';
        $sql = "SELECT usuarios.idusuario, usuarios.nombre_usuario, usuarios.nombre, usuarios.apellidos, usuarios.fecha_nacimiento, usuarios.correo, usuarios.estado, rol.rol_nombre FROM usuarios INNER JOIN rol ON usuarios.rol_id = rol.rol_id";
        $selectusuarios = $pdo->prepare($sql);
        $selectusuarios->execute();

        $listaUsu = $selectusuarios->fetchAll(PDO::FETCH_ASSOC);
        return $listaUsu;
        /*
        while ($row = ) {
            $arreglo["data"][] = $row;
        }
        return $arreglo["data"];
        /*
        $arreglo = array();
        $consulta = mysqli_query($con, $sql);
        if($consulta){
            while($data = mysqli_fetch_assoc($consulta)){
                    //array_map("utf8_encode", $data)
                    $arreglo["data"][]= $data;
            }
            return $arreglo["data"];
        }else{
            die("Error");
        }
        mysqli_free_result($consulta);
        mysqli_close($con);
        */
    }

    function listarRol()
    {
        
        include __DIR__.'/../conexion.php';
        $sql = "CALL ST_LISTAR_ROL();";
        $seleccionlistarrol = $pdo->prepare($sql);
        $seleccionlistarrol->execute();
        $listaRol = $seleccionlistarrol->fetchAll(PDO::FETCH_ASSOC);
        return $listaRol;
        /*
        while ($row = $seleccionlistarrol->fetch()) {
            $arreglo[] = $row;
        }
        return $arreglo;
        /*
        $consulta= $this->conexion->consulta($sql);
        if(!$consulta){
            while($consulta_VU = $this->conexion->extraer_registro()){
                $arreglo[]=$consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }else{
            return 'algo ha ido mal...';
        }
        */
    }
    function listarTipoUsu()
    {
        
        include __DIR__.'/../conexion.php';
        $sql = "CALL ST_LISTAR_TIPO_USU();";
        $selecciontipo = $pdo->prepare($sql);
        $selecciontipo->execute();
        $listaTipo = $selecciontipo->fetchAll(PDO::FETCH_ASSOC);
        return $listaTipo;
        /*
        while($row = $selecciontipo->fetch()){
            $arreglo[] = $row;
        }
        /*
        $consulta= $this->conexion->consulta($sql);
        if(!$consulta){
            while($consulta_VU = $this->conexion->extraer_registro()){
                $arreglo[]=$consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }else{
            return 'algo ha ido mal...';
        }
        */
    }


    function registrarUsuario($user, $nombre, $apellidos, $fnac, $contra, $email, $rol, $sexo, $tipousu)
    {
        
        
        include __DIR__.'/../conexion.php';
        if($rol == 1){
            $tipousu == null;
        }
        $contrasena = encrypt_decrypt('encrypt', $contra);
        //$sql = "INSERT INTO usuarios SET nombre_usuario = :user, nombre = :nombre, apellidos = :apellido, fecha_nacimiento = :fnac, contrasena = :contrasena, correo = :correo, estado = 'ACTIVO', rol_id = :rol, sexo = :sexo, tipo_id = :tipo";
        $sql = "INSERT INTO usuarios (nombre_usuario,nombre,apellidos,fecha_nacimiento, contrasena, correo, estado, rol_id, sexo, tipo_id) VALUES (:user,:nombre,:apellidos, :fnac, :contrasena, :correo, 'ACTIVO',:rol,:sexo, :tipo)";


        $insertUsuario = $pdo->prepare($sql);
        $insertUsuario->bindParam(':user', $user);

        $insertUsuario->bindParam(':nombre', $nombre);

        $insertUsuario->bindParam(':apellidos', $apellidos);

        $insertUsuario->bindParam(':fnac', $fnac);
        $insertUsuario->bindParam(':contrasena', $contrasena);
        $insertUsuario->bindParam(':correo', $email);
        $insertUsuario->bindParam(':rol', $rol);
        $insertUsuario->bindParam(':sexo', $sexo);

        $insertUsuario->bindParam(':tipo', $tipousu);

        $resultado = $insertUsuario->execute();
        
            return $pdo->lastInsertId();
        

        /*
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            echo 1;
        }else{
            echo 2;
        }
        */
    }
    function modificarEstatusUsuario($idusuario, $estatus)
    {
        
        
        include __DIR__.'/../conexion.php';

        if($estatus == 'ACTIVO'){
            $sql = "UPDATE usuarios SET estado='ACTIVO' WHERE idusuario=$idusuario";
        }else if($estatus == 'INACTIVO'){
            $sql = "UPDATE usuarios SET estado='INACTIVO' WHERE idusuario=$idusuario";
        }
        
        $modificarEstatus = $pdo->prepare($sql);
        $modificarEstatus->execute();
        if ($modificarEstatus) {
            return 1;
        } else {
            return 0;
        }
        /*
        $consulta = $this->conexion->consulta($sql);
        if (!$consulta) {
            return 1;
        } else {
            return 0;
        }
        */
    }

    function modificarDatosUsuario($usu, $nombre, $apellidos, $fnac, $email, $sexo)
    {
        
        
        include __DIR__.'/../conexion.php';
        $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', fecha_nacimiento = '$fnac', correo = '$email', sexo= '$sexo' WHERE nombre_usuario='$usu'";
        $modificarUsuario = $pdo->prepare($sql);
        /*
        $modificarUsuario->bindParam(":nombre", $nombre);
        $modificarUsuario->bindParam(":apellidos", $apellidos);
        $modificarUsuario->bindParam(":fnac", $fnac);
        $modificarUsuario->bindParam(":email", $email);
        //$modificarUsuario->bindParam(":rol", $rol);
        $modificarUsuario->bindParam(":sexo", $sexo);
        $modificarUsuario->bindParam(":usuario", $usu);
        //$modificarUsuario->bindParam(":tipousu", $tipousu);
        
        */
        $resultado = $modificarUsuario->execute();
        if($resultado){
            return 1;
        }else{
            return 0;
        }
        /*
        $consulta = $this->conexion->consulta($sql);
        if (!$consulta) {
            return 1;
        } else {
            return 0;
        }
        */
    }

    function traerDatosUsuario($user)
    {
        
        include __DIR__.'/../conexion.php';
        $sql = "SELECT idusuario, nombre, apellidos, fecha_nacimiento, correo, estado, rol_id, sexo, tipo_id FROM usuarios WHERE nombre_usuario='$user'";
        $arreglo = array();
        $selectDatosUsu = $pdo->prepare($sql);
        $selectDatosUsu->execute();
        $resultado = $selectDatosUsu->fetch(PDO::FETCH_ASSOC);
        foreach ($resultado as $result) {
            $arreglo[] = $result;
        }
        return json_encode($arreglo);



        /*
        $consulta = $this->conexion->consulta($sql);
        if (!$consulta) {
            while ($consulta_TDU = $this->conexion->extraer_registro()) {
                $arreglo[] = $consulta_TDU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
        */
    }


    function modificarContrasena($idusuario, $contrabd, $contraActual, $contraNueva)
    {
        
        
        include __DIR__.'/../conexion.php';
        $contradecrypt = encrypt_decrypt('decrypt', $contrabd);
        if ($contradecrypt == $contraActual) {
            $contraNuevaEncrypt = encrypt_decrypt('encrypt', $contraNueva);
            $sql = "UPDATE usuarios SET contrasena = '$contraNuevaEncrypt' WHERE idusuario = '$idusuario'";

            /*
            $consulta = $this->conexion->consulta($sql);
            if (!$consulta) {
                return 1;
            } else {
                return 2;
            }
            */
        } else {
            return 0;
        }
    }
    /*
    function restablecerContrasena($email, $contra){
        $contraencrypt = $this->conexion->encrypt_decrypt('encrypt', $contra);
        $sqlcount = "SELECT COUNT(*) FROM usuarios WHERE correo = '$email'";
        $consultaCount = $this->conexion->consulta($sqlcount);
        if($consultaCount>0){
            $sql = "UPDATE usuarios SET contrasena= '$contraencrypt' WHERE correo='$email'";
            $consulta = $this->conexion->consulta($sql);
            if(!$consulta){
                return 1;
            }else{
                return 2;
            }
        }else{
            return 0;
        }
    }
    */
}
