<?php
require 'config.php';
session_start();
if(!isset($_GET['id'])) exit;

$cmd_req = $db->prepare("SELECT date_paiement, prix_total FROM commandes WHERE payee AND id = ? AND ip_enregistrement = ?");
$cmd_req->bind_param('ds', $_GET['id'], $_SERVER['REMOTE_ADDR']);
$cmd_req->execute();
$cmd_req->bind_result($date_paiement, $prix_total);

if($cmd_req->fetch())
{
    $ret = array('ok' => 1, 'date' => $date_paiement, 'prix_total' => $prix_total);
    session_destroy();
}
else
    $ret = array('ok' => 0);

echo json_encode($ret);
$cmd_req->close();

