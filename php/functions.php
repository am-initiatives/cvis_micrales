<?php
function getPrixEquerre()
{
    global $db;
    
    if(!empty($_SESSION['eqr_ref']))
    {
        $eqr_stmt = $db->prepare("SELECT prix FROM equerres WHERE ref = ?");
        $eqr_stmt->bind_param('s', $_SESSION['eqr_ref']);
        $eqr_stmt->execute();
        $eqr_stmt->bind_result($prix_eqr);
        $eqr_stmt->fetch();
        $eqr_stmt->close();
        return max($prix_eqr, 0);
    }
    else
    {
        return 0;
    }
}

function getPrixChaine()
{
    global $db;
    
    if(!empty($_SESSION['chn_ref']))
    {
        $chn_stmt = $db->prepare("SELECT prix FROM chaines WHERE ref = ?");
        $chn_stmt->bind_param('s', $_SESSION['chn_ref']);
        $chn_stmt->execute();
        $chn_stmt->bind_result($prix_chn);
        $chn_stmt->fetch();
        $chn_stmt->close();
        return max($prix_chn, 0);
    }
    else
    {
        return 0;
    }
}

function getPrixLivraison()
{
    if(isset($_SESSION['livr_lieu']) && $_SESSION['livr_lieu'] == 'Resid\'s P3' && empty($_SESSION['livr_nom']) && empty($_SESSION['livr_add1']) && empty($_SESSION['livr_add2']) && empty($_SESSION['livr_cp']) && empty($_SESSION['livr_ville']))
    {
        return 0;
    }
    else
    {
        return 12.0;
    }
}

function getFraisDossier()
{
    return 2.5;
}

function getDescriptionEquerre()
{
    if(!empty($_SESSION['eqr_ref']))
    {
        global $db;
    
        $eqr_stmt = $db->prepare("SELECT CONCAT(metal, ' - ', epaisseur, ' - ', IF(gravure, 'Avec gravure', 'Sans gravure'), ' - ', IF(encoche, 'Avec encoche', 'Sans encoche')) FROM equerres WHERE ref = ?");
        $eqr_stmt->bind_param('s', $_SESSION['eqr_ref']);
        $eqr_stmt->execute();
        $eqr_stmt->bind_result($eqr);
        $eqr_stmt->fetch();
        $eqr_stmt->close();
        return $eqr;
    }
    else
    {
        return '';
    }
}

function getDescriptionChaine()
{
    global $db;
    
    if(!empty($_SESSION['chn_ref']))
    {
        $eqr_stmt = $db->prepare("SELECT CONCAT(metal, ' - ', longueur, ' - ', type, ' - ', masse_or) FROM chaines WHERE ref = ?");
        $eqr_stmt->bind_param('s', $_SESSION['chn_ref']);
        $eqr_stmt->execute();
        $eqr_stmt->bind_result($chn);
        $eqr_stmt->fetch();
        $eqr_stmt->close();
        return $chn;
    }
    else
    {
        return '';
    }
}

// Backwards compatiblity
if (!function_exists('imagepalettetotruecolor')) {
    function imagepalettetotruecolor(&$src) {
        if (imageistruecolor($src)) {
            return true;
        }

        $dst = imagecreatetruecolor(imagesx($src), imagesy($src));
       
        imagealphablending($dst, false);//prevent blending with default black
        $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);//change the RGB values if you need, but leave alpha at 127
        imagefilledrectangle($dst, 0, 0, imagesx($src), imagesy($src), $transparent);//simpler than flood fill
        imagealphablending($dst, true);//restore default blending

        imagecopy($dst, $src, 0, 0, 0, 0, imagesx($src), imagesy($src));
        imagedestroy($src);

        $src = $dst;
        return true;
    }
}