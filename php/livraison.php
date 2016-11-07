<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<form action="menu.php" method="post">
<head>
        <?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Livraison</title>
 </head>
 <body>
<div class="container theme-showcase">
	<div class="page-header">
		<h1>Livraison</h1>
	</div>
	
<div class='row' onload="MF(this)">
	<div class="col-md-6">
		<table class="table table-condensed">
			<tbody>
				<tr>
					<td colspan="3">
						<input type="radio" name="livr_lieu" value="Resid's P3" id="Avec" checked="checked" onclick="MF(this)"/> <label>Resid's P3</label><br />
						<input type="radio" name="livr_lieu" value="Domicile" id="Sans" onclick="MF(this)"/> <label>Domicile</label>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					<h3 id="infal"> 
						Uniquement pour la France métropolitaine </br> </br>
						Le colis étant envoyé en recommandé, merci de bien vouloir indiquer les coordonnées de la personne qui va recevoir le colis.	
					</h3>
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_nom" class="titre">
							Nom <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_nom" class="inputDisabled"	 id="nom"  type="text">
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_prenom">
							Prénom <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_prenom" class="inputDisabled" id="prenom"  type="text">
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_adresse">
							Adresse <em class="important">*</em>
						</p>
					</td>
					<td>
						<input name="livr_add1" class="inputDisabled" id="adresse1"  type="text">
					</td>
					<td>
						<input name="livr_add2" class="inputDisabled" id="adresse2"  type="text">
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_cp">
							Code Postal <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_cp" class="inputDisabled" id="CP"  type="text">
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_ville">
							Ville <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_ville" class="inputDisabled" id="ville"  type="text">
					</td>
				</tr>
				<tr>
					<td>
							Tarif
					</td>
					<td colspan="2">
						<input name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<button onclick="Verifier_formulaire(this.form)" class="btn btn-sm btn-default" type="button" name="apropos" value="Valider">Valider</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<input name="livr_prix" id="lvr_prix" class="inputDisabled" type="text" style="display:none;">
		
</form>

</div>
</div>
</body>

<?php include("includes/script.php"); ?>

<script src="../js/livr_java.js"></script>
</html>