<?php

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../../vendor/autoload.php';

$curp = $_POST["curp"];
$nombre = ucwords(strtolower($_POST["nombre"]));
$correo = strtolower($_POST["correo"]);
$respAX = [];

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'escom.exdiagnostico@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'ESCOMIPN2021';

//Set who the message is to be sent from
$mail->setFrom('escom.exdiagnostico@gmail.com', 'ESCOM');

//Set an alternative reply-to address
$mail->addReplyTo('escom.exdiagnostico@gmail.com', 'ESCOM');

//Set who the message is to be sent to
$mail->addAddress($correo, $nombre);

//Set the subject line
$mail->Subject = 'Comprobante de grupo';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('<h4 style="text-align: justify;">Hola '.$nombre.', si colocaste mal alguno de tus datos, por favor mandanos un mensaje a esta '.utf8_decode("dirección").' de correo '.utf8_decode("electrónico").' para poder ayudarte a modificarlos.</h4>', __DIR__);

//Replace the plain text body with one created manually
$mail->AltBody = 'Hola '.$nombre.', si colocaste mal alguno de tus datos, por favor mandanos un mensaje a esta '.utf8_decode("dirección").' de correo '.utf8_decode("electrónico").' para poder ayudarte a modificarlos.';

//Attach an image file
$mail->addAttachment("./$curp.pdf");

//send the message, check for errors
if (!$mail->send()) {
    $respAX["cod"] = 0;
    $respAX["msj"] = 'ocurrió un error al enviar el correo. Por favor envianos un mensaje a escom.exdiagnostico@gmail.com para poder enviarte tu comprobante lo antes posible.';
    unlink("./$curp.pdf");
    echo json_encode($respAX);
} else {
    $respAX["cod"] = 1;
    $respAX["msj"] = 'Te hemos enviado tu comprobante a la dirección de correo electrónico que nos proporcionaste, por favor valida que hayas recibido un pdf y que tu curp sea correcto, si hay algún error o no recibiste el correo, comunicate con nosotros a este correo escom.exdiagnostico@gmail.com.';
    unlink("./$curp.pdf");
    echo json_encode($respAX);
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}