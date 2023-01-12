<?php
// "Curl" le dan contenido a la URL
include '../../configuracion.php';
print_r($_GET);
$clientId = "AZlbKxOuQiM-xxBpij70sOrS_hVJVnwXas6ViRYOjwSdRBJHAlS3ypH_eN4cAlvNNjXuZHFOavvP4gtx";
$secretId = "ENd6sn5rWjwqNZG82dVUBFiyFsaUcbLU5OWwuLmJVL-tWQfVc2uofesMGxw1U5nxQNg30NES9RfqpgSC";

$login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($login,CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($login,CURLOPT_USERPWD,$clientId . ":" . $secretId);
curl_setopt($login,CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$respuesta = curl_exec($login);

$objRespuesta = json_decode($respuesta);

$accessToken = $objRespuesta->access_token;
print_r($accessToken);

$venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/" . $_GET["paymentID"]);

curl_setopt($venta,CURLOPT_HTTPHEADER, array("Content-Type:Application/json","Authorization: Bearer ".$accessToken));

$respuestaVenta = curl_exec($venta);
print_r($respuestaVenta);    

$objDatosTransaccion = json_decode($respuestaVenta);
$estado = $objDatosTransaccion->state;
$mail = $objDatosTransaccion->payer->payer_info->email;
$total = $objDatosTransaccion->transactions[0]->amount->total;
$currency = $objDatosTransaccion->transactions[0]->amount->currency;
$custom = $objDatosTransaccion->transactions[0]->amount->custom;

//Si el pago es aprobado, finalizamos la compra

//Cierro primer curl deacceso a tienda


$SIDpagoventa = $clave[0];
$claveventa = openssl_decrypt($clave[1], 'AES-256-CBC','Studify');
print_r($claveventa);

curl_close($venta);
curl_close($login);
echo $state;
if($state=='approved') {
    $mensajePayPal = "<h3>Pago aprobado. Proceso terminado</h3>";
} else{
    $mensajePayPal = "<h3>Pago rechazado por PayPal</h3>";
}
echo $mensajePayPal;
?>