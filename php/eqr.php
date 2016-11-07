<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<form action="menu.php" method="post">
<head>
        <?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Equerre</title>
 </head>
 <body>

 <div class="container theme-showcase">
<div class="page-header">
<h1>Choix de l'équerre</h1>
</div>


<div class='row'>
	<div class="col-md-6">
		<table class="table table-condensed">
			<tbody>
				<tr>
					<td colspan="2">
						<input type="radio" name="avecsans" value="Avec" id="Avec" checked="checked" onclick="MF(this)"/> <label for="moins15">Avec</label></br>
						<input type="radio" name="avecsans" value="Sans" id="Sans" onclick="MF(this)"/> <label for="medium15-25">Sans</label>
					</td>
					<td rowspan="2">
						<img id="img_metal" style="visibility: hidden;" src="../img/fine.jpg" alt="image du métal choisi" />
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_metal">Métal</p>
					</td>
					<td>
						<select id="metal" name="eqr_metal" onclick="metal_chg(this);" onchange="metal_chg(this);">
							<option value="none">Selection</option>
							<option id="0" value="OR JAUNE">OR JAUNE</option>
							<option id="1" value="OR BLANC">OR BLANC</option>
							<option id="2" value="ARGENT">ARGENT</option>
						</select>
					</td>
				</tr>
				<tr>
					<td >
						<p id="titre_epaisseur">Epaisseur</p>
					</td>
					<td>
						<select id="epaisseur" name="eqr_epaisseur" onclick="epais_chg(this);" onchange="epais_chg(this);" ></select>
					</td>
					<td rowspan="2">
						<img id="img_epais" style="visibility: hidden;" src="../img/fine.jpg" alt="épaisseur choisie" />
					</td>
				</tr>
				<tr>
					<td>
						<p id="titre_gravure">Gravure</p>
					</td>
					<td>
						<select id="gravure" name="eqr_gravure" onclick="grav_chg(this);" onchange="grav_chg(this);"></select>
					</td>
				</tr>
				<tr>
					<td>
						<p id='titre_encoche'>Encoche</p>
					</td>
					<td>
						<select id="encoche" name="eqr_encoche" onclick="enc_chg(this);" onchange="enc_chg(this);"></select>
					</td>
					<td rowspan="2">
						<img id="img_encoche" src="../img/Encoche.jpg" alt="image avec/sans encoche" />
					</td>
				</tr>
				<tr>
					<td>
						Tarif
					</td>
					<td>
						<input name="Formula3" id="total" disabled="true" type="text">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<input name="eqr_prix" id="eqr_prix" style="display:none;" type="text">
<input name="eqr_ref" id="eqr_ref" style="display:none;" type="text">
<div id="bloc">

	<input type="button" onclick="Verifier_formulaire(this.form)" name="apropos" value="Valider" class="btn btn-sm btn-default">
	</form>
</div>

</div>
</div>
</body>

<?php include("includes/script.php"); ?>

<script type="text/javascript" src="../js/eqr_java.js"></script>
<script type="text/javascript" src="../js/tabletop.js"></script>
</html>
