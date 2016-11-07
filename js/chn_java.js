// var ref_chn = [["1","45cm","OR JAUNE","FORCAT","2,65","94","93721","375 °/°°","OJ-F-3.3.jpg"],
// ["2","45cm","OR BLANC","FORCAT","2,7","118","93722","375 °/°°","OB-F-3.7.jpg"],
// ["3","50cm","OR JAUNE","FORCAT","3,3","112","90610","375 °/°°","OJ-F-3.3.jpg"],
// ["4","50cm","OR JAUNE","FORCAT","4","131","90611","375 °/°°","OJ-F-3.3.jpg"],
// ["5","50cm","OR BLANC","FORCAT","3","125","90615","375 °/°°","OB-F-1.45.jpg"],
// ["6","50cm","OR BLANC","FORCAT","3,6","151","93724","375 °/°°","OB-F-3.7.jpg"],
// ["7","45cm","OR JAUNE","GOURMETTE","2,9","103","93717","375 °/°°","OJ-G.jpg"],
// ["8","45cm","OR BLANC","GOURMETTE","2,5","107","93716","375 °/°°","OB-G.jpg"],
// ["9","50cm","OR JAUNE","GOURMETTE","3,6","128","90656","375 °/°°","OJ-G.jpg"],
// ["10","50cm","OR JAUNE","GOURMETTE","4,05","144","90616","375 °/°°","OJ-G.jpg"],
// ["11","50cm","OR BLANC","GOURMETTE","4,5","182","91899","375 °/°°","OB-G.jpg"],
// ["12","50cm","OR JAUNE","ALTERNEE 1+1","4,3","154","97215","375 °/°°","OJ-11.jpg"],
// ["13","50cm","OR BLANC","ALTERNEE 1+1","4,7","182","97219","375 °/°°","OB-11.jpg"],
// ["14","50cm","OR JAUNE","ALTERNEE 1+3","3,4","132","98701","375 °/°°","OJ-13.jpg"],
// ["15","50cm","OR BLANC","ALTERNEE 1+3","2,6","113","98697","375 °/°°","OB-13.jpg"],
// ["16","45cm","ARGENT","FORCAT","Pas d'or","31","3504","925 °/°°","A_F.jpg"],
// ["17","50cm","ARGENT","FORCAT","Pas d'or","34","3503","925 °/°°","A_F.jpg"],
// ["18","45cm","ARGENT","GOURMETTE","Pas d'or","42","3514","925 °/°°","A_G_2.jpg"],
// ["19","50cm","ARGENT","GOURMETTE","Fin","36","3513","925 °/°°","A_F.jpg"],
// ["20","50cm","ARGENT","GOURMETTE","Epais","47","3515","925 °/°°","A_G_2.jpg"],
// ["21","45cm","ARGENT","ALTERNEE 1+1","Pas d'or","32","3959","925 °/°°","A_11.jpg"],
// ["22","50cm","ARGENT","ALTERNEE 1+1","Pas d'or","38","10840","925 °/°°","A_11.jpg"],
// ["23","50cm","ARGENT","ALTERNEE 1+3","Fin","33","10379","925 °/°°","A_13.jpg"],
// ["24","50cm","ARGENT","ALTERNEE 1+3","Epais","45","3951","925 °/°°","A_13.jpg"]];

window.onload = function() { init() };
	var ref_chn = new Array(0);

  function init() {
    $.getJSON('get_chn.php', function(data) {
        for (var i = 0; i< data.length; i++){
            ref_chn[i] = Array(0);
            ["id","longueur","metal","type", "masse_or", "prix", "ref", "commentaire", "image"].forEach(function(item)
            {
                ref_chn[i].push ( data[i][item]);
                
            });
        }
    });
  }

  
function longueur_chg(oSelect){
	var value = oSelect.options[oSelect.selectedIndex].value;
	var temp = new Array(0);
	var k = 0;
	var checked = 0;
	for (var i = 0; i < ref_chn.length; i++) {
	if(value == ref_chn[i][1]){
		for (var j = 0; j < temp.length; j++) {
			if (temp[j]== ref_chn[i][2]){
				checked = 1;
			}
		}
		if (checked== 0) {
			temp[k]= ref_chn[i][2];
			k++;
		}
		checked =0;
	}
	
}
	oSelect = document.getElementById("metal");
	oSelect.innerHTML = "";
	for (var i=0; i<temp.length; i++) {
		oOption = document.createElement("option");
		oInner  = document.createTextNode(temp[i]);
		oOption.appendChild(oInner);
		oSelect.appendChild(oOption);
		
	}

	document.getElementById("type").innerHTML = "";
	document.getElementById("masse").innerHTML = "";
	document.getElementById("total").value = "";
}

