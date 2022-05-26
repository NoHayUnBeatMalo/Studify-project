<?php 
 class Modelo_Usuario{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $con = $this->conexion->conectar();
    }
    function verificarUsuario($usuario, $contra){
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$usuario'";
        $arreglo = array();
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            while($consulta_VU = $this->conexion->extraer_registro()){
                if($this->conexion->encrypt_decrypt('decrypt', $consulta_VU['contrasena']) == $contra){
                    $arreglo[]=$consulta_VU;
                }
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    public function listarUsuario(){
        $con = mysqli_connect('localhost', 'root', '', 'tfg');
        $sql = "SELECT usuarios.idusuario, usuarios.nombre_usuario, usuarios.nombre, usuarios.apellidos, usuarios.fecha_nacimiento, usuarios.correo, usuarios.estado, rol.rol_nombre FROM usuarios INNER JOIN rol ON usuarios.rol_id = rol.rol_id";
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
    }
    
    function listarRol(){
        $sql = "CALL ST_LISTAR_ROL();";
        $arreglo = array();
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
    }

    function registrarUsuario($usuario, $nombre, $apellidos, $fnac, $contra, $email, $rol, $sexo){
        $contrasena = $this->conexion->encrypt_decrypt('encrypt', $contra);
        
        $sql = "INSERT INTO usuarios(nombre_usuario, nombre, apellidos, fecha_nacimiento, contrasena, correo, estado, rol_id, sexo)
        VALUES ('$usuario', '$nombre', '$apellidos', '$fnac', '$contrasena', '$email', 'ACTIVO', '$rol', '$sexo');";
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            echo 1;
        }else{
            echo 2;
        }
        
    }
    function modificarEstatusUsuario($idusuario, $estatus){
        $sql = "UPDATE usuarios SET estado='$estatus' WHERE idusuario='$idusuario'";
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            return 1;
        }else{
            return 0;
        }
    }

    function modificarDatosUsuario($usu, $nombre, $apellidos, $fnac, $email,  $rol, $sexo){
        $sql = "UPDATE usuarios SET 
        nombre = '$nombre', apellidos = '$apellidos', fecha_nacimiento = '$fnac', correo = '$email', rol_id = '$rol', sexo= '$sexo'
        WHERE nombre_usuario='$usu'";
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            return 1;
        }else{
            return 0;
        }
    }
    
    function traerDatosUsuario($usuario){
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$usuario'";
        $arreglo = array();
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            while($consulta_TDU = $this->conexion->extraer_registro()){
                $arreglo[] = $consulta_TDU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function modificarContrasena($idusuario, $contrabd, $contraActual, $contraNueva){
        $contradecrypt = $this->conexion->encrypt_decrypt('decrypt', $contrabd);
        if($contradecrypt == $contraActual){
            $contraNuevaEncrypt = $this->conexion->encrypt_decrypt('encrypt', $contraNueva);
            $sql = "UPDATE usuarios SET contrasena = '$contraNuevaEncrypt' WHERE idusuario = '$idusuario'";
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
}
