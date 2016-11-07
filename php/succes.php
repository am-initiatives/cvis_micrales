<?php
session_start();

require 'config.php';
require_once 'functions.php';

if(!isset($_GET['id'])) exit;

?>
<!DOCTYPE html>
<html lang="fr">
<head>

         <?php include("includes/meta.php"); ?>
        <link rel="stylesheet" href="../css/style.css" />
        <title>Paiement</title>
		
 </head>
<body>
<div class="container theme-showcase">
	<div class="page-header">
		<h1>Paiement</h1>
	</div>
<form action="pdf_eqr.php" method="post">
<div class='row'>
	<div class="col-md-8">
		<table class="table table-condensed">
			<tbody>
                <tr>
					<td colspan='2'>
                        <h2><div id="verifCommande">Vérification du paiement en cours...</div></h2>
					</td>
				</tr>
                <tr>
                    <td colspan='2'>
                        <div id="commandeOK">&nbsp;</div>
                    </td>
				</tr>
            </tbody>
		</table>
	</div>
</div>


</form>
</div>
</div>
</body>

<script src="../js/pmt_java.js"></script>
<script type="text/javascript" src="../js/oXHR.js"></script>
<?php include("includes/script.php"); ?>
<script type="text/javascript">
$(document).ready(function()
{
    setInterval(checkPaiment, 2000);
}
);
var tnt = 0;
function checkPaiment()
{
    $.getJSON( "verif_paiement.php?id=<?php echo intval($_GET['id']); ?>", function( data ) {
      if(data['ok'])
      {
          $("#verifCommande").text("Ton paiement de " + number_format(data["prix_total"], 2, ',', ' ') + " € a bien été reçu le " + data["date"]);
          $("#commandeOK").html("Ton bon de commande a bien été envoyé au C-vis.<br /><br />Tu vas recevoir un exemplaire de ton bon de commande par email.<br />Si tu te rends compte d'une erreur dans celui-ci, contacte le C-vis UE au plus vite.<br /><br />Z'mer's !<br />");
          tnt = 999;
      }
      else
      {
          tnt++;
      }
    });
}
function number_format (number, decimals, decPoint, thousandsSep) { // eslint-disable-line camelcase

  number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
  var n = !isFinite(+number) ? 0 : +number
  var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
  var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
  var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
  var s = ''

  var toFixedFix = function (n, prec) {
    var k = Math.pow(10, prec)
    return '' + (Math.round(n * k) / k)
      .toFixed(prec)
  }

  // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || ''
    s[1] += new Array(prec - s[1].length + 1).join('0')
  }

  return s.join(dec)
}
</script>
</html>