<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//echo readfile("newfile.txt");

$myfile = fopen("testfile.txt", "w");

//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//$txt = "This is line 1\n";
//fwrite($myfile, $txt);





$myfile = fopen("newfile.txt", "a");
$txt = substr($_SERVER['REQUEST_URI']." Visited at ".date('m/d/Y H:i:s',time()),9)."\n";
fwrite($myfile, $txt);

//echo readfile("newfile.txt");


//$fn = fopen("newfile.txt","r");
//$result = fgets($fn,5);
//echo $result;


$fn = fopen("newfile.txt","r");

while(! feof($fn))  {
    $result = fgets($fn);
    echo $result;
}
fclose($fn);

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '1c6350d1743565';                     //SMTP username
    $mail->Password   = '087c341d97d5e1';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('newfile.txt');         //Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the Textfile <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}