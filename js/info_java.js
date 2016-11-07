function Verifier_formulaire(formulaire){
	
	var nom = document.getElementById("id_nom").value;
	var prénom = document.getElementById("id_prenom").value;
	var email = document.getElementById("id_mail").value;
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	var regnum = new RegExp('^[0-9]$','i');	
  if (nom==""||prénom==""||email==""){
    alert ("Vous avez oublié de remplir au moins un champs obligatoire");
  } else if (reg.test(email)) {
    
	return(formulaire.submit());
  }
  else {
	return(alert ("L'email n'est pas réglementaire"));
  }
}