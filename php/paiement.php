<?php
session_start();

require 'config.php';
require_once 'functions.php';

$session_serial = sha1(serialize($_SESSION));
if($session_serial != $_POST['session_serial'])
{
    ?>
    <script type="text/javascript">
    alert("La commande a été modifiée et la page précédente n'était donc pas à jour.\nTu seras redirigé vers la page précédente.");
    window.location = "menu.php";
    </script>
    <?php
    exit;
}


$prix_eqr = getPrixEquerre();
$prix_chn = getPrixChaine();
$prix_livr = getPrixLivraison();
$frais_dossier = getFraisDossier();
$prix_total = $prix_eqr + $prix_chn + $prix_livr + $frais_dossier;
$commentaires = isset($_POST['commentaires']) ? $_POST['commentaires'] : NULL;

/* enregistrement de la commande en BDD */
$insert_stmt = $db->prepare('INSERT INTO commandes (payee, date_enregistrement, date_paiement, ip_enregistrement, bucque, matricule, nom, prenom, telephone, email, civilite, ref_equerre, gravure, ref_chaine, livraison_nom, livraison_adresse1, livraison_adresse2, livraison_cp, livraison_ville, livraison_lieu, prix_eqr, prix_chn, prix_livr, frais_dossier, prix_total, commentaires)
                             VALUES                (FALSE, NOW(),               NULL,          ?,                 ?,      ?,         ?,   ?,      ?,         ?,     ?,        ?,           ?,       ?,          ?,             ?,                  ?,                  ?,            ?,               ?,              ?,        ?,        ?,          ?,            ?,          ?)
                            ') or exit('Erreur de base de données.');
$gravure = serialize($_SESSION['gravure']);
$insert_stmt->bind_param('sssssssssssssssssssssss', $_SERVER['REMOTE_ADDR'], $_SESSION['info_bucque'], $_SESSION['info_matricule'], $_SESSION['info_nom'], $_SESSION['info_prenom'], $_SESSION['info_telephone'], $_SESSION['info_mail'], $_SESSION['pg'], $_SESSION['eqr_ref'], $gravure, $_SESSION['chn_ref'], $_SESSION['livr_nom'], $_SESSION['livr_add1'], $_SESSION['livr_add2'], $_SESSION['livr_cp'], $_SESSION['livr_ville'], $_SESSION['livr_lieu'], $prix_eqr, $prix_chn, $prix_livr, $frais_dossier, $prix_total, $commentaires);
$insert_stmt->execute() or exit('Erreur de base de données.');
$id_commande = $db->insert_id;
$insert_stmt->close();


?>
<!DOCTYPE html>
<html lang="fr">
<head>

         <?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Paiement</title>
		
 </head>
<body>
<div class="container theme-showcase">
	<div class="page-header">
		<h1>Paiement</h1>
	</div>
<form action="pdf_eqr.php" method="post">
<div class='row'>
	<div class="col-md-8">
		<table class="table table-condensed">
			<tbody>
				<tr>
					<td colspan='2'>
						<h2> TOTAL :
							<?php echo number_format($prix_total, 2, ',', ' '); ?> €
						</h2>
					</td>
				</tr>
                <tr>
					<td colspan='2'>
						<div id="lydiaButton">Payer avec Lydia</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


</form>
</div>
</div>
</body>

<script src="../js/pmt_java.js"></script>
<script type="text/javascript" src="../js/oXHR.js"></script>
<?php include("includes/script.php"); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#lydiaButton').payWithLYDIA({
      amount: <?php echo $prix_total; ?>, // amount in €
      vendor_token: '5816408d3abf7719676865',
      recipient: '0711223344', //cellphone or email of your client. Leave it like this for your test
      message : "Micrale, commande <?php echo str_pad($id_commande, 5, '0', STR_PAD_LEFT); ?>", //object of the payment
      env: 'test',
      render : '<img src="https://lydia-app.com/assets/img/paymentbutton.png" />', //button image
      // The client will be redirect to this URL after the payment
      browser_success_url : "<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $base_folder . '/php/succes.php?id=' . $id_commande; ?>",
            // This URL will be called by our server after the payment so you can update the order on your database
      confirm_url : "<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $base_folder . '/php/lydia_confirm.php?id=' . $id_commande; ?>"
    });
  });
</script>

</html>