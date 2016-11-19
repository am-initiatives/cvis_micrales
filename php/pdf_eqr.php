<?php
require_once 'config.php';

if(!isset($_GET['id']) && !isset($GLOBALS['id'])) exit;
if(isset($GLOBALS['id']))
	$id_commande = intval($GLOBALS['id']);
else
	$id_commande = intval($_GET['id']);

$cmd_stmt = $db->prepare('SELECT id, payee, date_enregistrement, date_paiement, bucque, matricule, nom, prenom, telephone, email, civilite, ref_equerre, gravure, ref_chaine, livraison_nom, livraison_adresse1, livraison_adresse2, livraison_cp, livraison_ville, livraison_lieu, prix_eqr, prix_chn, prix_livr, frais_dossier, prix_total, commentaires
                          FROM commandes
                          WHERE id = ?');
$cmd_stmt->bind_param('d', $id_commande);
$cmd_stmt->execute();
$cmd_stmt->bind_result($GLOBALS['id'], $GLOBALS['payee'], $GLOBALS['date_enregistrement'], $GLOBALS['date_paiement'], $GLOBALS['info_bucque'], $GLOBALS['info_matricule'], $GLOBALS['info_nom'], $GLOBALS['info_prenom'], $GLOBALS['info_telephone'], $GLOBALS['info_mail'], $GLOBALS['pg'], $GLOBALS['eqr_ref'], $GLOBALS['gravure'], $GLOBALS['chn_ref'], $GLOBALS['livr_nom'], $GLOBALS['livr_add1'], $GLOBALS['livr_add2'], $GLOBALS['livr_cp'], $GLOBALS['livr_ville'], $GLOBALS['livr_lieu'], $GLOBALS['eqr_prix'], $GLOBALS['chn_prix'], $GLOBALS['livr_prix'], $GLOBALS['frais_dossier'], $GLOBALS['prix_total'], $GLOBALS['commentaires']);

if(!$cmd_stmt->fetch())
{
    echo 'Pas de commande id ' . $id_commande;
    exit;
}
$cmd_stmt->close();

if(!empty($GLOBALS['eqr_ref']))
{
	$eqr_stmt = $db->prepare("SELECT CONCAT(metal, ' - ', epaisseur, ' - ', IF(gravure, 'Avec gravure', 'Sans gravure'), ' - ', IF(encoche, 'Avec encoche', 'Sans encoche')) FROM equerres WHERE ref = ?");
	$eqr_stmt->bind_param('s', $GLOBALS['eqr_ref']);
	$eqr_stmt->execute();
	$eqr_stmt->bind_result($GLOBALS['eqr_str']);

	if(!$eqr_stmt->fetch())
	{
		echo 'Pas d\'équerre ref. ' . $GLOBALS['eqr_ref'];
	}
	$eqr_stmt->close();
}
else
{
	$GLOBALS['eqr_str'] = '';
	$GLOBALS['eqr_ref'] = '';
}

if(!empty($GLOBALS['chn_ref']))
{
	$chn_stmt = $db->prepare("SELECT CONCAT(metal, ' - ', longueur, ' - ', type, ' - ', masse_or) FROM chaines WHERE ref = ?");
	$chn_stmt->bind_param('s', $GLOBALS['chn_ref']);
	$chn_stmt->execute();
	$chn_stmt->bind_result($GLOBALS['chn_str']);

	if(!$chn_stmt->fetch())
	{
		echo 'Pas d\'équerre ref. ' . $GLOBALS['chn_ref'];
	}
	$chn_stmt->close();
}
else
{
	$GLOBALS['chn_str'] = '';
	$GLOBALS['chn_ref'] = '';
}

$GLOBALS['gravure'] = unserialize($GLOBALS['gravure']);

require('fpdf.php');
require('fpdf.memimage.php');

if (!isset($GLOBALS['gravure']['grv_alignementA']))
{
	$GLOBALS['gravure']['grv_alignementA'] ="";
	$GLOBALS['gravure']['grv_alignementB'] ="";
	$GLOBALS['gravure']['grv_alignementC'] ="";
	$GLOBALS['gravure']['grv_alignementD'] ="";
}

class PDF extends PDF_MemImage
{
	
	function Header()
{
    // Select Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Framed title
    $this->Cell(90,10,utf8_decode('BON DE COMMANDE N° ' . str_pad($GLOBALS['id'], 6, '0', STR_PAD_LEFT)),1,0,'C');
    // Line break
    $this->Ln(0);
}
	function ImprovedTable($data,$largeur,$décalage)
	{
		
		// Largeurs des colonnes
		$w = $largeur;
		
		// Données
		$this->Cell($décalage);
		$this->Cell($w,0,'','T');
		$this->Ln();
		foreach($data as $row)
		{
			$this->Cell($décalage);
			$this->Cell($w,5,$row,'LR',0);
			$this->Ln();
		}
		// Trait de terminaison
		$this->Cell($décalage);
		$this->Cell($w,0,'','T');
	}
	
	function BiTable($data,$largeur,$décalage,$header )
	{
		$x = $this->GetX();
		// Largeurs des colonnes
    	$w = $largeur;
		// En-tête
		$this->SetFont('Arial','B',8);
		$this->Cell($décalage);
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln();
		$this->SetX($x);
		for($i=0;$i<count($header);$i++)
			$this->Cell($décalage);
		$this->Cell(array_sum($w),4,$header,'LR',0,'L');
		$this->Ln();
		$this->SetX($x);
		// Données
		$this->SetFont('Arial','',8);
		foreach($data as $row)
		{
			$this->Cell($décalage);
			$this->Cell($w[0],5,@$row[0],'L');
			$this->Cell($w[1],5,@$row[1],'');
			$this->Cell($w[2],5,@$row[2],'');
			$this->Cell($w[3],5,@$row[3],'R');
			$this->Ln();
			$this->SetX($x);
		}
		// Trait de terminaison
		$this->Cell($décalage);
		$this->Cell(array_sum($w),0,'','T');
	}
	
	function BiTableImage($img1, $img2,$largeur,$décalage,$header )
	{
		
		// Largeurs des colonnes
    	$w = $largeur;
		// En-tête
		$this->SetFont('Arial','B',8);
		$this->Cell($décalage);
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln();

		for($i=0;$i<count($header);$i++)
			$this->Cell($décalage);
		$this->Cell(array_sum($w),4,$header,'LR',0,'L');
		$this->Ln();
		// Données
		$this->SetFont('Arial','',8);
		$this->Cell($décalage);
		$this->Cell($w[0], 40, $this->GDImage($img1, $this->GetX(), $this->GetY(), 50), 'L');
		$this->Cell($w[1], 40, $this->GDImage($img2, $this->GetX(), $this->GetY(), 50), 'R');
		//$this->Ln();
		
		// Trait de terminaison
		$this->Cell($décalage);
		$this->Cell(array_sum($w),0,'','T');
	}
    
	function gravehead($data,$largeur,$décalage,$header )
	{
		// Largeurs des colonnes
    	$w = $largeur;
		// En-tête
		$this->SetFont('Arial','B',8);
		$this->Cell($décalage);
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln();
		for($i=0;$i<count($header);$i++)
			$this->Cell($décalage);
			$this->Cell(array_sum($w),7,$header,'LR',0,'L');
		$this->Ln();
		// Données
		$this->SetFont('Arial','',8);
		foreach($data as $row)
		{
			$this->Cell($décalage);
			$this->Cell($w[0],5,$row[0],'L');
			$this->Cell($w[1],5,$row[1],'');
			$this->Cell($w[2],5,$row[2],'');
			$this->Cell($w[3],5,$row[3],'R');
			$this->Ln();
		}
		
	}
	function gravebody($data,$largeur,$décalage,$header)
	{
		// Largeurs de la première colonne
		$w = $largeur;
		//tête branche
		$this->SetFont('Arial','',8);
		$this->SetLineWidth(0.64);
		foreach($header as $rox)
		{
			$this->Cell($décalage);
			$this->Cell($w,4,$rox[0],'L');
			$this->Cell((186-$w),4,$rox[1],'R');
		$this->Ln();
		}
		$this->Cell($décalage);
		$this->SetLineWidth(0.2);
		$this->Cell(186,5,'','T');
		$this->Ln(0);
		//contenu branche
		$this->SetFont('Arial','',8);
		foreach($data as $row)
		{
			$this->Cell($décalage);
			$this->SetLineWidth(0.64);
			$this->Cell($w,4,$row[0],'L');
			
			$this->SetLineWidth(0.2);
			$this->Ln(0);
			$this->Cell($décalage);
			$this->Cell($w,5,'','T');
			$this->Cell((186-$w)/10,4,$row[1],'LR');
			$this->Cell((186-$w)/10,4,$row[2],'R');
			$this->Cell((186-$w)/10,4,$row[3],'R');
			$this->Cell((186-$w)/10,4,$row[4],'R');
			$this->Cell((186-$w)/10,4,$row[5],'R');
			$this->Cell((186-$w)/10,4,$row[6],'R');
			$this->Cell((186-$w)/10,4,$row[7],'R');
			$this->Cell((186-$w)/10,4,$row[8],'R');
			$this->Cell((186-$w)/10,4,$row[9],'R');
			$this->SetLineWidth(0.64);
			$this->Cell((186-$w)/10,4,$row[10],'R');
			
			$this->Ln();
		}
		$this->SetLineWidth(0.2);
		$this->Ln(0);
			$this->Cell($décalage);
			$this->Cell(186,5,'','T');
			$this->Ln(0);
	}
	
}

$pdf = new PDF('P','mm','A4');
$pdf->SetMargins(5, 5);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetLineWidth(0.64);
$pdf->Image('../img/logocvis.png',5,5);


define('NO_OUTPUT', 1);

/* branches AB */
$_SESSION['eqr_ref'] = $GLOBALS['eqr_ref'];
$_SESSION['gravure'] = $GLOBALS['gravure'];
include 'gravure_preview_AB.php';
$img_branche_AB = $eqr;
session_destroy();

/* branches CD */
$_SESSION['eqr_ref'] = $GLOBALS['eqr_ref'];
$_SESSION['gravure'] = $GLOBALS['gravure'];
include 'gravure_preview_CD.php';
$img_branche_CD = $eqr;
session_destroy();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(70);
$pdf->Cell(1,32,'');
$pdf->Ln(6);
$pdf->Cell(74);
$pdf->Cell(40,33,'MICRO EQUERRE');

$lettres = array('A','B','C','D');
foreach($lettres as $i)
{
	$branche[$i]['Car'][0] = utf8_decode('Caractère');
	$branche[$i]['minmaj'][0] = utf8_decode('Min/Maj');
	$branche[$i]['police'][0] = utf8_decode('Police');
	$branche[$i]['position'][0] = utf8_decode('Position');
	for ($j=1;$j<=10;$j++)
	{
		if (isset($GLOBALS['gravure'][$i.$j]['lettre']))	{$branche[$i]['Car'][$j] = ($GLOBALS['gravure'][$i.$j]['lettre'].' '.$GLOBALS['gravure'][$i.$j]['Accent']);}
		else {$branche[$i]['Car'][$j] ="/";}
		
		if (isset($GLOBALS['gravure'][$i.$j]['minmaj']))	{$branche[$i]['minmaj'][$j] =$GLOBALS['gravure'][$i.$j]['minmaj'];}
		else {$branche[$i]['minmaj'][$j] ="/";}
		
		if (isset($GLOBALS['gravure'][$i.$j]['police']))	{$branche[$i]['police'][$j] =utf8_decode($GLOBALS['gravure'][$i.$j]['police']);}
		else {$branche[$i]['police'][$j] ="/";}
		
		if (isset($GLOBALS['gravure'][$i.$j]['position']))	{$branche[$i]['position'][$j] =utf8_decode($GLOBALS['gravure'][$i.$j]['position']);}
		else {$branche[$i]['position'][$j] ="/";}
	}
}



$pdf->SetFont('Arial','',8);
$pdf->Ln(5);
$pdf->ImprovedTable(array(utf8_decode('UE ENSAM Service - micro équerres'),utf8_decode('1 avenue Pierre Massé'),'75014 PARIS'),64,123);
$pdf->Ln(5);
$pdf->BiTable(array(array($GLOBALS['pg'],' ', 'Bucque :', utf8_decode($GLOBALS['info_bucque'])),array('Nom : ',  utf8_decode($GLOBALS['info_nom']),'Num\'s :', utf8_decode($GLOBALS['info_matricule'])),array('Prenom : ',  utf8_decode($GLOBALS['info_prenom']),'Mail :',  $GLOBALS['info_mail']),array(utf8_decode('Téléphone : '), $GLOBALS['info_telephone'],'Frais de Dossier :' , number_format($GLOBALS['frais_dossier'],2,',',' ').chr(128))),array(20,73, 25,68),1, 'Renseignements personnels');
$pdf->Ln(1);
$pdf->gravehead(array(array('Type :',$GLOBALS['eqr_str'],'',''),array('Ref :', $GLOBALS['eqr_ref'],'Prix :', $GLOBALS['eqr_prix'].',00'.chr(128))),array(20,73, 25,68),1, 'Equerre');

$pdf->gravebody(array($branche['A']['Car'],$branche['A']['minmaj'],$branche['A']['police'],$branche['A']['position']),20,1,array(array('',''),array('Branche Face A',''),array('Centrage : ',utf8_decode($GLOBALS['gravure']['grv_alignementA']))));
$pdf->gravebody(array($branche['B']['Car'],$branche['B']['minmaj'],$branche['B']['police'],$branche['B']['position']),20,1,array(array('',''),array('Branche Face B',''),array('Centrage : ',utf8_decode($GLOBALS['gravure']['grv_alignementB']))));
$pdf->gravebody(array($branche['C']['Car'],$branche['C']['minmaj'],$branche['C']['police'],$branche['C']['position']),20,1,array(array('',''),array('Branche Face C',''),array('Centrage : ',utf8_decode($GLOBALS['gravure']['grv_alignementC']))));
$pdf->gravebody(array($branche['D']['Car'],$branche['D']['minmaj'],$branche['D']['police'],$branche['D']['position']),20,1,array(array('',''),array('Branche Face D',''),array('Centrage : ',utf8_decode($GLOBALS['gravure']['grv_alignementD']))));
$pdf->cell(1);
$pdf->SetLineWidth(0.64);
$pdf->Cell(186,0,'','T');
$pdf->Ln(1);
$pdf->BiTable(array(array('Type : ', $GLOBALS['chn_str'],'', ''),array('Ref : ',  $GLOBALS['chn_ref'],'Prix :',  $GLOBALS['chn_prix'].',00'.chr(128))),array(20,73, 25,68),1, utf8_decode('Chaîne'));
$pdf->Ln(1);

//$pdf->BiTableImage($img_branche_AB, $img_branche_CD,array(50, 50),1, utf8_decode('Aperçu gravure'));


if ($GLOBALS['livr_lieu']== "Domicile")
{
	$pdf->BiTable(array(array('', ''), array('Lieux : ', utf8_decode($GLOBALS['livr_nom'])),array('',  utf8_decode($GLOBALS['livr_add1'])),array('',  utf8_decode($GLOBALS['livr_add2'])),array('',  utf8_decode($GLOBALS['livr_cp']. " ".$GLOBALS['livr_ville'])),array('', 'Frais de Livraison : ' .  $GLOBALS['livr_prix'].',00'.chr(128)), array('', '')),array(10,73,1,1),1, utf8_decode('Livraison'));
}
else
{
	$pdf->BiTable(array(array('', ''), array('Lieux : ', utf8_decode('Résid\'s P3')),array('',  utf8_decode($GLOBALS['livr_add1'])),array('',  utf8_decode($GLOBALS['livr_add2'])),array('',  utf8_decode($GLOBALS['livr_cp']. " ".$GLOBALS['livr_ville'])),array('', 'Frais de Livraison : ' .  $GLOBALS['livr_prix'].',00'.chr(128)), array('', '')),array(10,73, 1, 1),1, utf8_decode('Livraison'));
}
$pdf->Ln(1);

//$pdf->BiTable(array(array('Banque :', $_POST['banque'],'', ''),array(utf8_decode($_POST['pmt_type'].' n° :'), $_POST['pmt_nbr'],'Prix total : ',  utf8_decode($GLOBALS['total_prix'].',00').chr(128))),array(20,73, 25,68),1, utf8_decode('Paiement'));
$dkl = 0;
foreach(range('A','D') as $lettre)
{
	for($i =1; $i<=10; $i++)
	{
		$bidule = ($lettre.$i);
		
		if (isset($GLOBALS['gravure'][$bidule]) && !empty($GLOBALS['gravure'][$bidule]['minmaj']) && !empty($GLOBALS['gravure'][$bidule]['police']) && isset($GLOBALS['gravure'][$bidule]['lettre']) && $GLOBALS['gravure'][$bidule]['lettre'] !== '')
		{
			if ($GLOBALS['gravure'][$bidule]['minmaj']=="Min")
			{
				$pdf->Image(('../img/'.$GLOBALS['gravure'][$bidule]['police'].'/'.$GLOBALS['gravure'][$bidule]['lettre'].$GLOBALS['gravure'][$bidule]['lettre'].'.png'),64+ $i*8,80+$dkl);
			}
			else 
			{
			
				$pdf->Image(('../img/'.$GLOBALS['gravure'][$bidule]['police'].'/'.$GLOBALS['gravure'][$bidule]['lettre'].'.png'),64+ $i*8,80+$dkl);
			}
		}
		else
		{
			$pdf->Image('../img/vide.png',64+ $i*8,80+$dkl);
		}
	}
	$dkl = $dkl + 28;
}
$pdf->Cell(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(186,5,'Commentaire','LRT');
$pdf->Ln();
$pdf->Cell(1);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(186,5,utf8_decode(preg_replace('/[\r\n]/', ' ', $GLOBALS['commentaires'])),'LRB');

$pdf->Ln(1);
$pdf->Cell(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(92,5,'Paiement','LRT');
$pdf->Ln();
$pdf->Cell(1);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(92,5,utf8_decode(($GLOBALS['payee']) ? ('Paiement de ' . number_format($GLOBALS['prix_total'], 2, ',', ' ') . ' Euros reçu le ' . $GLOBALS['date_paiement']) : ('Non payé')), 'LRB');


date_default_timezone_set('Europe/Paris');
$now = date("d/m/Y");
$pdf->Ln(-10);
$pdf->Cell(94);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,5,'Date :','');
$pdf->Cell(90,5,$now,'');
$pdf->Ln();
$pdf->Cell(94);
$pdf->Cell(90,5,'Signature :','');

// a la toute fin, on ajoute les images des gravures
$pdf->SetXY(92,206);
$pdf->BiTable(array(array('', ''),array('',  ''),array('',  ''),array('',  ''),array('', ''),array('', ''),array('', '')),array(20,77,1,1),1, utf8_decode('Aperçu gravure'));

$pdf->GDImage($img_branche_AB, 94, 206, 47);
$pdf->GDImage($img_branche_CD, 94+47+1, 206, 47);

if(isset($_GET['output']))
	$pdf->Output();
else
{
	$bon_de_commande_fichier = str_pad($GLOBALS['id'],6,"0",STR_PAD_LEFT) . '_' . date('YmdHis') . '.pdf';
	$bon_de_commande = './gen_pdf/' . $bon_de_commande_fichier;
	$pdf->Output('F', $bon_de_commande);
}
?>