//Comprobación del importe
function comprobarImporte()
{
	var cantidad=$('#importe').val();
	//Si el importe es correcto
	if(cantidad>0 && !isNaN(cantidad))
	{
		$('#importe').addClass('bien');
		$('#importe').removeClass('mal');
		error('#error_importe','');
	}
	
	//Si no es correcto , se muestran los distintos mensajes de error
	else
	{
		$('#importe').removeClass('bien');
		$('#importe').addClass('mal');
		if(cantidad<='0' || cantidad=='-0')
		{
			error('#error_importe','El importe no puede ser 0 ni negativo');
		}			
		if(isNaN(cantidad))
		{
			error('#error_importe','El importe debe ser un numero');		
		}
		if(cantidad=='')
		{
			error('#error_importe','El importe es obligatorio');
		}						
	}
	
	//Además, si esta marcada la opción de reintegro, se comprueba que el importe no supere al saldo
	if($('input[type=radio][name=tipOp]:checked').val()==1)
	{
		
		if($('#importe').val()>$('#saldo').val())
		{
			$('#importe').removeClass('bien');
			$('#importe').addClass('mal');
			error('#error_importe','No hay saldo suficiente');
		}
	}
}

$(document).ready(function(){
	
	/*********************************************************************************/
	/********************ESTADO0******************************************************/
	/*********************************************************************************/
	//Se comprueba el numero de cuenta
	$("#numCu").focusout(function(evento){
			if(check_numcu('numCu'))
			{
			$("#contenido").load("cambioSaldo/resCambioSaldo.php",{numCu:$('#numCu').val() });
		}
	});
	
	/*********************************************************************************/
	/********************ESTADO1******************************************************/
	/*********************************************************************************/
	//Cada vez que se selecciona un radio, se comprueba el importe
	$('input[type=radio][name=tipOp]').click(function(evento){
		comprobarImporte();
	});
	
	$('#importe').focusout(function(evento)
	{
		comprobarImporte();
	});
	
	//Solo continua si el importe es correcto
	$("#cambiarSaldo").click(function(evento){
		evento.preventDefault();
		if($('#importe').hasClass("bien"))
		{
			$('#contenido').load("cambioSaldo/resCambioSaldo.php",
								{desc:$('#desc').val(), 
								 importe: $('#importe').val(),
								 tipOp: $('input[type=radio][name=tipOp]:checked').val(),
								 });
		}
	});
	/*********************************************************************************/
	/********************ESTADO2******************************************************/
	/*********************************************************************************/
	$("#confOperacion").click(function(evento){
		evento.preventDefault();
		$('#contenido').load("cambioSaldo/resCambioSaldo.php");
		
	});
	$("#cancOperacion").click(function(evento){
		evento.preventDefault();
		$('#contenido').load("cambioSaldo/cambioSaldo.php");
		
	});
	

		
});