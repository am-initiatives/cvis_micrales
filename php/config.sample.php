<?php
$actif = false; // changer à true pour rendre le site actif en période de vente de micrales
$db_host = '127.0.0.1';
$db_port = 3306;
$db_user = 'root';
$db_pass = '';
$db_name = 'micrales';
$base_folder = '/';
$cvis_email = 'sacha.viscaino@gadz.org';
$smtp_host = 'smtp.gmail.com';
$smtp_login = 'info.ch@gadz.org';
$smtp_pass = '';
$lydia_public_token = '';
$lydia_private_token = '';
$lydia_env = 'test';

$db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
if(!$actif) exit("Les commandes de micrales sont zoquées. A l'année prochaine !");
