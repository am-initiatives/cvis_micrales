<?php
require_once 'functions.php';

if(isset($_SESSION)) $tmp = $_SESSION;
session_start();
if(isset($tmp)) $_SESSION = $tmp;
require 'config.php';

if(!isset($_SESSION['gravure'])) $_SESSION['gravure'] = array();
if(!isset($_SESSION['eqr_ref']) || !isset($_SESSION['gravure'])) exit;
/* vérification préléminaire de tous les caractères (pour pas aller chercher des fichiers n'importe où) */
for($k=1; $k<=10; $k++)
{
    if(isset($_SESSION['gravure']['C' . $k]))
    {
        if(!empty($_SESSION['gravure']['C' . $k]['lettre']) && !in_array(strtolower($_SESSION['gravure']['C' . $k]['lettre']), array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'am', 'apo', 'cl', 'deg', 'dollard', 'eperluet', 'euro', 'int', 'par_d', 'par_g', 'plus', 'point', 'point_ex', 'slash_d', 'slash_g', 'tiret', 'yuan', 'za', 'zt')))
            exit;
        
        if(!empty($_SESSION['gravure']['C' . $k]['police']) && !in_array(strtolower($_SESSION['gravure']['C' . $k]['police']), array('baton', 'cluns', 'gothique', 'grec', 'old', 'spe')))
            exit;
    }
    
    if(isset($_SESSION['gravure']['D' . $k]))
    {
        if(!empty($_SESSION['gravure']['D' . $k]['lettre']) && !in_array(strtolower($_SESSION['gravure']['D' . $k]['lettre']), array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'am', 'apo', 'cl', 'deg', 'dollard', 'eperluet', 'euro', 'int', 'par_d', 'par_g', 'plus', 'point', 'point_ex', 'slash_d', 'slash_g', 'tiret', 'yuan', 'za', 'zt')))
            exit;
        
        if(!empty($_SESSION['gravure']['D' . $k]['police']) && !in_array(strtolower($_SESSION['gravure']['D' . $k]['police']), array('baton', 'cluns', 'gothique', 'grec', 'old', 'spe')))
            exit;
    }
}

/* encoche sur l'équerre sélectionnée ? */
$encoche = false;
$eqr_stmt = $db->prepare('SELECT encoche FROM equerres WHERE ref = ?');
$eqr_stmt->bind_param('s', $_SESSION['eqr_ref']);
$eqr_stmt->execute();
$eqr_stmt->bind_result($encoche);
$eqr_stmt->fetch();
$eqr_stmt->close();

if(!defined('NO_OUTPUT')) header('Content-type: image/png');
$eqr = imagecreatefrompng('../img/shema_eqr_' . ($encoche ? 'avec' : 'sans') . '_encoche.png');

/* branche C */
/*************/
$branche_C = imagecreate(250, 55);

$x_offset = 0;
$total_w = 0;
/* on détermine le nombre de lettres total */
$nb_lettres = 10;
for($k = 10; $k >= 1; $k--)
{
    if(!isset($_SESSION['gravure']['C' . $k]) || empty($_SESSION['gravure']['C' . $k]['lettre']) || empty($_SESSION['gravure']['C' . $k]['police']))
        $nb_lettres--;
    else
        break;
}

