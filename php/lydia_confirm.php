<?php
require 'config.php';
if(!isset($_GET['id'])) exit;
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

///////////////
///// TODO //// Verifier le token ICI
///////////////

$cmd_stmt = $db->prepare('UPDATE commandes SET payee = TRUE, date_paiement = NOW() WHERE id = ?');
$cmd_stmt->bind_param('d', $id_commande);
$cmd_stmt->execute();
$cmd_stmt->close();


// Prepare data
$param = array(
    'transaction_identifier' => '123',
    'amount'   => '12'
);

ksort($param); // alphabetical sorting

$sig = array();

foreach ($param as $key => $val) {
    $sig[] .= $key.'='.$val;
}

// Concat the private token (provider one or vendor one) and has the result
$callSig = md5(implode("&", $sig)."&Yi0IPyIDHu");

/* on génère le fichier pdf */
$GLOBALS['id'] = $id_commande;
include 'pdf_eqr.php';

/* on envoie le mail */
include 'PHPMailer/PHPMailerAutoload.php';
try
{
	$mail = new PHPMailer(true);
	$mail->From = $smtp_login;
	$mail->FromName = "micrales";
	$mail->AddAddress($cvis_email, '');
	$mail->IsHTML(false);
	$mail->Subject = utf8_decode('Commande n°' . str_pad($id_commande, 6, '0', STR_PAD_LEFT));
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
	$mail->From = $smtp_login;
	$mail->FromName = "micrales";
	$mail->AddAddress($GLOBALS['info_mail'], '');
	$mail->IsHTML(false);
	$mail->Subject = utf8_decode('Confirmation de commande n°' . str_pad($id_commande, 6, '0', STR_PAD_LEFT));
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