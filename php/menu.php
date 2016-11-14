<?php
session_start();
require 'config.php';
require_once 'functions.php';
if (isset($_POST['info_bucque']))
{
	$_SESSION['info_matricule']= ($_POST['info_nums'].$_POST['info_TBK'].$_POST['info_proms']);
	$_SESSION['proms'] = ($_POST['info_TBK'].$_POST['info_proms']);
	$_SESSION['info_telephone']= $_POST['info_telephone'];
	$_SESSION['info_nom']= $_POST['info_nom'];
	$_SESSION['info_prenom']= $_POST['info_prenom'];
	$_SESSION['info_mail']= $_POST['info_mail'];
	$_SESSION['info_bucque']= $_POST['info_bucque'];
	$_SESSION['pg']= $_POST['pg'];
}
if (isset($_POST['avecsans']) && isset($_POST['eqr_ref']))
{
	if ($_POST['avecsans']=="Avec")
	{
        $_SESSION['eqr_ref'] = $_POST['eqr_ref'];
        $ref = $_POST['eqr_ref'];
        $eqr_stmt = $db->prepare("SELECT gravure FROM equerres WHERE ref = ?");
        $eqr_stmt->bind_param('s', $_POST['eqr_ref']);
        $eqr_stmt->execute();
        $eqr_stmt->bind_result($eqr_gravure);
        $eqr_stmt->fetch();
        
		if (!$eqr_gravure)
		{
			$_SESSION['grv']="Gravure indisponible";
			foreach(range('A','D') as $lettre)
			{
				for($i =1; $i<=10; $i++)
				{
					unset($_SESSION['gravure'][$lettre . $i]);
				}
			}
		}
		else 
		{
			if ($_SESSION['grv']!="Gravure enregistrée"){$_SESSION['grv']="";}
		}
        
        $eqr_stmt->close();
	}
	else
	{
		$_SESSION['eqr'] = "";
		$_SESSION['eqr_prix'] = 0;
		$_SESSION['eqr_ref'] = "";
		$_SESSION['grv']="Gravure indisponible";
		foreach(range('A','D') as $lettre)
		{
			for($i =1; $i<=10; $i++)
			{
				$bidule = ($lettre.$i);
				unset($_SESSION['gravure'][$bidule]);
			}
		}
	}
}
if (isset($_POST['grv_alignementA']))
{
	$_SESSION['gravure']['grv_alignementA'] = $_POST['grv_alignementA'];
	$_SESSION['gravure']['grv_alignementB'] = $_POST['grv_alignementB'];
	$_SESSION['gravure']['grv_alignementC'] = $_POST['grv_alignementC'];
	$_SESSION['gravure']['grv_alignementD'] = $_POST['grv_alignementD'];
}
if (isset($_POST['chn_avecsans']) && isset($_POST['chn_ref']))
{
	if ($_POST['chn_avecsans']=="Avec")
	{
        $_SESSION['chn_ref'] = $_POST['chn_ref'];
	}
	else
	{
		$_SESSION['chn'] = "";
		$_SESSION['chn_prix'] = 0;
		$_SESSION['chn_ref'] = "";
	}
}
if (isset($_POST['livr_lieu']))
{
	if ($_POST['livr_lieu']=="Domicile")
	{
		$_SESSION['livr_lieu'] =$_POST['livr_lieu'];
		$_SESSION['livr_nom'] = ($_POST['livr_prenom']." ".$_POST['livr_nom']);
		$_SESSION['livr_add1'] =$_POST['livr_add1'];
		$_SESSION['livr_add2'] = $_POST['livr_add2'];
		$_SESSION['livr_cp'] = $_POST['livr_cp'];
		$_SESSION['livr_ville'] = $_POST['livr_ville'];
		$_SESSION['livr_prix'] = $_POST['livr_prix'];
	}
	else
	{
		$_SESSION['livr_lieu'] = $_POST['livr_lieu'];
		$_SESSION['livr_nom'] = "";
		$_SESSION['livr_add1'] = "";
		$_SESSION['livr_add2'] = "";
		$_SESSION['livr_cp'] = "";
		$_SESSION['livr_ville'] = "";
		$_SESSION['livr_prix'] = $_POST['livr_prix'];
	}
}
if(isset($_POST['gravure']))
{
	$_SESSION['grv']="Gravure enregistrée";
}
if (isset ($_GET['reset']))
{
	session_destroy();
	session_start();
}
if (!isset( $_SESSION['grv'])){ $_SESSION['grv']="Gravure indisponible";}
if (!isset( $_SESSION['chn_ref'])){ $_SESSION['chn_ref']="";}
if (!isset( $_SESSION['livr_prix'])){ $_SESSION['livr_prix']="0";}
if (!isset( $_SESSION['chn_prix'])){ $_SESSION['chn_prix']="0";}
if (!isset( $_SESSION['eqr_prix'])){ $_SESSION['eqr_prix']="0";}
if (!isset( $_SESSION['info_matricule'])){ $_SESSION['info_matricule']="";}
if (!isset( $_SESSION['info_nom'])){ $_SESSION['info_nom']="";}
if (!isset( $_SESSION['info_telephone'])){ $_SESSION['info_telephone']="";}
if (!isset( $_SESSION['info_mail'])){ $_SESSION['info_mail']="";}
if (!isset( $_SESSION['eqr'])){ $_SESSION['eqr']="";}
if (!isset( $_SESSION['chn'])){ $_SESSION['chn']="";}
if (!isset( $_SESSION['livr_add1'])){ $_SESSION['livr_add1']="";}
if (!isset( $_SESSION['livr_add2'])){ $_SESSION['livr_add2']="";}
if (!isset( $_SESSION['livr_cp'])){ $_SESSION['livr_cp']="";}
if (!isset( $_SESSION['livr_nom'])){ $_SESSION['livr_nom']="";}
if (!isset( $_SESSION['livr_lieu'])){ $_SESSION['livr_lieu']="";}
if (!isset( $_SESSION['livr_ville'])){ $_SESSION['livr_ville']="";}
if(!isset($_SESSION['info_bucque']))
{
	$_SESSION['info_matricule']= "";
	$_SESSION['info_telephone']= "";
	$_SESSION['info_nom']= "";
	$_SESSION['info_prenom']= "";
	$_SESSION['info_mail']= "";
	$_SESSION['info_bucque']="";
	$_SESSION['pg']= "";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
		<?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Générateur de bon de commande</title>

 </head>
 <body>


<div class="container theme-showcase">
<form action= "menu.php">
<input type = "button" name="apropos" class="btn btn-sm btn-default" value="A propos du logiciel" onclick="alert('Ce logiciel a été réalisé par Talango 64Ch213 dit Clément Rieuneau sur une\nidée originale de Gomergoof 114Li207 dit Tristan Guesney.\nModifié et amélioré par Fantal 92Ch214.\nPas d\'utilisation commerciale')">

	<button type = "submit" name="reset" class="btn btn-sm btn-default" value ="ok">Réinitialiser</button>
</form>
<div class="page-header">
<h1>Bon de commande pour micro-équerre</h1>
</div>
<div class='row'>
<div class="col-md-9"> 
	<table class="table table-condensed">
	<thead>
	</thead>
		<tbody>
			<tr>
				<td rowspan="2">Reignements Personnels <em class="important">*</td>
				<td rowspan="2">
					<form action="info.php">
						<button type="submit" class="btn btn-sm btn-default"  value="Modifier" href="info.php">Modifier</button>
					</form>
				</td>
				<td>
					<input value= <?php echo('"'.$_SESSION['info_bucque'].' '. $_SESSION['info_matricule'].'" ')?> name="Formula3" id="pomo" disabled="true" class="inputDisabled" type="text">
				</td>
				<td>
					<input value= <?php echo('"'. $_SESSION['info_telephone'].'" ')?> name="telephone" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
			</tr>
			<tr>
				<td>
					<input value= <?php echo('"'.$_SESSION['info_prenom'].' '. $_SESSION['info_nom'].'" ')?> name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
				<td>
					<input value= <?php echo('"'. $_SESSION['info_mail'].'" ')?> name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
			</tr>
			<tr>
				<td>Equerre</td>
				<td>
					<form action="eqr.php">
						<button type="submit" class="btn btn-sm btn-default"  value="Modifier" href="info.php">Modifier</button>
					</form>
				</td>
				<td colspan="2">
					<input value="<?php echo htmlentities(getDescriptionEquerre(), ENT_QUOTES, 'UTF-8'); ?>"  name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
			</tr>
			<tr>
				<td>Gravure</td>
				<td>
					<form action="gravure.php">
						<button type="button" class="btn btn-sm btn-default" onclick="grv(this.form)")  value="Modifier" href="info.php">Modifier</button>
					</form>
				</td>
				<td colspan="2">
					<input value="<?php echo htmlentities($_SESSION['grv'], ENT_QUOTES, 'UTF-8'); ?>"  name="Formula3" id="gragra" class="inputDisabled" disabled="true" type="text">
				</td>
			</tr>
			<tr>
				<td>Chaîne</td>
				<td>
					<form action="chn.php">
						<button type="submit" class="btn btn-sm btn-default"  value="Modifier" href="info.php">Modifier</button>
					</form>
				</td>
				<td colspan="2">
					<input value="<?php echo htmlentities(getDescriptionChaine(), ENT_QUOTES, 'UTF-8'); ?>" name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
			</tr>
			<tr>
				<td rowspan="3">Livraison <em class="important">*</td>
				<td rowspan="3">
					<form action="livraison.php">
						<button type="submit"  class="btn btn-sm btn-default" value="Modifier" href="info.php">Modifier</button>
					</form>
				</td>
				<td>
					<input value="<?php echo htmlentities($_SESSION['livr_lieu'], ENT_QUOTES, 'UTF-8'); ?>" name="Formula3" id="enclume" disabled="true" class="inputDisabled" type="text">
				</td>
				<td>
					<input value="<?php echo htmlentities($_SESSION['livr_nom'], ENT_QUOTES, 'UTF-8'); ?>" name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
				
			</tr>
			<tr>
				<td>
					<input value="<?php echo htmlentities($_SESSION['livr_add1'], ENT_QUOTES, 'UTF-8'); ?>" name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
				<td>
					<input value="<?php echo htmlentities($_SESSION['livr_add2'], ENT_QUOTES, 'UTF-8'); ?>" name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
			</tr>
			<tr>
				<td>
					<input value="<?php echo htmlentities($_SESSION['livr_cp'], ENT_QUOTES, 'UTF-8'); ?>" name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
				<td>
					<input value="<?php echo htmlentities($_SESSION['livr_ville'], ENT_QUOTES, 'UTF-8'); ?>" name="Formula3" id="total" disabled="true" class="inputDisabled" type="text">
				</td>
			</tr>
		</tbody>
	</table>
