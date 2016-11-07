<?php
session_start();

if(isset($_POST['effacer']))
{
	unset ($_SESSION['lettre_modif']);
}

if(isset($_SESSION['lettre_modif']))
{
	if (isset($_POST['Accent']))
	{
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['Accent'] = $_POST['Accent'];
	}
	else
	{
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['Accent']="";
	}

	if (isset($_POST['position']))
	{
	 $_SESSION['gravure'][$_SESSION['lettre_modif']]['position']=$_POST['position'];
	}
	else
	{
		$_SESSION['gravure'][$_SESSION['lettre_modif']]['position']="Normal";
	}
    unset($_SESSION['lettre_modif']);
}





?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <?php include("includes/meta.php"); ?>
		<link rel="stylesheet" href="../css/style.css" />

        <title>Gravure</title>
 </head>
<body>


<div class="container theme-showcase">
<div class="page-header">
<h1>Gravure</h1>
</div>

<div class='col-xs-12 col-sm-6 col-md-5'>
	<div class='panel panel-default'> 
		<div id='title' class='panel-heading'>
			Branche A
		</div>
		<div id='monome' class='panel-body'>
			<?php 
			for($i=1;$i<=10;$i++)
			{
				echo("<div>\n\t\t\t\t<img id='A$i' src='../img/vide.png'>\n\t\t\t\t<form action='lettre.php' method='post'>\n\t\t\t\t\t<button class='btn btn-sm btn-default' name='A$i' type='submit'>...</button>\n\t\t\t\t</form>\n\t\t\t</div>\n\t\t\t");
			}
			
			?>
		</div>
		<div id="culot" class="panel-body">
			Alignement des écritures sur la branche
			<select id="alignementA" onclick="alignement()" name="alignementA">
				<option value="Centré"<?php if(isset($_SESSION['gravure']['grv_alignementA']) && $_SESSION['gravure']['grv_alignementA'] == 'Centré') echo ' selected="selected"'; ?>>Centré</option>
				<option value="Droite"<?php if(isset($_SESSION['gravure']['grv_alignementA']) && $_SESSION['gravure']['grv_alignementA'] == 'Droite') echo ' selected="selected"'; ?>>Droite</option>
				<option value="Gauche"<?php if(isset($_SESSION['gravure']['grv_alignementA']) && $_SESSION['gravure']['grv_alignementA'] == 'Gauche') echo ' selected="selected"'; ?>>Gauche</option>
			</select>
		</div>
	</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-5'>
	<div class='panel panel-default'> 
		<div id='title' class='panel-heading'>
			Branche B
		</div>
		<div id='monome' class='panel-body'>
			<?php 
			for($i=1;$i<=10;$i++)
			{
				echo("<div>\n\t\t\t\t<img id='B$i' src='../img/vide.png'>\n\t\t\t\t<form action='lettre.php' method='post'>\n\t\t\t\t\t<button class='btn btn-sm btn-default' name='B$i' type='submit'>...</button>\n\t\t\t\t</form>\n\t\t\t</div>\n\t\t\t");
			}
			?>
		</div>
		<div id="culot" class="panel-body">
			Alignement des écritures sur la branche
			<select id="alignementB" onclick="alignement()" name="alignementB">
				<<option value="Centré"<?php if(isset($_SESSION['gravure']['grv_alignementB']) && $_SESSION['gravure']['grv_alignementB'] == 'Centré') echo ' selected="selected"'; ?>>Centré</option>
				<option value="Droite"<?php if(isset($_SESSION['gravure']['grv_alignementB']) && $_SESSION['gravure']['grv_alignementB'] == 'Droite') echo ' selected="selected"'; ?>>Droite</option>
				<option value="Gauche"<?php if(isset($_SESSION['gravure']['grv_alignementB']) && $_SESSION['gravure']['grv_alignementB'] == 'Gauche') echo ' selected="selected"'; ?>>Gauche</option>
			</select>
		</div>
	</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-5'>
	<div class='panel panel-default'> 
		<div id='title' class='panel-heading'>
			Branche C
		</div>
		<div id='monome' class='panel-body'>
			<?php 
			for($i=1;$i<=10;$i++)
			{
				echo("<div>\n\t\t\t\t<img id='C$i' src='../img/vide.png'>\n\t\t\t\t<form action='lettre.php' method='post'>\n\t\t\t\t\t<button class='btn btn-sm btn-default' name='C$i' type='submit'>...</button>\n\t\t\t\t</form>\n\t\t\t</div>\n\t\t\t");
			}
			?>
		</div>
		<div id="culot" class="panel-body">
			Alignement des écritures sur la branche
			<select id="alignementC" onclick="alignement()" name="alignementC">
				<option value="Centré"<?php if(isset($_SESSION['gravure']['grv_alignementC']) && $_SESSION['gravure']['grv_alignementC'] == 'Centré') echo ' selected="selected"'; ?>>Centré</option>
				<option value="Droite"<?php if(isset($_SESSION['gravure']['grv_alignementC']) && $_SESSION['gravure']['grv_alignementC'] == 'Droite') echo ' selected="selected"'; ?>>Droite</option>
				<option value="Gauche"<?php if(isset($_SESSION['gravure']['grv_alignementC']) && $_SESSION['gravure']['grv_alignementC'] == 'Gauche') echo ' selected="selected"'; ?>>Gauche</option>
			</select>
		</div>
	</div>
