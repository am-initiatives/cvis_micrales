function MF(oSelect)
{
	if (oSelect.value == "Chèque")
	{
		document.getElementById("titre_transac").textContent  = "N° de chèque : ";
		var text_infals = document.createElement("p");
		document.getElementById("infal").textContent= "Paiement par chèque";
		var text_infals = document.createElement("p");
		text_infals.textContent ="Toute commande n'ayant pas été réglée avant la date limite de rendu de bon de commande sera annulée. Le chèque est à remettre en même temps que le bon de commande. ";
		document.getElementById("infal").appendChild(text_infals);
		document.getElementById("infal").appendChild(document.createElement("br"));
		text_infals = document.createElement("p");
		text_infals.textContent ="Attention : N'oubliez pas de nous faire parvenir le bon de commande. Ce n'est pas automatique";
		text_infals.setAttribute("style","color: red;");
		document.getElementById("infal").appendChild(text_infals);
		document.getElementById("conseil").textContent= "NB : Les chèques seront débités dans le courant de février";
		
		
	} 
	if (oSelect.value == "Virement"){
		document.getElementById("titre_transac").textContent  = "N° de transaction : ";
		var text_infals = document.createElement("p");
		document.getElementById("infal").textContent= "Paiement par virement";
		var text_infals = document.createElement("p");
		text_infals.textContent ="Toute commande n'ayant pas été réglée avant la date limite de rendu de bon de commande sera annulée.";
		document.getElementById("infal").appendChild(text_infals);
		document.getElementById("infal").appendChild(document.createElement("br"));
		document.getElementById("infal").appendChild(document.createElement("br"));
		text_infals = document.createElement("p");
		text_infals.textContent ="Attention : N'oubliez pas de nous faire parvenir le bon de commande. Ce n'est pas automatique";
		text_infals.setAttribute("style","color: red;");
		document.getElementById("infal").appendChild(text_infals);
		document.getElementById("conseil").textContent= "Pour effectuer le virement, ";
		var text_conseil = document.createElement("a");
		text_conseil.textContent = "cliquez ici";
		text_conseil.href= "http://paiement.gadz.org/uecvis/";
		text_conseil.setAttribute("onclick","window.open(this.href); return false;");
		document.getElementById("conseil").appendChild(text_conseil);
	}
}
