<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<form action="menu.php" method="post">
<head>
		<?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Chaîne</title>

 </head>
 <body>
 <div class="container theme-showcase">
 <form action="menu.php" method="post">
<div class="page-header">
<h1>Choix de la chaîne</h1>
</div>

<div class='row'>
	<div class="col-md-8">
		<table class="table table-condensed">
			<tbody>
				<tr>
					<td colspan="3">
						<input type="radio" name="chn_avecsans" value="Avec" id="Avec" checked="checked" onclick="MF(this)"/> <label for="moins15">Avec chaîne</label></br>
						<input type="radio" name="chn_avecsans" value="Sans" id="Sans" onclick="MF(this)"/> <label for="medium15-25">Sans chaîne</label>
					</td>
					<td rowspan="6">
						<img id="img_chn" style="visibility: hidden;" alt="image de la chaine" />
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_longueur">
							Longueur
						</p>
					</td>
					<td>
						<select name="chn_longueur" id="longueur" onclick="longueur_chg(this);">
							<option value="none">Selection</option>
							<option id="0" value="45cm">45cm</option>
							<option id="1" value="50cm">50cm</option>
							<option id="2" value="55cm">55cm</option>
					</select>
					</td>
				</tr>
				<tr>
					<td >
						<p id="titre_metal">Métal</p>
					</td>
					<td>
						<select name="chn_metal" id="metal"onclick="metal_chg(this);"></select>
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_type">
							Type
						</p>
					</td>
					<td>
						<select name="chn_type" id="type" onclick="type_chg(this);"></select>
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_masse">
							Masse d'or
						</p>
					</td>
					<td>
						<select name="chn_masse" id="masse" onclick="masse_chg(this);"></select>
					</td>
				</tr>
				<tr>
					<td>
						Tarif
					</td>
					<td>
						<input name="Formula3" value ="" id="total" disabled="true" class="inputDisabled" type="text">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>




<input name="chn_prix" id="chn_prix" style="display:none;">
<input name="chn_ref" id="chn_ref" style="display:none;">
<div id="bloc">

	<input type="button" onclick="Verifier_formulaire(this.form)" name="apropos" value="Valider">
	
</div>
</form>


</div>
</div>
</body>

<?php include("includes/script.php"); ?>

<script src="../js/chn_java.js"></script>
<script type="text/javascript" src="../js/tabletop.js"></script>
</html>