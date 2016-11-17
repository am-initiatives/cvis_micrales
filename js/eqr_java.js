
window.onload = function() { init() };
	var ref_eqr2 = new Array(0);

  function init() {
    $.getJSON('get_eqr.php', function(data) {
        for (var i = 0; i< data.length; i++){
		// console.log(data[i]);
		ref_eqr2[i] = Array(0);
		["id","ref","prix","metal", "epaisseur", "gravure", "encoche", "commentaire"].forEach(function(item)
		{
			ref_eqr2[i].push ( data[i][item]);
			
		});
        }
    });
  }
  
  
function metal_chg(oSelect){

	var value = oSelect.options[oSelect.selectedIndex].value;
	var temp = new Array(0);
	var k = 0;
	var checked = 0;
for (var i = 0; i < ref_eqr2.length; i++) {
	if(value == ref_eqr2[i][3]){
		for (var j = 0; j < temp.length; j++) {
			if (temp[j]== ref_eqr2[i][4]){
				checked = 1;
			}
		}
		if (checked== 0) {
			temp[k]= ref_eqr2[i][4];
			k++;
		}
		checked =0;
	}
	
}

	
	
	oSelect = document.getElementById("epaisseur");
	oSelect.innerHTML = "";
	for (var i=0; i<temp.length; i++) {
		oOption = document.createElement("option");
		oInner  = document.createTextNode(temp[i]);
		oOption.appendChild(oInner);
		oSelect.appendChild(oOption);
		
	}
	document.getElementById("gravure").innerHTML = "";
	document.getElementById("encoche").innerHTML = "";
	document.getElementById("total").value = "";
	document.getElementById("img_epais").style.visibility = "hidden";
	if (value == "OR JAUNE")
{
	document.getElementById("img_metal").style.visibility = "visible";
	document.getElementById("img_metal").setAttribute("src","../img/OR_Jaune.jpg");
}
else if (value == "OR BLANC" || value == "ARGENT")
{
	document.getElementById("img_metal").style.visibility = "visible";
	document.getElementById("img_metal").setAttribute("src","../img/Or_blanc.jpg");
}
else 
{
	document.getElementById("img_metal").style.visibility = "hidden";
}
epais_chg()
}

function epais_chg()
{
	document.getElementById("gravure").innerHTML = "";
	document.getElementById("encoche").innerHTML = "";
	document.getElementById("total").value = "";
	if (document.getElementById("epaisseur").value != ""){
	var gravure = document.createElement("option");
	gravure.id= "Avec gravure";
	gravure.value= "Avec gravure";
	gravure.textcontent= "Avec gravure";
	gravure.appendChild(document.createTextNode("Avec gravure"));
	document.getElementById("gravure").appendChild(gravure);
	gravure = document.createElement("option");
	gravure.id= "Sans gravure";
	gravure.value= "Sans gravure";
	gravure.textcontent= "Sans gravure";
	gravure.appendChild(document.createTextNode("Sans gravure"));
	if (document.getElementById("epaisseur").value == "0,6mm")
	{
		document.getElementById("img_epais").style.visibility = "visible";
		document.getElementById("img_epais").setAttribute("src","../img/fine.jpg");
	}
	else
	{
		document.getElementById("img_epais").style.visibility = "visible";
		document.getElementById("img_epais").setAttribute("src","../img/epais.jpg");
	}
	document.getElementById("gravure").appendChild(gravure);
	}
	else
	{
		document.getElementById("img_epais").style.visibility = "hidden";
	}
	grav_chg()
}

function grav_chg()
{
	document.getElementById("encoche").innerHTML = "";
	if (document.getElementById("gravure").value != ""){
	var encoche = document.createElement("option");
	encoche.id= "Sans encoche";
	encoche.value= "Sans encoche";
	encoche.textcontent= "Sans encoche";
	encoche.appendChild(document.createTextNode("Sans encoche"));
	document.getElementById("encoche").appendChild(encoche);
	encoche = document.createElement("option");
	encoche.id= "Avec encoche";
	encoche.value= "Avec encoche";
	encoche.textcontent= "Avec encoche";
	encoche.appendChild(document.createTextNode("Avec encoche"));
	document.getElementById("encoche").appendChild(encoche);
	}
	document.getElementById("total").value = "";
	enc_chg()
}
function enc_chg(oSelect)
{
	document.getElementById("total").value = "";
	var metal = document.getElementById("metal").value
	var epaisseur = document.getElementById("epaisseur").value;
	var gravure;
	if (document.getElementById("gravure").value == "Avec gravure"){gravure = 1;}
	if (document.getElementById("gravure").value == "Sans gravure"){gravure = 0;}
	
	var encoche;
	if (document.getElementById("encoche").value == "Avec encoche"){encoche = 1;}
	if (document.getElementById("encoche").value == "Sans encoche"){encoche = 0;}
	
	if (encoche==0||encoche==1){
		for (var i = 0; i < ref_eqr2.length; i++) {	
			if( ref_eqr2[i][3]==metal && ref_eqr2[i][4] == epaisseur && ref_eqr2[i][5]==gravure && ref_eqr2[i][6]==encoche){
			
				document.getElementById("total").value = "";
				document.getElementById("total").value = ref_eqr2[i][2]+",00€";
				document.getElementById("eqr_prix").value = ref_eqr2[i][2];
				document.getElementById("eqr_ref").value =ref_eqr2[i][1];
			}
		}
	}
	
}

function MF(oSelect)
{
	if (oSelect.value == "Avec")
	{
		document.getElementById("titre_metal").style.visibility = "visible";
		document.getElementById("titre_epaisseur").style.visibility = "visible";
		document.getElementById("titre_gravure").style.visibility = "visible";
		document.getElementById("titre_encoche").style.visibility = "visible";
		document.getElementById("metal").style.visibility = "visible";
		document.getElementById("epaisseur").style.visibility = "visible";
		document.getElementById("gravure").style.visibility = "visible";
		document.getElementById("encoche").style.visibility = "visible";
		document.getElementById("img_metal").style.visibility = "hidden";
		document.getElementById("img_epais").style.visibility = "hidden";
		document.getElementById("img_encoche").style.visibility = "visible";
		document.getElementById("total").value = "";
		document.getElementById("epaisseur").innerHTML = "";
		document.getElementById("gravure").innerHTML = "";
		document.getElementById("encoche").innerHTML = "";
		document.getElementById("total").value = "";
		
	} else {
		document.getElementById("titre_metal").style.visibility = "hidden";
		document.getElementById("titre_epaisseur").style.visibility = "hidden";
		document.getElementById("titre_gravure").style.visibility = "hidden";
		document.getElementById("titre_encoche").style.visibility = "hidden";
		document.getElementById("metal").style.visibility = "hidden";
		document.getElementById("epaisseur").style.visibility = "hidden";
		document.getElementById("gravure").style.visibility = "hidden";
		document.getElementById("encoche").style.visibility = "hidden";
		document.getElementById("total").value = "0,00€"
		document.getElementById("eqr_prix").value = "0";
		document.getElementById("eqr_ref").value = "";
		document.getElementById("img_metal").style.visibility = "hidden";
		document.getElementById("img_epais").style.visibility = "hidden";
		document.getElementById("img_encoche").style.visibility = "hidden";
	}
}

function Verifier_formulaire(formulaire){
	
	var toto = document.getElementById("total").value;
  if (toto==""){
    alert ("Vous avez oublié de remplir au moins un champs");
  } else {
    if (toto!="0,00€"){
		enc_chg();
	}
	return(formulaire.submit());
  }
}