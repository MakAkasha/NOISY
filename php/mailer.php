<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require './mailer/src/Exception.php';
require './mailer/src/PHPMailer.php';
require './mailer/src/SMTP.php';

$mail = new PHPMailer;

$name = $_POST['firstname']?:'';
$email = $_POST['email']?:'';
$lastname = $_POST['lastname']?:'';
$job = $_POST['job']?:'';
$country = $_POST['country']?:'';
$city = $_POST['city']?:'';
$streetnumber = $_POST['streetnumber']?:'';
$streetname = $_POST['streetname']?:'';
// $json = file_get_contents('php://input');
$jsonDecode = json_encode($_POST);

// Converts it into a PHP object foreach ($_POST as $id=>$value)
// $data = json_decode($json);
// echo $jsonDecode;
// //$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'ssl://noisy.sd';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;    
// $mail->SMTPDebug = 2;                           // Enable SMTP authentication
$mail->Username = 'contact@noisy.sd';                 // SMTP username
$mail->Password = 'contact123456';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'contact@noisy.sd';
$mail->FromName = 'Noisy Contact Sender';
$mail->addAddress('mobark.k9@gmail.com', 'Mobark');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addCC('')
// $mail->addBCC('bcc@example.com');

// $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'New Contact from '.$name;
$mail->Body    = 'new Contact <b>'.$jsonDecode.'</b>';
$mail->AltBody = $jsonDecode;

if(!$mail->send()) {
    echo 'sorry try one more time';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Thanks '.$lastname.' we gonna contact you soon';
}
?>