for($i = 1; $i <= $nb_lettres; $i++)
{
    if(!isset($_SESSION['gravure']['C' . $i]) || empty($_SESSION['gravure']['C' . $i]['lettre']) || empty($_SESSION['gravure']['C' . $i]['police'])) {
        // espace
        $x_offset += 20;
        $total_w += 20;
        continue;
    }
    $caractere = $_SESSION['gravure']['C' . $i];
    $lettre = $caractere['lettre'];
    $minmaj = $caractere['minmaj'];
    $police = $caractere['police'];
    $accent = trim($caractere['Accent']);
    $position = $caractere['position'];
    
    if($accent)
    {
        $img_accent = imagecreatefrompng('../img/' . $police . '/' . $accent . '.png');
    }
    
    if($police != 'Spe' && ($lettre < '0' || $lettre > '9'))
    {
        if($minmaj == 'Maj')
            $img_lettre = imagecreatefrompng('../img/' . $police . '/' . $lettre . '.png');
        else
            $img_lettre = imagecreatefrompng('../img/' . $police . '/' . $lettre . $lettre . '.png');
    }
    else
    {
        $img_lettre = imagecreatefrompng('../img/' . $police . '/' . $lettre . '.png');
    }
    
    
    imagetruecolortopalette($img_lettre,false, 255);
    if($accent) imagetruecolortopalette($img_accent,false, 255);
    for($j = 0; $j <= 10; $j++)
    {
        $index = imagecolorclosest ( $img_lettre,  255 - $j,255 - $j,255 - $j ); // get White COlor
        imagecolorset($img_lettre,$index,194,194,194,127); // SET NEW COLOR
        imagefill($img_lettre, 0, 0, imagecolorallocatealpha($img_lettre, 194, 194, 194, 127));
        
        if($accent)
        {
            $index = imagecolorclosest ( $img_accent,  255 - $j,255 - $j,255 - $j ); // get White COlor
            imagecolorset($img_accent,$index,194,194,194,127); // SET NEW COLOR
            imagefill($img_accent, 0, 0, imagecolorallocatealpha($img_accent, 194, 194, 194, 127));
        }
    }
    
    imagesavealpha($img_lettre, true);
    if($accent) imagesavealpha($img_accent, true);
    
    $lettre_w = imagesx($img_lettre);
    $lettre_h = imagesy($img_lettre);
    
    if($accent)
    {
        $acc_w = imagesx($img_accent);
        $acc_h = imagesy($img_accent);
    }
    
    if($position == 'Exposant')
    {
        $new_w = $lettre_w * 0.6;
        $new_h = $lettre_h * 0.6;
        $pos_y = 0;
        if($accent)
        {
            $acc_new_w = $acc_w * 0.6;
            $acc_new_h = $acc_h * 0.6;
        }
    }
    elseif($position == 'Indice')
    {
        $new_w = $lettre_w * 0.6;
        $new_h = $lettre_h * 0.6;
        $pos_y = 55 - ceil($new_h);
        if($accent)
        {
            $acc_new_w = $acc_w * 0.6;
            $acc_new_h = $acc_h * 0.6;
        }
    }
    else
    {
        $new_w = $lettre_w * 0.8;
        $new_h = $lettre_h * 0.8;
        $pos_y = (55 - $new_h) / 2;
        if($accent)
        {
            $acc_new_w = $acc_w * 1;
            $acc_new_h = $acc_h * 1;
        }
    }
    
    imagecopyresampled($branche_C, $img_lettre, $x_offset, $pos_y, 0, 0, $new_w, $new_h, $lettre_w, $lettre_h); 
    if($accent) imagecopyresampled($branche_C, $img_accent, $x_offset + ($new_w - $acc_new_w) / 2, $pos_y + 3, 0, 0, $acc_new_w, $acc_new_h, $acc_w, $acc_h);
    $x_offset += $new_w + 2;
    $total_w += $new_w + 2;
}



$base_x = 10;
$base_y = 100;
$offset = 0;

if(isset($_SESSION['gravure']['grv_alignementC']))
{
    switch($_SESSION['gravure']['grv_alignementC'])
    {
        case 'Centré': 
            $offset = (210 - $total_w) / 2;
            break;
        case 'Droite': 
            $offset = (230 - $total_w);
            break;
        default:
            $offset = 0;
            break;
    }
}
$branche_C_x = $base_x + 0.7071 * $offset;
$branche_C_y = $base_y - 0.7071 * $offset;


imagefill($branche_C, 0, 0, imagecolorallocatealpha($branche_C, 255, 255, 255, 127));
imagepalettetotruecolor($branche_C);
$branche_C = imagerotate($branche_C, 45, imagecolorallocatealpha($branche_C, 255, 255, 255, 127), -1);
imagefill($branche_C, 0, 0, imagecolorallocatealpha($branche_C, 255, 255, 255, 127));

imagecopyresampled($eqr, $branche_C, $branche_C_x, $branche_C_y, 0, 0, imagesx($branche_C), imagesy($branche_C), imagesx($branche_C), imagesy($branche_C));





/*************/

/* branche D */
/*************/
$branche_D = imagecreate(250, 55);

$x_offset = imagesx($branche_D);
$total_w = 0;

