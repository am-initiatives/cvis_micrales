<?php
session_start();
?>
<!DOCTYPE html>
<html>
<form action="menu.php" method="post">
<head>
		<?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Informations personnelles</title>
 </head>
 <body>

<div class="container theme-showcase">
	<div class="page-header">
		<h1>Informations personnelles</h1>
	</div>

	<div class='row'>
		<div class="col-md-6">
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td colspan="3">
							<input type="radio" name="pg" value="M" id="male" checked="checked"/> <label for="moins15">PG</label><br />
							<input type="radio" name="pg" value="Mlle" id="female" /> <label for="medium15-25">PGette</label>
						</td>
					</tr>
					
					
					<tr>
						<td>
						Bucque
						</td>
						<td colspan="2">
							<input name="info_bucque" id="total" class="inputDisabled" type="text">
						</td>
					</tr>
					<tr>
						<td>
						Num's
						</td>
						<td colspan="2" >
							<input name="info_nums" id="total" class="inputDisabled" type="text">
						</td>
					</tr>
					<tr>
						<td>
						Prom's
						</td>
						<td>
							<select name="info_TBK">
								<option value="Ai">Aix</option>
								<option value="An">Angers</option>
								<option value="Bo">Bordeaux</option>
								<option value="Ch" selected="selected">Châlons</option>
								<option value="Cl">Cluny</option>
								<option value="Ka">Karlsruhe</option>
								<option value="Li">Lille</option>
								<option value="Pa">Paris</option>
								<option value="Me">Metz</option>
							</select>
						</td>
						<td>
							<input name="info_proms" id="total" class="inputDisabled" type="text">
						</td>
					</tr>
					<tr>
						<td>
							Nom<em class="important">*</em>
						</td>
						<td colspan="2">
							<input name="info_nom" id="id_nom"  class="inputDisabled" type="text">
						</td>
					</tr>
					<tr>
						<td>
							Prénom<em class="important">*</em>
						</td>
						<td colspan="2">
							<input name="info_prenom" id="id_prenom"  class="inputDisabled" type="text">
						</td>
					</tr>
					<tr>
						<td>
							Téléphone
						</td>
						<td colspan="2">
							<input name="info_telephone" id="telephone" class="inputDisabled" type="text">
						</td>
					</tr>
					<tr>
						<td>
							Mail<em class="important">*</em>
						</td>
						<td colspan="2">
							<input name="info_mail" id="id_mail"  class="inputDisabled" type="text">
						</td>
					</tr>
					
					<td colspan="3">
						<input type="button" onclick="Verifier_formulaire(this.form)" name="Info" value="Valider" class="btn btn-sm btn-default">
					</td>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</body>
<footer>

</footer>
</form>
<?php include("includes/script.php"); ?>

<script src="../js/info_java.js"></script>
</html>