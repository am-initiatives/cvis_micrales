<?php
session_start();

require 'config.php';
require_once 'functions.php';

$insert_stmt = $db->prepare('INSERT INTO commandes (payee, date_enregistrement, date_paiement, ip_enregistrement, bucque, nums, tbk, proms, nom, prenom, telephone, email, sexe, ref_equerre, gravure, ref_chaine, livraison_nom, livraison_prenom, livraison_adresse1, livraison_adresse2, livraison_cp, livraison_ville, livraison_lieu)
                             VALUES                (FALSE, NOW(),               NULL,          ?,                 ?,      ?,    ?,   ?,     ?,   ?,      ?,         ?,     ?,    ?,           ?,       ?,          ?,             ?,                ?,                  ?,                  ?,            ?,               ?)
                            ');
