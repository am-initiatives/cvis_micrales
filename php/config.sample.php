<?php
$db_host = '127.0.0.1';
$db_port = 3306
$db_user = 'root';
$db_pass = '*****';
$db_name = 'micrales';
$base_folder = '/micrales';
$cvis_email = 'cvis.ue@gadz.org';
$smtp_host = 'smtp.gmail.com';
$smtp_login = 'info.ch@gadz.org';
$smtp_pass = '*****';
$lydia_private_token = '*****';

$db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
