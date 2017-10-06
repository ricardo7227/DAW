$(document).ready(function(){
/*****************************************************************/
/*************************ESTADO 0********************************/
/*****************************************************************/
	
	//Comprueba que el numero de cuenta sea correcto
	$("#numCu").focusout(function(evento){
		
		if(check_numcu('numCu'))
		{
			$('#contenido').load('borraCuenta/resBorraCuenta.php',{
										estado: $('#estado').val(),
										numCu: $('#numCu').val()
								});
			
		}
	});
	
/*****************************************************************/
/*************************ESTADO 1********************************/
/*****************************************************************/
	$('#confOperacion').click(function(evento){
		
		evento.preventDefault();
		$('#contenido').load("borraCuenta/resBorraCuenta.php",{
										estado: $('#estado').val(),
										numCu: $('#numCu').val(),
										titular1: $('#tit1').val(),
										titular2: $('#tit2').val()
						});
		
	});
	
	$('#cancOperacion').click(function(evento){
			
			evento.preventDefault();
			$('#contenido').load("borraCuenta/borraCuenta.php");
			
		});
	
});
