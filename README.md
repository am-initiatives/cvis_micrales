# cvis_micrales

L'install de ce petit programme nécessite au minimum PHP5.4 et une base de données MySQL.
Micral_G utilise les librairies suivantes :
 * gd
 * fpdf
 * phpMailer

Etapes :
I. VERIFICATIONS

1) Copier tous les fichiers du répertoire micral_G sur un dossier http (ex /var/www)
2) Accéder à ./phpinfo.php pour les vérifications pré-install
3) Vérifier la version de PHP, qu'elle soit bien supérieure à 5.4.0
4) Rechercher "gd" sur la page phpinfo, et vérifier que la section "gd" est bien présente et que "GD Support" est à "Enabled"
5) Rechercher "mysqli" sur la page phpinfo, vérifier que la section "mysqli" est bien présente

II. INSTALLATION
1) Donner les droits en écriture au dossier "./php/gen_pdf" (chmod 777
1) Créer une base de données MySQL (via phpmyadmin ou autre)
2) Configurer le fichier ./php/config.php : 
	$db_host : serveur de la base MySQL
	$db_user : nom d'utilisateur de la base MySQL
	$db_pass : mot de passe de la base MySQL
	$db_name : nom de la base MySQL
	$base_folder : nom du dossier de base. Par exemple si on accède au site depuis http://micrales.ueensam.org/micrales, alors le dossier de base sera "/mirales"
	$cvis_email : adresse email du cvis où les bons de commandes sont envoyés
	$smtp_host : serveur SMTP (nécessaire pour l'envoi des bons de commande)
	$smtp_login : login du serveur SMTP (nécessaire pour l'envoi des bons de commande)
	$smtp_pass : mot de passe du serveur SMTP (nécessaire pour l'envoi des bons de commande)
3) Importer, via phpmyadmin ou directement en ligne de commande, le fichier micrales.sql
4) Tout tester