</div>
<div class='col-xs-12 col-sm-6 col-md-5'>
	<div class='panel panel-default'> 
		<div id='title' class='panel-heading'>
			Branche D
		</div>
		<div id='monome' class='panel-body'>
			<?php 
			
			for($i=1;$i<=10;$i++)
			{
				echo("<div>\n\t\t\t\t<img id='D$i' src='../img/vide.png'>\n\t\t\t\t<form action='lettre.php' method='post'>\n\t\t\t\t\t<button class='btn btn-sm btn-default' name='D$i' type='submit'>...</button>\n\t\t\t\t</form>\n\t\t\t</div>\n\t\t\t");
			}
			
			?>
		</div>
		<div id="culot" class="panel-body">
			Alignement des écritures sur la branche
			<select id="alignementD" onclick="alignement()" name="alignementD">
				<option value="Centré"<?php if(isset($_SESSION['gravure']['grv_alignementD']) && $_SESSION['gravure']['grv_alignementD'] == 'Centré') echo ' selected="selected"'; ?>>Centré</option>
				<option value="Droite"<?php if(isset($_SESSION['gravure']['grv_alignementD']) && $_SESSION['gravure']['grv_alignementD'] == 'Droite') echo ' selected="selected"'; ?>>Droite</option>
				<option value="Gauche"<?php if(isset($_SESSION['gravure']['grv_alignementD']) && $_SESSION['gravure']['grv_alignementD'] == 'Gauche') echo ' selected="selected"'; ?>>Gauche</option>
			</select>
		</div>
	</div>
</div>
<div id = "contenu" class='row'> 
</div>

	<form action="menu.php" method="post">
	<input name="grv_alignementA" style="display:none;" id="grv_alignementA" type="text">
	<input name="grv_alignementB" style="display:none;" id="grv_alignementB" type="text">
	<input name="grv_alignementC" style="display:none;" id="grv_alignementC" type="text">
	<input name="grv_alignementD" style="display:none;" id="grv_alignementD" type="text">
	<button type="submit" name="gravure" value="Valider" class=" theme-showcase btn btn-sm btn-default">Valider</button>
	</form>
	

<?php 
echo('<script type="text/javascript">');
foreach(range('A','D') as $lettre)
{
	for($i =1; $i<=10; $i++)
	{
		$bidule = ($lettre.$i);
		
		if (isset($_SESSION['gravure'][$bidule]['minmaj']))
		{

		if ($_SESSION['gravure'][$bidule]['minmaj']=="Min")
			{
				echo('document.getElementById("'.$bidule.'").setAttribute("src","../img/'.$_SESSION['gravure'][$bidule]['police'].'/'.$_SESSION['gravure'][$bidule]['lettre'].$_SESSION['gravure'][$bidule]['lettre'].'.png");');
			}
		else 
			{
				echo('document.getElementById("'.$bidule.'").setAttribute("src","../img/'.$_SESSION['gravure'][$bidule]['police'].'/'.$_SESSION['gravure'][$bidule]['lettre'].'.png");');
			}
		}

	}
}
echo('</script>');
?>
</div>
</div>
</body>
<script src="../js/grv_java.js"></script>
<?php include("includes/script.php"); ?>


</html>