<?php
session_start();
foreach($_POST as $key => $val) $_SESSION['lettre_modif']=$key;

if(isset($_SESSION['lettre_modif']))
{
	unset($_SESSION['gravure'][$_SESSION['lettre_modif']]);
}

function panneau($titre,$police,$taille)
{
	$special = array("AM","apo","Cl","deg","dollard","eperluet","euro","Int","par_g","par_d","plus","point","point_ex","slash_d","slash_g","tiret","yuan","za","zt");
	$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	echo ("<div class='panel panel-default'>
			<div class='panel-heading'>".$titre."</div>");
	foreach ($taille as $t)
	{
		echo ("<div id='".$t."'>");
		switch ($t)
		{
			
			case "spe":
			foreach ($special as $s)
			{
				echo ("<input name='".$s."SpeSpe' src='../img/Spe/".$s.".png' type='image'></input>");
			}
			break;
			
			case "num":
			for ($i=0;$i<10;$i++)
			{
				echo("<input name='".$i."Num".$police."' src='../img/".$police."/".$i.".png' type='image'></input>");
			}
			break;
			
			case "min":
			for($i=0;$i<=25;$i++)
			{
				echo("<input name='".substr($alphabet,$i,1)."Min".$police."' src='../img/".$police."/".substr($alphabet,$i,1).substr($alphabet,$i,1).".png' type='image'></input>");
			}
			break;
			
			case "maj":
			for($i=0;$i<=25;$i++)
			{
				echo("<input name='".substr($alphabet,$i,1)."Maj".$police."' src='../img/".$police."/".substr($alphabet,$i,1).".png' type='image'></input>");
			}
			break;
		}
		echo("</div>");
	}
	echo("</div>");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
		<?php include("includes/meta.php"); ?>

        <title>Lettres</title>
 </head>
 <body>

<div class="container theme-showcase">
<div class="page-header">
<h1>Cliquez sur le caractère choisi</h1>
</div>

<form action="gravure.php" method="post" >
		<input class="btn btn-sm btn-default" type="submit" name='effacer' value="Effacer le caractère">
		</br>
		</br>
</form>


<form action="accent.php" method="post">
<div id = "contenu" class='col-xs-9'> 
<?php
panneau("Police : Bâton","Baton",array('min','maj','num'));
panneau("Police : Z'goth","Old",array('min','maj','num'));
panneau("Police : Clun's","Cluns",array('min','maj','num'));
panneau("Police : Z'goth de Bordel's","Gothique",array('min','maj','num'));
panneau("Caractères spéciaux","Grec",array('min','maj','spe'));
?>
</div>
</form>
</div>
</div>
</body>
<?php include("includes/script.php"); ?>
</html>