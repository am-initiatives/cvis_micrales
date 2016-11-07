<?php
session_start();

foreach($_POST as $key => $val){
	$temp=substr($key,0,-2);
	if (substr($temp,-3) == "Spe")
	{
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['lettre']=substr($temp,0,-6);
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['minmaj']=substr($temp,-6,3);
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['police']=substr($temp,-3,3);
	}
	else
	{
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['lettre']= substr($temp,0,1);
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['minmaj']= substr($temp,1,3);
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['police']= substr($temp,4);
	}
} 

?>

<!DOCTYPE html>
<htmllang="fr">
<head>
		<?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Accent</title>
 </head>
<body>
 <div class="container theme-showcase">
<div class="page-header">
<h3>Seuls les caractères en police Bâton peuvent être mis en exposant ou en indice	</h3>
</div>
<form action="gravure.php" method="post">
<div id="bloc">
	<div class="titre">
		Accent
	</div>
	<select class="list-group-item" <?php 
	if(!in_array($_SESSION['gravure'][$_SESSION['lettre_modif']]['lettre'],array("A","E","I","O","U")) OR $_SESSION['gravure'][$_SESSION['lettre_modif']]['police'] =="Grec")
	{
		echo('disabled="true" ');
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['accent'] = " ";
	}	?>  name="Accent">
			<option value=" ">Aucun</option>
			<option value="Aigu">Aigu</option>
			<option value="Grave">Grave</option>
			<option value="Trema">Trema</option>
			<option value="CirconflX">Circonflexe</option>

		</select>
</div>
<div id="bloc">
	<div class="titre">
		Position
	</div>
	<select class="list-group-item" <?php if($_SESSION['gravure'][$_SESSION['lettre_modif']]['police'] != "Baton")
	{
		echo('disabled="true" ');
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['position'] = "Normal";
	}	?> name="position">
			<option value="Normal">Normal</option>
			<option value="Exposant">Exposant</option>
			<option value="Indice">Indice</option>
		</select>
</div>
</br>
	<button class="btn btn-sm btn-default" type="submit" name="apropos" value="Valider">Valider</button>
	</form>
</div>
</div>
</body>

<?php include("includes/script.php"); ?>

</html>