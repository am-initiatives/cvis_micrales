<?php
require 'config.php';

$result = $db->query('SELECT id, ref, prix, metal, epaisseur, gravure, encoche, commentaire FROM equerres');

$equerres = array();

while($r = $result->fetch_array())
{
    $equerres[] = $r;
}

echo json_encode($equerres);
