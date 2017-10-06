$(document).ready(function(){
	//COMPROBACION NUMERO DE CUENTA
	$("#numCu").focusout(function(evento){
			check_numcu('numCu');
	});
	
	//COMPROBACION FECHA INICIAL
	$("#mesIni").focusout(function(evento){
		
		evento.preventDefault();
		check_mes('mesIni');
	});
	$("#anioIni").focusout(function(evento){
		
		evento.preventDefault();
		check_anio('anioIni');
	});
	
	//COMPROBACION FECHA FINAL
	$("#mesFin").focusout(function(evento){
			
			evento.preventDefault();
			check_mes('mesFin');
	});
	$("#anioFin").focusout(function(evento){
		
		evento.preventDefault();
		check_anio('anioFin');
	});
	

	
	
	//COMPROBACIONES PARA QUE FUNCIONE EL BOTON
	$("#buscarMov").click(function(evento){
		
		
		evento.preventDefault();
		//Se comprueba el numero de cuenta y la fecha antes de seguir
		if(check_numcu('numCu') && check_compFech('mesIni','anioIni','mesFin','anioFin','fechasVal') )
		{
			$("#contenido").load('movimientos/res_movimientos.php',{
									numCu: $('#numCu').val(),
									mesIni:$('#mesIni').val(),
									mesFin: $('#mesFin').val(),
									anioIni: $('#anioIni').val(),
									anioFin:$('#anioFin').val()});			
		}
		
	});
});