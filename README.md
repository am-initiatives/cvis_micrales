# cvis_micrales

## Présentation
`cvis_micrales` est l'application permettant aux Gadzarts P3 (élèves de dernière année aux Arts et Métiers) de commander leur μEkR (micro-équerre), symbole de leur apartenance à la communauté Arts et Métiers.

Elle a été conçue et est maintenue par des élèves bénévolles. Chacun est libre de contribuer sous la forme d'[issues](https://github.com/am-initiatives/cvis_micrales/issues/new) et de forks/pull-requests.
Les PGs souhaitant contribuer activement au projet peuvent naturellement être ajoutés à la team par leurs anciens de boul's.

## Prérequis
La mise en prod de l'application nécessite au minimum PHP5.4 et une base de données MySQL.

Micral_G utilise les librairies suivantes :
 * gd
 * fpdf
 * phpMailer


## Vérifications

1. Cloner le projet sur le serveur
2. Accéder à ./phpinfo.php pour les vérifications pré-install : 
	- Vérifier la version de PHP, qu'elle soit bien supérieure à 5.4.0
	- Rechercher "gd" sur la page phpinfo, et vérifier que la section "gd" est bien présente et que "GD Support" est à "Enabled"
	- Rechercher "mysqli" sur la page phpinfo, vérifier que la section "mysqli" est bien présente

## Installation
1. Donner les droits en écriture au dossier `./php/gen_pdf`
2. Créer une base de données MySQL
3. Configurer le fichier ./php/config.php :
	- `$db_host` : serveur de la base MySQL
	- `$db_user` : nom d'utilisateur MySQL
	- `$db_pass` : mot de passe MySQL
	- `$db_name` : nom de la base créee
	- `$base_folder` : nom du dossier de base. Par exemple si on accède au site depuis http://example.com/foo, alors le dossier de base sera `/foo`
	- `$cvis_email` : adresse email du cvis où les bons de commandes sont envoyés
	- `$smtp_host` : serveur SMTP (nécessaire pour l'envoi des bons de commande)
	- `$smtp_login` : login du serveur SMTP (nécessaire pour l'envoi des bons de commande)
	- `$smtp_pass` : mot de passe du serveur SMTP (nécessaire pour l'envoi des bons de commande)
4. Importer le fichier `./micrales.sql` dans la base de donnée.
5. Tout tester

## En fonctionnement
Il est fortement conseillé de faire des backups récurents de la base de données. 
	




