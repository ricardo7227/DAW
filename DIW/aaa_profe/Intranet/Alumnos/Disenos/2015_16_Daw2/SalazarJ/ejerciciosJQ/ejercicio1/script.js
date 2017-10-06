$(document).ready(function(){
	$("a").click(function(evento){
		alert("Has pulsado el enlace...Pero NO serás enviado a www.google.es");
		evento.preventDefault();
		}
	);
});