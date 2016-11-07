<?php
session_start();

require 'config.php';
require_once 'functions.php';

$prix_eqr = getPrixEquerre();
$prix_chn = getPrixChaine();
$prix_livr = getPrixLivraison();
$frais_dossier = getFraisDossier();

$prix_total = $prix_eqr + $prix_chn + $prix_livr + $frais_dossier;


?>
<!DOCTYPE html>
<html lang="fr">
<head>

         <?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Confirmation de commande</title>
		
 </head>
<body>
<div class="container theme-showcase">
	<div class="page-header">
		<h1>Confirmation de la commande</h1>
	</div>
<form action="paiement.php" method="post">
<input type="hidden" name="session_serial" value="<?php echo sha1(serialize($_SESSION)); ?>" />
<div class='row'>
	<div class="col-md-8">
		<table class="table table-condensed">
			<tbody>
				<tr>
					<td colspan='2'>
						<h3 id="infal">Informations PG
							
						</h3>
					</td>
				</tr>
                <tr>
					<td>
						Civilité
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['pg'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
                <tr>
					<td>
						Prénom
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['info_prenom'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				<tr>
					<td>
						Nom
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['info_nom'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
                <tr>
					<td>
						Email
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['info_mail'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
                <tr>
					<td>
						Email
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['info_mail'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
                <tr>
					<td>
						Téléphone
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['info_telephone'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
                <tr>
					<td>
						Bucque
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['info_bucque'] . ' (' . $_SESSION['info_matricule'] . ')', ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
                
                <?php
                if(!empty($_SESSION['eqr_ref']))
                {
                    ?>
                    <tr>
                        <td colspan='2'>
                            <h3 id="conseil">&Eacute;querre</h3>
                        </td>
                    </tr>
                    <?php
                    $eqr_stmt = $db->prepare("SELECT ref, prix, metal, epaisseur, gravure, encoche, commentaire FROM equerres WHERE ref = ?");
                    $eqr_stmt->bind_param('s', $_SESSION['eqr_ref']);
                    $eqr_stmt->execute();
                    $eqr_stmt->bind_result($eqr_ref, $eqr_prix, $eqr_metal, $eqr_epaisseur, $eqr_gravure, $eqr_encoche, $eqr_commentaire);
                    $eqr_stmt->fetch();
                    $eqr_stmt->close();
                    ?>
                    <tr>
                        <td>
                            Référence
                        </td>
                        <td>
                            <?php echo htmlspecialchars($eqr_ref, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Métal
                        </td>
                        <td>
                            <?php echo htmlspecialchars($eqr_metal, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &Eacute;paisseur
                        </td>
                        <td>
                            <?php echo htmlspecialchars($eqr_epaisseur, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Gravure
                        </td>
                        <td>
                            <?php echo $eqr_gravure ? 'Oui' : 'Non'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Encoche
                        </td>
                        <td>
                            <?php echo $eqr_encoche ? 'Oui' : 'Non'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Prix
                        </td>
                        <td>
                            <?php echo number_format($prix_eqr, 2, ',', ' '); ?> €
                        </td>
                    </tr>
                <?php
                }
                ?>
                
                <?php
                if(isset($_SESSION['grv']) && $_SESSION['grv'] != 'Gravure indisponible')
                {
                    ?>
                    <tr>
                        <td colspan='2'>
                            <h3 id="conseil">Gravure</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <img src="gravure_preview_AB.php?<?php echo md5(microtime()); ?>" style="width: 45%;"/>
                            <span style="width: 4%;">&nbsp;</span>
                            <img src="gravure_preview_CD.php?<?php echo md5(microtime()); ?>" style="width: 45%;"/>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <?php
                if(!empty($_SESSION['chn_ref']))
                {
                    ?>
                    <tr>
                        <td colspan='2'>
                            <h3 id="conseil">Chaîne</h3>
                        </td>
                    </tr>
                    <?php
                    $chn_stmt = $db->prepare("SELECT ref, longueur, metal, type, masse_or, prix FROM chaines WHERE ref = ?");
                    $chn_stmt->bind_param('s', $_SESSION['chn_ref']);
                    $chn_stmt->execute();
                    $chn_stmt->bind_result($chn_ref, $chn_longueur, $chn_metal, $chn_type, $chn_masse_or, $chn_prix);
                    $chn_stmt->fetch();
                    $chn_stmt->close();
                    ?>
                    
                    <tr>
                        <td>
                            Référence
                        </td>
                        <td>
                            <?php echo htmlentities($chn_ref, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Longueur
                        </td>
                        <td>
                            <?php echo htmlentities($chn_longueur, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Métal
                        </td>
                        <td>
                            <?php echo htmlentities($chn_metal, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Type
                        </td>
                        <td>
                            <?php echo htmlentities($chn_type, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Masse d'or
                        </td>
                        <td>
                            <?php echo htmlentities($chn_masse_or, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            Prix
                        </td>
                        <td>
                            <?php echo number_format($prix_chn, 2, ',', ' '); ?> €
                        </td>
                    </tr>
                <?php
                }
                ?>
                
                <tr>
					<td colspan='2'>
						<h3 id="conseil">Livraison</h3>
					</td>
				</tr>
                
                <tr>
					<td>
						Lieu
					</td>
					<td>
						<?php echo htmlspecialchars($_SESSION['livr_lieu'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
                
                <?php
                if($_SESSION['livr_lieu'] != 'Resid\'s P3')
                {
                    ?>
                    <tr>
                        <td>
                            Nom
                        </td>
                        <td>
                            <?php echo htmlspecialchars($_SESSION['livr_nom'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Adresse 1
                        </td>
                        <td>
                            <?php echo htmlspecialchars($_SESSION['livr_add1'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Adresse 2
                        </td>
                        <td>
                            <?php echo htmlspecialchars($_SESSION['livr_add2'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Code postal
                        </td>
                        <td>
                            <?php echo htmlspecialchars($_SESSION['livr_cp'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ville
                        </td>
                        <td>
                            <?php echo htmlspecialchars($_SESSION['livr_ville'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                  
                    <?php
                }
                ?>
                <tr>
                    <td>
                        Prix
                    </td>
                    <td>
                        <?php echo number_format($prix_livr, 2, ',', ' '); ?> €
                    </td>
                </tr>
                
                <tr>
					<td colspan='2'>
						<h3 id="conseil">Commentaires</h3>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea class="inputDisabled" name="commentaires" id="commentaires" rows="5" ></textarea>
					</td>
				</tr>
                <tr>
					<td colspan='2'>
						<h2> TOTAL :
							<?php echo number_format($prix_total, 2, ',', ' '); ?> €
						</h2>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<button type="submit" class="btn btn-sm btn-default"  value="Valider">Valider et payer</button>
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


</html>