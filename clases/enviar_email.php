<?php 
use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'edwardalejozuluaga669@gmail.com';                     //SMTP username
    $mail->Password   = 'oveymar123456';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('edwardalejozuluaga669@gmail.com', 'Tienda cat-city');
    $mail->addAddress('edwardalejozuluaga669@gmail.com', 'Joe User');     //Add a recipient              //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Detalle de su compra';

    $cuerpo = '<h4> Gracias por su compra</h4>';
    $cuerpo .= '<p> El id de su compra es <b>'.$id_transaccion .'</b></p>' ;

    $mail->Body    = $cuerpo;
    $mail->AltBody = 'Le enviamos los detalles de su compra.';

    $mail->setLanguage('es', '../phpmailer/languaje/phpmailer.lang-es.php');

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo electronica de la compra: {$mail->ErrorInfo}";
}

?>