</div>
</div>



<?php
$prix_eqr = getPrixEquerre();
$prix_chn = getPrixChaine();
$prix_livr = getPrixLivraison();
$frais_dossier = getFraisDossier();
$prix_total = $prix_eqr + $prix_chn + $prix_livr + $frais_dossier;
?>


<div class="page-header">
    <h1>
Total à payer</h1>
</div>
	<div class="col-md-9">
		<table class = "table">
		<thead>
		<th>Equerre</th>
		<th> </th>
		<th>Chaîne</th>
		<th> </th>
		<th>Livraison</th>
		<th> </th>
		<th>Frais de dossier</th>
		<th> </th>
		<th>Total</th>
		</thead>
		<tbody>
		<tr>
		<td><input value="<?php echo number_format($prix_eqr, 2, ',', ' '); ?>€" name="Formula3" id="total" class="inputDisabled"  disabled="true" type="text"></td>
		<td>+</td>
		<td><input value="<?php echo number_format($prix_chn, 2, ',', ' '); ?>€" id="total" disabled="true" class="inputDisabled" type="text"></td>
		<td>+</td>
		<td><input name="Formula3" id="total" disabled="true" value="<?php echo number_format($prix_livr, 2, ',', ' '); ?>€" class="inputDisabled" type="text"></td>
		<td>+</td>
		<td><input name="Formula3" id="total" disabled="true" class="inputDisabled" type="text" value="<?php echo number_format($frais_dossier, 2, ',', ' '); ?>€"></td>
		<td>=</td>
		<td ><input name="Formula3" id="total" disabled="true" class="inputDisabled" value="<?php echo number_format($prix_total, 2, ',', ' '); ?>€"" type="text"><td>
		</tr>
		</tbody>
		</table>
	
</br>
<form action="confirmer.php">
<input type="button"  class="btn btn-sm btn-default" onclick="Verifier_formulaire(this.form)" name="apropos" value="Suite de la commande">
</form>
</div>
</div>
</div>
</body>
<?php include("includes/script.php"); ?>
<script src="../js/menu_java.js"></script>
</html>