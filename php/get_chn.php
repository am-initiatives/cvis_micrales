<?php
require 'config.php';

$result = $db->query('SELECT id, longueur, metal, type, masse_or, prix, ref, commentaire, image FROM chaines') or exit;

$chaines = array();

while($r = $result->fetch_array())
{
    $chaines[] = $r;
}

echo json_encode($chaines);