/* on détermine le nombre de lettres total */
$nb_lettres = 10;
for($k = 10; $k >= 1; $k--)
{
    if(!isset($_SESSION['gravure']['D' . $k]) || empty($_SESSION['gravure']['D' . $k]['lettre']) || empty($_SESSION['gravure']['D' . $k]['police']))
        $nb_lettres--;
    else
        break;
}
for($i = $nb_lettres; $i >= 1; $i--)
{
    if(!isset($_SESSION['gravure']['D' . $i]) || empty($_SESSION['gravure']['D' . $i]['lettre']) || empty($_SESSION['gravure']['D' . $i]['police'])) {
        $x_offset -= 20;
        $total_w += 20;
        continue;
    }
    $caractere = $_SESSION['gravure']['D' . $i];
    $lettre = $caractere['lettre'];
    $minmaj = $caractere['minmaj'];
    $police = $caractere['police'];
    $accent = trim($caractere['Accent']);
    $position = $caractere['position'];
    
    if($accent)
    {
        $img_accent = imagecreatefrompng('../img/' . $police . '/' . $accent . '.png');
    }
    
    if($police != 'Spe' && ($lettre < '0' || $lettre > '9'))
    {
        if($minmaj == 'Maj')
            $img_lettre = imagecreatefrompng('../img/' . $police . '/' . $lettre . '.png');
        else
            $img_lettre = imagecreatefrompng('../img/' . $police . '/' . $lettre . $lettre . '.png');
    }
    else
    {
        $img_lettre = imagecreatefrompng('../img/' . $police . '/' . $lettre . '.png');
    }
    
    
    imagetruecolortopalette($img_lettre,false, 255);
    if($accent) imagetruecolortopalette($img_accent,false, 255);
    for($j = 0; $j <= 10; $j++)
    {
        $index = imagecolorclosest ( $img_lettre,  255 - $j,255 - $j,255 - $j ); // get White COlor
        imagecolorset($img_lettre,$index,194,194,194,127); // SET NEW COLOR
        imagefill($img_lettre, 0, 0, imagecolorallocatealpha($img_lettre, 194, 194, 194, 127));
        
        if($accent)
        {
            $index = imagecolorclosest ( $img_accent,  255 - $j,255 - $j,255 - $j ); // get White COlor
            imagecolorset($img_accent,$index,194,194,194,127); // SET NEW COLOR
            imagefill($img_accent, 0, 0, imagecolorallocatealpha($img_accent, 194, 194, 194, 127));
        }
    }
    
    imagesavealpha($img_lettre, true);
    if($accent) imagesavealpha($img_accent, true);
    
    $lettre_w = imagesx($img_lettre);
    $lettre_h = imagesy($img_lettre);
    
    if($accent)
    {
        $acc_w = imagesx($img_accent);
        $acc_h = imagesy($img_accent);
    }
    
    if($position == 'Exposant')
    {
        $new_w = $lettre_w * 0.6;
        $new_h = $lettre_h * 0.6;
        $pos_y = 0;
        if($accent)
        {
            $acc_new_w = $acc_w * 0.6;
            $acc_new_h = $acc_h * 0.6;
        }
    }
    elseif($position == 'Indice')
    {
        $new_w = $lettre_w * 0.6;
        $new_h = $lettre_h * 0.6;
        $pos_y = 55 - ceil($new_h);
        if($accent)
        {
            $acc_new_w = $acc_w * 0.6;
            $acc_new_h = $acc_h * 0.6;
        }
    }
    else
    {
        $new_w = $lettre_w * 0.8;
        $new_h = $lettre_h * 0.8;
        $pos_y = (55 - $new_h) / 2;
        if($accent)
        {
            $acc_new_w = $acc_w * 0.8;
            $acc_new_h = $acc_h * 0.8;
        }
    }
    $x_offset -= $new_w + 2;
    imagecopyresampled($branche_D, $img_lettre, $x_offset, $pos_y, 0, 0, $new_w, $new_h, $lettre_w, $lettre_h); 
    if($accent) imagecopyresampled($branche_D, $img_accent, $x_offset + ($new_w - $acc_new_w) / 2, $pos_y + 3, 0, 0, $acc_new_w, $acc_new_h, $acc_w, $acc_h);
    $total_w += $new_w + 2;
}



$base_x = 165;
$base_y = 85;
$offset = 30;

if(isset($_SESSION['gravure']['grv_alignementD']))
{
    switch($_SESSION['gravure']['grv_alignementD'])
    {
        case 'Centré': 
            $offset = - (175 - $total_w) / 2;
            break;
        case 'Gauche': 
            $offset = - (200 - $total_w);
            break;
        default:
            $offset = 30;
            break;
    }
}
$branche_D_x = $base_x + 0.7071 * $offset;
$branche_D_y = $base_y + 0.7071 * $offset;


imagefill($branche_D, 0, 0, imagecolorallocatealpha($branche_D, 255, 255, 255, 127));
imagepalettetotruecolor($branche_D);
$branche_D = imagerotate($branche_D, -45, imagecolorallocatealpha($branche_D, 255, 255, 255, 127), -1);
imagefill($branche_D, 0, 0, imagecolorallocatealpha($branche_D, 255, 255, 255, 127));

imagecopyresampled($eqr, $branche_D, $branche_D_x, $branche_D_y, 0, 0, imagesx($branche_D), imagesy($branche_D), imagesx($branche_D), imagesy($branche_D));

imagecolortransparent($eqr, imagecolorallocate($branche_D, 255, 255, 255));
if(!defined('NO_OUTPUT'))
{
	imagepng($eqr);
}
