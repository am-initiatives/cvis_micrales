var Polices = [
	{
		titre: "Police : Bâton", 
		police: "Bâton"
	},
	{
		titre: "Police : Z'goth",
		police: "Old"
	},
	{
		titre: "Police : Clun's",
		police: "Cluns"
	},
	{
		titre: "Police : Z'goth de Bordel's",
		police: "Gothique"
	}
];
getElementById
var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var dlElt = document.createElement("dl");
Polices.forEach(function(Polices){
	
	var box = document.createElement("dt");
	var titre = document.createElement("div");
	titre.setAttribute("id", "title");
	titre.textContent = (Polices.titre);
	box.appendChild(titre);
	
	var min = document.createElement("div");
	min.setAttribute("id", "min");
	for (i=0; i<= 25; i++){
		var bouton = document.createElement("input");
		bouton.setAttribute("type","image");
		bouton.setAttribute("src","../img/"+ Polices.police +"/" +alphabet.charAt(i)+alphabet.charAt(i)+".png");
		bouton.setAttribute("name",alphabet.charAt(i)+"min"+ Polices.police);
		min.appendChild(bouton);
	}
	box.appendChild(min);
	
	var max = document.createElement("div");
	max.setAttribute("id", "max");
	for (i=0; i<= 25; i++){
		var bouton = document.createElement("input");
		bouton.setAttribute("type","image");
		bouton.setAttribute("src","../img/"+ Polices.police +"/" +alphabet.charAt(i)+".png");
		bouton.setAttribute("name",alphabet.charAt(i)+"maj"+ Polices.police);
		max.appendChild(bouton);
	}
	box.appendChild(max);
	
	var num = document.createElement("div");
	num.setAttribute("id", "num");
	for (i=0; i<= 9; i++){
		var abouton = document.createElement("a");
		abouton.setAttribute("href","accent.php");
		var bouton = document.createElement("img");
		bouton.setAttribute("src","../img/"+ Polices.police +"/" +i+".png");
		bouton.setAttribute("value",i+"num"+ Polices.police);
		abouton.appendChild(bouton);
		num.appendChild(abouton);
	}
	box.appendChild(num);
	
	dlElt.appendChild(box);
});
document.getElementById("contenu").appendChild(dlElt);