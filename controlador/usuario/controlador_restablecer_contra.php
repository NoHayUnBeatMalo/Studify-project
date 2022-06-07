
<?php
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$contra = htmlspecialchars($_POST['contrasena'], ENT_QUOTES, 'UTF-8');

$consulta = $MU->restablecerContrasena($email, $contra);
if(!$consulta){
    if ($consulta == 1) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
    
        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'studify.supp@gmail.com';                     //SMTP username
            $mail->Password   = 'zTFD*X@k5*GM';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $mail->setFrom('studify.supp@gmail.com', 'Studify');
            $mail->addAddress($email);     //Add a recipient
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Restablecer contrase&ntilde;a';
            $mail->Body    = 'Su contraseña ha sido restablecida.<br>La nueva contrase&ntilde;a es: <b>'.$contra.'</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
            $mail->send();
            echo 'Enviado';
        } catch (Exception $e) {
            echo 'Exception';
        }
    } else {
        echo 'Consulta diferente de 1';
    }
}



?>
