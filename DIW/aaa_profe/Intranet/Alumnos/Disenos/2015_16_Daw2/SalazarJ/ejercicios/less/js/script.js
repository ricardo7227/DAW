$(document).ready(function(){

	var elemento=document.getElementById("div1");
	
	var miTimer= setInterval(function(){cambiar(elemento)},500);
	
});

function cambiar(elem)
{
	if($(elem).hasClass("claro"))
	{
		$(elem).addClass("oscuro");
		$(elem).removeClass("claro");
	}
	else{
		$(elem).addClass("claro");
		$(elem).removeClass("oscuro");
	}
}