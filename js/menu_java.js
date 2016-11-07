function Verifier_formulaire(formulaire){
	
	var titi = document.getElementById("pomo").value;
	var toto = document.getElementById("enclume").value;
	
  if (titi==""||toto==""){
    alert ("Vous avez oublié de remplir au moins un champs obligatoire");
  } else {
    
	return(formulaire.submit());
  }
}


function grv(formulaire){
	
	var titi = document.getElementById("gragra").value;
	
  if (titi=="Gravure indisponible"){
    alert ('Veuillez selectionner "Avec gravure" dans le menu "Equerre" pour débloquer cette option.');
  } else {
	return(formulaire.submit());
  }
}