<?php
class conexion {
    private $servidor;
    private $user;
    private $pass;
    private $base_datos;
    private $conexion;
    private $resultado;

    function __construct() {
        $this->servidor = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->base_datos = "tfg";
    }
    function conectar(){
        $this->conexion = new mysqli($this->servidor, $this->user, $this->pass, $this->base_datos);
        $this->conexion->set_charset("utf8");
    }
    function cerrar(){
        $this->conexion->close();
    }
    function consulta($consulta){
        $this->resultado = mysqli_query($this->conexion, $consulta);
    }
    function extraer_registro(){
        if ($fila =  mysqli_fetch_array($this->resultado, MYSQLI_ASSOC)) {
            return $fila;
        } else {
            return false;
        }
    }
    function encrypt_decrypt( $action, $string ) {
        /*
        * ENCRYPTION: encrypt_decrypt( 'encrypt', $string );
        * DECRYPTION: encrypt_decrypt( 'decrypt', $string ) ;
        */
        $output = false;
        //seteamos el método
        $encrypt_method = 'AES-256-CBC';
        //seteamos la key
        $secret_key = 'WS-SERVICE-KEY';
        $secret_iv = 'WS-SERVICE-VALUE';
        // hash
        $key = hash( 'sha256', $secret_key );
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        if ( $action == 'encrypt' ) {
            //encriptamos con ssl y retornamos la respuesta
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        } else {
            if ( $action == 'decrypt' ) {
                //desencriptamos con ssl y retornamos la respuesta
                $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
            }
        }
        //sino retorna false
        return $output;
    }

}
