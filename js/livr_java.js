function MF(oSelect)
{
	if (oSelect.value == "Domicile")
	{
		document.getElementById("titre_nom").style.visibility = "visible";
		document.getElementById("titre_prenom").style.visibility = "visible";
		document.getElementById("titre_adresse").style.visibility = "visible";
		document.getElementById("titre_cp").style.visibility = "visible";
		document.getElementById("titre_ville").style.visibility = "visible";
		document.getElementById("nom").style.visibility = "visible";
		document.getElementById("prenom").style.visibility = "visible";
		document.getElementById("adresse1").style.visibility = "visible";
		document.getElementById("adresse2").style.visibility = "visible";
		document.getElementById("CP").style.visibility = "visible";
		document.getElementById("ville").style.visibility = "visible";
		document.getElementById("infal").style.visibility = "visible";
		document.getElementById("total").value="12,00€";
		document.getElementById("lvr_prix").value= "12";
		
	} else {
		document.getElementById("titre_nom").style.visibility = "hidden";
		document.getElementById("titre_prenom").style.visibility = "hidden";
		document.getElementById("titre_adresse").style.visibility = "hidden";
		document.getElementById("titre_cp").style.visibility = "hidden";
		document.getElementById("titre_ville").style.visibility = "hidden";
		document.getElementById("nom").style.visibility = "hidden";
		document.getElementById("prenom").style.visibility = "hidden";
		document.getElementById("adresse1").style.visibility = "hidden";
		document.getElementById("adresse2").style.visibility = "hidden";
		document.getElementById("CP").style.visibility = "hidden";
		document.getElementById("ville").style.visibility = "hidden";
		document.getElementById("infal").style.visibility = "hidden";
		document.getElementById("total").value="0,00€";
		document.getElementById("lvr_prix").value= "0";
	}
}
window.onload = function(){
		document.getElementById("titre_nom").style.visibility = "hidden";
		document.getElementById("titre_prenom").style.visibility = "hidden";
		document.getElementById("titre_adresse").style.visibility = "hidden";
		document.getElementById("titre_cp").style.visibility = "hidden";
		document.getElementById("titre_ville").style.visibility = "hidden";
		document.getElementById("nom").style.visibility = "hidden";
		document.getElementById("prenom").style.visibility = "hidden";
		document.getElementById("adresse1").style.visibility = "hidden";
		document.getElementById("adresse2").style.visibility = "hidden";
		document.getElementById("CP").style.visibility = "hidden";
		document.getElementById("ville").style.visibility = "hidden";
		document.getElementById("infal").style.visibility = "hidden";
		document.getElementById("total").value="0,00€";
		document.getElementById("lvr_prix").value= "0";
};

function Verifier_formulaire(formulaire){
	if(document.getElementsByName("livr_lieu")[1].checked==true){
		var tata = document.getElementById("nom").value;
	var tete = document.getElementById("prenom").value;
	var titi = document.getElementById("adresse1").value;
	var toto = document.getElementById("CP").value;
	var tutu = document.getElementById("ville").value;
	
  if (tata==""||tete==""||titi==""||toto==""||tutu==""){
    alert ("Vous avez oublié de remplir au moins un champs obligatoire");
  } else {
    
	return(formulaire.submit());
  }
} else {
	return(formulaire.submit());
	}
}