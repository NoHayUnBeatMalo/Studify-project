<?php

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
$desencriptar = encrypt_decrypt('decrypt', 'aGVXWUZkOXBiQTBnK3E0dW5kQkpHQT09');
echo $desencriptar;


?>