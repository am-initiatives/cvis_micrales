<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

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
<form action="menu.php" method="post" name="livraison">
<div class='row' onload="MF(this)">
	<div class="col-md-6">
		<table class="table table-condensed">
			<tbody>
				<tr>
					<td colspan="3">
						<input type="radio" name="livr_lieu" value="Resid's P3" id="ResidsP3" checked="checked" onclick="MF(this)" onchange="MF(this)" /> <label for="ResidsP3">Resid's P3</label><br />
						<input type="radio" name="livr_lieu" value="Domicile" id="Domicile" onclick="MF(this)" onchange="MF(this)" /> <label for="Domicile">Domicile</label>
					</td>
				</tr>
				<tr class="livrDomicile">
					<td colspan="3">
					<h3 id="infal"> 
						Uniquement pour la France métropolitaine </br> </br>
						Le colis étant envoyé en recommandé, merci de bien vouloir indiquer les coordonnées de la personne qui va recevoir le colis.	
					</h3>
					</td>
				</tr>
				<tr class="livrDomicile">
					<td>
						<p id="titre_nom" class="titre">
							Nom <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_nom" class="inputDisabled"	 id="livr_nom"  type="text">
					</td>
				</tr>
				<tr class="livrDomicile">
					<td>
						<p id="titre_prenom">
							Prénom <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_prenom" class="inputDisabled" id="livr_prenom"  type="text">
					</td>
				</tr>
				<tr class="livrDomicile">
					<td>
						<p id="titre_adresse">
							Adresse <em class="important">*</em>
						</p>
					</td>
					<td>
						<input name="livr_add1" class="inputDisabled" id="livr_add1"  type="text">
					</td>
					<td>
						<input name="livr_add2" class="inputDisabled" id="livr_add2"  type="text">
					</td>
				</tr>
				<tr class="livrDomicile">
					<td>
						<p id="titre_cp">
							Code Postal <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_cp" class="inputDisabled" id="livr_cp"  type="text">
					</td>
				</tr>
				<tr class="livrDomicile">
					<td>
						<p id="titre_ville">
							Ville <em class="important">*</em>
						</p>
					</td>
					<td colspan="2">
						<input name="livr_ville" class="inputDisabled" id="livr_ville"  type="text">
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
						<input type="submit" class="btn btn-sm btn-default" name="apropos" value="Valider" />
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

<script type="text/javascript">

function MF()
{
	if($("#Domicile:checked").length) {
		$(".livrDomicile").show();
		$("#total").val("12,00€");
		$("#lvr_prix").val("12");
	}
	else
	{
		$(".livrDomicile").hide();
		$("#total").val("0,00€");
		$("#lvr_prix").val("0");
	}
};

$(function() {
	MF();
	
	$("input[name=livr_lieu]").change(MF);
	
	$("form[name=livraison]").validate({
		rules: {
			livr_nom: {required: '#Domicile:checked'},
			livr_prenom: {required: '#Domicile:checked'},
			livr_add1: {required: '#Domicile:checked'},
			livr_cp: {required: '#Domicile:checked'},
			livr_ville: {required: '#Domicile:checked'}
		},
		messages: {
			livr_nom: "Le champ nom est vide",
			livr_prenom: "Le champ prénom est vide",
			livr_add1: "Le champ adresse est vide",
			livr_cp: "Le champ code postal est vide",
			livr_ville: "Le champ ville est vide" 	
		},
		submitHandler: function(f) {
			f.submit();
		},
		error: function(error) {
			alert(error.text());
		}
	});
});
</script>
<script src="../js/livr_java.js"></script>
</html>