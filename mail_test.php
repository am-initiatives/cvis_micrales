<?php
include 'php/config.php';
include 'php/PHPMailer/PHPMailerAutoload.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
 
if(!isset($_GET['recipient'])) exit('no recipient specified');

try
{
	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->From = $smtp_login;
	$mail->FromName = "micrales";
	$mail->AddAddress($_GET['recipient'], '');
	$mail->IsHTML(false);
	$mail->Subject = 'Email de test';
	$mail->Body = 'Ceci est un email de test envoyé par mail_test.php';
	$mail->IsSMTP();
	$mail->SMTPDebug = 2;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = $smtp_login;
	$mail->Password = $smtp_pass;
	$mail->Host = $smtp_host;
	$mail->Port = 465;
	$mail->Send();
	echo 'ok';
}
catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}