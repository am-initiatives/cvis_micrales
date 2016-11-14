<?php
require 'config.php';
if(!isset($_GET['id']) || !isset($_POST['request_id']) || !isset($_POST['signed']) || !isset($_POST['transaction_identifier']) || !isset($_POST['sig'])) exit;
$id_commande = intval($_GET['id']);
$cmd_stmt = $db->prepare('SELECT id, payee, date_enregistrement, date_paiement, bucque, matricule, nom, prenom, telephone, email, civilite, ref_equerre, gravure, ref_chaine, livraison_nom, livraison_adresse1, livraison_adresse2, livraison_cp, livraison_ville, livraison_lieu, prix_eqr, prix_chn, prix_livr, frais_dossier, prix_total, commentaires
                          FROM commandes
                          WHERE id = ?');
$cmd_stmt->bind_param('d', $id_commande);
$cmd_stmt->execute();
$cmd_stmt->bind_result($GLOBALS['id'], $GLOBALS['payee'], $GLOBALS['date_enregistrement'], $GLOBALS['date_paiement'], $GLOBALS['info_bucque'], $GLOBALS['info_matricule'], $GLOBALS['info_nom'], $GLOBALS['info_prenom'], $GLOBALS['info_telephone'], $GLOBALS['info_mail'], $GLOBALS['pg'], $GLOBALS['eqr_ref'], $GLOBALS['gravure'], $GLOBALS['chn_ref'], $GLOBALS['livr_nom'], $GLOBALS['livr_add1'], $GLOBALS['livr_add2'], $GLOBALS['livr_cp'], $GLOBALS['livr_ville'], $GLOBALS['livr_lieu'], $GLOBALS['eqr_prix'], $GLOBALS['chn_prix'], $GLOBALS['livr_prix'], $GLOBALS['frais_dossier'], $GLOBALS['prix_total'], $GLOBALS['commentaires']);
if(!$cmd_stmt->fetch())
	exit;
$cmd_stmt->close();
if($GLOBALS['payee'])
	exit;

/* calcul de la signature attendue */

$param = array(
	'currency' => 'EUR',
	'request_id' => $_POST['request_id'],
	'amount' => number_format(round($GLOBALS['prix_total'], 2), 2, '.', ''),
	'signed' => $_POST['signed'],
	'transaction_identifier' => $_POST['transaction_identifier'],
	'vendor_token' => $lydia_public_token
);

ksort($param);

$sig = array();

foreach ($param as $key => $val) {
    $sig[] .= $key.'='.$val;
}

$callSig = md5(implode("&", $sig)."&".$lydia_private_token);

/* vérification avec la signature envoyée par Lydia */
if($callSig != $_POST['sig'])
	exit('Paiement non authentifié');

/* mise à jour de la commande */
$cmd_stmt = $db->prepare('UPDATE commandes SET payee = TRUE, date_paiement = NOW(), lydia_transaction_id = ? WHERE id = ?');
$cmd_stmt->bind_param('sd', $_POST['transaction_identifier'], $id_commande);
$cmd_stmt->execute();
$cmd_stmt->close();

/* on génère le fichier pdf */
$GLOBALS['id'] = $id_commande;
include 'pdf_eqr.php';

/* on envoie les 2 mails */
include 'PHPMailer/PHPMailerAutoload.php';
try
{
	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->From = $smtp_login;
	$mail->FromName = "micrales";
	$mail->AddAddress($cvis_email, '');
	$mail->IsHTML(false);
	$mail->Subject = '[' . $lydia_env . '] Commande n°' . str_pad($id_commande, 6, '0', STR_PAD_LEFT);
	$mail->Body = 'Commande payée le ' . date('c') . ', montant reçu ' . number_format($GLOBALS['prix_total'],2, ',', ' ') . " €\r\nIP du retour Lydia : " . $_SERVER['REMOTE_ADDR'] . "\r\nBon de commande en PJ\r\n\r\n";
	$mail->AddAttachment($bon_de_commande, $bon_de_commande_fichier);
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = $smtp_login;
	$mail->Password = $smtp_pass;
	$mail->Host = $smtp_host;
	$mail->Port = 465;
	$mail->Send();
	
	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->From = $smtp_login;
	$mail->FromName = "micrales";
	$mail->AddAddress($GLOBALS['info_mail'], '');
	$mail->IsHTML(false);
	$mail->Subject = 'Confirmation de commande n°' . str_pad($id_commande, 6, '0', STR_PAD_LEFT);
	$mail->Body = "Sal's,\r\nTa commande a bien été confirmée et transmise au C-vis UE.\r\nCi-joint un exemplaire de ton bon de commande.\r\nEn cas d'erreur sur celui-ci, contacte le C-vis ue au plus vite.\r\n";
	$mail->AddAttachment($bon_de_commande, $bon_de_commande_fichier);
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
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