function metal_chg(oSelect)
{
	document.getElementById("masse").innerHTML = "";
	document.getElementById("total").value = "";
	
	var longueur = document.getElementById("longueur").value;
	var value = oSelect.options[oSelect.selectedIndex].value;
	var temp = new Array(0);
	var k = 0;
	var checked = 0;
	for (var i = 0; i < ref_chn.length; i++) {
	if(value == ref_chn[i][2]&&longueur==ref_chn[i][1]){
		for (var j = 0; j < temp.length; j++) {
			if (temp[j]== ref_chn[i][3]){
				checked = 1;
			}
		}
		if (checked== 0) {
			temp[k]= ref_chn[i][3];
			k++;
		}
		checked =0;
	}
	}
	oSelect = document.getElementById("type");
	oSelect.innerHTML = "";
	for (var i=0; i<temp.length; i++) {
		oOption = document.createElement("option");
		oInner  = document.createTextNode(temp[i]);
		oOption.appendChild(oInner);
		oSelect.appendChild(oOption);
		
	}
type_chg(document.getElementById("type"))
}


function type_chg(oSelect)
{
	document.getElementById("total").value = "";
	
	var longueur = document.getElementById("longueur").value;
	var metal = document.getElementById("metal").value;
	var value = oSelect.options[oSelect.selectedIndex].value;
	var temp = new Array(0);
	var k = 0;
	var checked = 0;

	for (var i = 0; i < ref_chn.length; i++) {
	if(value == ref_chn[i][3]&&metal==ref_chn[i][2]&&longueur==ref_chn[i][1]){	
		for (var j = 0; j < temp.length; j++) {
			if (temp[j]== ref_chn[i][4]){
				checked = 1;
			}
		}
		if (checked== 0) {
			temp[k]= ref_chn[i][4];
			k++;
		}
		checked =0;
	}
	
}

	oSelect = document.getElementById("masse");
	oSelect.innerHTML = "";
	for (var i=0; i<temp.length; i++) {
		oOption = document.createElement("option");
		oInner  = document.createTextNode(temp[i]);
		oOption.appendChild(oInner);
		oSelect.appendChild(oOption);
		
	}
    masse_chg(document.getElementById("masse"))
}
function masse_chg(oSelect)
{
	var longueur = document.getElementById("longueur").value;
	var metal = document.getElementById("metal").value;
	var type = document.getElementById("type").value;
	var value = oSelect.options[oSelect.selectedIndex].value;
	var temp = new Array(0);
	var k = 0;
	var checked = 0;
	
   for (var i = 0; i < ref_chn.length; i++) {
	if(value == ref_chn[i][4]&&metal==ref_chn[i][2]&&longueur==ref_chn[i][1]&&type==ref_chn[i][3]){	
		
			document.getElementById("total").innerHTML = "";
			document.getElementById("total").value = ref_chn[i][5] + ",00€";
			document.getElementById("chn_prix").value = ref_chn[i][5];
			document.getElementById("chn_ref").value = ref_chn[i][6];
			document.getElementById("img_chn").style.visibility = "visible";
			document.getElementById("img_chn").setAttribute("src","../img/"+ref_chn[i][8]);
		
	}
}

}

function MF(oSelect)
{
	if (oSelect.value == "Avec")
	{
		document.getElementById("titre_longueur").style.visibility = "visible";
		document.getElementById("titre_metal").style.visibility = "visible";
		document.getElementById("titre_type").style.visibility = "visible";
		document.getElementById("titre_masse").style.visibility = "visible";
		document.getElementById("longueur").style.visibility = "visible";
		document.getElementById("metal").style.visibility = "visible";
		document.getElementById("type").style.visibility = "visible";
		document.getElementById("masse").style.visibility = "visible";
		document.getElementById("img_chn").style.visibility = "hidden";
		document.getElementById("total").value = "";
		document.getElementById("type").innerHTML = "";
		document.getElementById("masse").innerHTML = "";
		document.getElementById("metal").innerHTML = "";
		
	} else {
		document.getElementById("titre_longueur").style.visibility = "hidden";
		document.getElementById("titre_metal").style.visibility = "hidden";
		document.getElementById("titre_type").style.visibility = "hidden";
		document.getElementById("titre_masse").style.visibility = "hidden";
		document.getElementById("longueur").style.visibility = "hidden";
		document.getElementById("metal").style.visibility = "hidden";
		document.getElementById("type").style.visibility = "hidden";
		document.getElementById("masse").style.visibility = "hidden";
		document.getElementById("img_chn").style.visibility = "hidden";
		document.getElementById("total").value = "0,00€"
		document.getElementById("type").innerHTML = "";
		document.getElementById("masse").innerHTML = "";
		document.getElementById("metal").innerHTML = "";
	}
}


function Verifier_formulaire(formulaire){
	
	var tutu = document.getElementById("total").value;
	
  if (tutu==""){
    alert ("Vous avez oublié de remplir au moins un champs");
  } else {
    if (tutu!="0,00€"){
		masse_chg(document.getElementById("masse"));
	}
	return(formulaire.submit());
  }
}