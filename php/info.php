<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
		<?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Informations personnelles</title>
 </head>
 <body>

 <form action="menu.php" method="post" name="info">
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
							<input name="info_proms" id="total" class="inputDisabled" type="text" value="214">
						</td>
					</tr>
					<tr>
						<td>
							Nom<em class="important">*</em>
						</td>
						<td colspan="2">
							<input name="info_nom" id="id_nom"  class="inputDisabled" type="text" required="required">
						</td>
					</tr>
					<tr>
						<td>
							Prénom<em class="important">*</em>
						</td>
						<td colspan="2">
							<input name="info_prenom" id="id_prenom"  class="inputDisabled" type="text" required="required">
						</td>
					</tr>
					<tr>
						<td>
							Téléphone<em class="important">*</em>
						</td>
						<td colspan="2">
							<input name="info_telephone" id="telephone" class="inputDisabled" type="text" required="required">
						</td>
					</tr>
					<tr>
						<td>
							Mail<em class="important">*</em>
						</td>
						<td colspan="2">
							<input name="info_mail" id="id_mail"  class="inputDisabled" type="text" required="required">
						</td>
					</tr>
					<tr>
					<td colspan="3">
						<input type="submit" name="Info" value="Valider" class="btn btn-sm btn-default">
					</td>
					</tr>
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
<script type="text/javascript">
$(function() {
	$("form[name=info]").validate({
		rules: {
			info_nom: "required",
			info_prenom: "required",
			info_telephone: "required",
			info_mail: { required: true, email: true }
		},
		messages: {
			info_nom: "Le champ nom est vide",
			info_prenom: "Le champ prénom est vide",
			info_telephone: "Le champ téléphone est vide",
			info_mail: "L'adresse email n'est pas valide"
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
</html>