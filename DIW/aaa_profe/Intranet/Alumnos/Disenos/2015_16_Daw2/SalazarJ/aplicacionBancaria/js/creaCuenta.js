//FUNCION PARA COMPROBAR FECHAS DE NACIMIENTO
function com_Nac(nacimiento)
{
	var Qnacimiento="#"+nacimiento;
	var nacimientoVal=$(Qnacimiento).val();
	//Comprueba que no esta vacia
	if(nacimientoVal=='')
    {
    	$(Qnacimiento).removeClass("bien");
		$(Qnacimiento).addClass("mal");
		error("#error_"+nacimiento,"La fecha de nacimiento no puede estar vacia");
        return null;
    }
	//Comprueba que coincide con el patron
	var comp= new RegExp("^(1[0-9]{3}|200[0-9]|201[0-5])-([0]?[1-9]|[1][0-2])-(0?[1-9]|1[0-9]|2[0-9]|3[0-1])$","g");
	if(!comp.test(nacimientoVal))
	{
		$(Qnacimiento).removeClass("bien");
		$(Qnacimiento).addClass("mal");
		error("#error_"+nacimiento,"Formato no válido");
		return null;
	}
	var fechaf = nacimientoVal.split("-");
    var day = fechaf[2];
    var month = fechaf[1];
    var year = fechaf[0];
    var date = new Date(year,month-1,day);
    //Comprueba que sea una fecha válida
    if(!date || date.getFullYear() != year || date.getMonth() != month -1 || date.getDate() != day){
    	$(Qnacimiento).removeClass("bien");
		$(Qnacimiento).addClass("mal");
		error("#error_"+nacimiento,"Fecha no válida");
        return null;
    }
    
	$(Qnacimiento).removeClass("mal");
	$(Qnacimiento).addClass("bien");
	error("#error_"+nacimiento,"");
	return true;
	
}
$(document).ready(function(){
	/***************************************************************/
	/***********************ESTADO 0********************************/
	/***************************************************************/
		//Comprueba el numero de cuenta antes de seguir
		$('#numCu').focusout(function(evento){
			evento.preventDefault();
			if(check_numcu('numCu'))
			{
				$('#contenido').load("creaCuenta/resCreaCuenta.php",{
										estado: $('#estado').val(),
										numCu: $('#numCu').val()
										
									});
			}
		});
	/***************************************************************/
	/***********************ESTADO 1********************************/
	/***************************************************************/
		//Comprueba el DNI del titular antes de seguir
		$('#tit1').focusout(function(evento){
			evento.preventDefault();
			if(check_dni('tit1'))
			{
				$('#contenido').load("creaCuenta/resCreaCuenta.php",{
											estado: $('#estado').val(),
											numCu: $('#numCu').val(),
											tit1: $('#tit1').val()
								});
			}
			
		});
	/******************************************************************/
	/************************ESTADO 2**********************************/
	/******************************************************************/
	//Se comprueba la fecha de nacimiento del titular
	$('#fechNac1').focusout(function(evento){
		
		 com_Nac('fechNac1');
		
	});
	// NO SE COMPRUEBA QUE TODOS LOS DATOS DEL TITULAR SEAN CORRECTOS, DEBERIA COMPROBARSE	
		
		
		//Muestra o oculta el input del segundo titular al cambiar el radio
		$('input[name=segTit]').change(function(evento){
			var valor=$(this).val();
			if(valor==0)
			{
				$('#segundoTit').css("display","none");
			}
			else
			{
				$('#segundoTit').css("display","block");
			}
		});
		
		//Comprueba el DNI del segundo titular
		$('#segundoTit').focusout(function(evento){
			check_dni('tit2');
			if($('#tit2').val().toLowerCase()==$('#tit1').val().toLowerCase())
			{
				$('#tit2').addClass("mal");
				$('#tit2').removeClass("bien");
				error("#error_tit2","Los DNI no pueden ser los mismos");
			}
		});
		
		//Antes de seguir se comprueba que la fecha de nacimiento del titular es válida
		//También comprueba que no esté seleccionado el segundo titular, y si lo está, que el dni 
		//sea válido y distinto al del titular
		$('#seguir').click(function(evento){
			if(com_Nac('fechNac1'))
			{
				evento.preventDefault();
				
				//Comprobaciones de los datos cliente
				if($('input[name=segTit]:checked').val()==0)
				{
					$('#contenido').load("creaCuenta/resCreaCuenta.php",{
						estado: $('#estado').val(),
						numCu: $('#numCu').val(),
						tit1: $('#tit1').val(),
						nom1: $('#nom1').val(),
						dir1: $('#dir1').val(),
						tel1: $('#tel1').val(),
						email1: $('#email1').val(),
						fechNac1: $('#fechNac1').val(),
						fechAlt1: $('#fechAlt1').val(),
						cuentas1: $('#cuentas1').val(),
						sald1: $('#sald1').val(),
						radio: $('input[name=segTit]:checked').val(),
						
					});
				}
				else
				{
					if(($('#tit2').val().toLowerCase() !=$('#tit1').val().toLowerCase()) && check_dni('tit2'))
					{
							
					
							$('#contenido').load("creaCuenta/resCreaCuenta.php",{
													estado: $('#estado').val(),
													numCu: $('#numCu').val(),
													tit1: $('#tit1').val(),
													nom1: $('#nom1').val(),
													dir1: $('#dir1').val(),
													tel1: $('#tel1').val(),
													email1: $('#email1').val(),
													fechNac1: $('#fechNac1').val(),
													fechAlt1: $('#fechAlt1').val(),
													cuentas1: $('#cuentas1').val(),
													sald1: $('#sald1').val(),
													radio: $('input[name=segTit]:checked').val(),
													tit2: $('#tit2').val()
							});
					}
				}
			}
		});
		/******************************************************************/
		/************************ESTADO 3**********************************/
		/******************************************************************/
		// NO SE COMPRUEBA QUE LOS DATOS DEL SEGUNDO TITULAR SEAN CORRECTOS, DEBERIA COMPROBARSE
		//Se comprueba la fecha de nacimiento del segundo titular
		$('#fechNac2').focusout(function(evento){
			
			 com_Nac('fechNac2');
			
		});
		
		//Antes de continuar se comprueba que la fecha de nacimiento del segundo titular sea
		// valida
		$('#finalizar').click(function(evento){
			evento.preventDefault();
			if(com_Nac('fechNac2')){				
				
				$('#contenido').load("creaCuenta/resCreaCuenta.php",{
					estado: $('#estado').val(),
					numCu: $('#numCu').val(),
					tit1: $('#tit1').val(),
					nom1: $('#nom1').val(),
					dir1: $('#dir1').val(),
					tel1: $('#tel1').val(),
					email1: $('#email1').val(),
					fechNac1: $('#fechNac1').val(),
					fechAlt1: $('#fechAlt1').val(),
					cuentas1: $('#cuentas1').val(),
					sald1: $('#sald1').val(),				
					tit2: $('#tit2').val(),
					nom2: $('#nom2').val(),
					dir2: $('#dir2').val(),
					tel2: $('#tel2').val(),
					email2: $('#email2').val(),
					fechNac2: $('#fechNac2').val(),
					fechAlt2: $('#fechAlt2').val(),
					cuentas2: $('#cuentas2').val(),
					sald2: $('#sald2').val()				
				});
			}
		});
		/******************************************************************/
		/************************ESTADO 4**********************************/
		/******************************************************************/
		
		//Se comprueba que el importe de apertura sea un numero y mayor que 0
		$('#apertura').focusout(function(evento){
			if(isNaN($(this).val()) || $(this).val()<=0 )
				{
					
					$('#apertura').addClass("mal");
					$('#apertura').removeClass("bien");
					error("#error_apertura","El importe de apertura debe ser mayor que 0");
				}
			else
				{
					$('#apertura').addClass("bien");
					$('#apertura').removeClass("mal");
					error("#error_apertura","");
				}
		})
		
		//Si se cancela , vuelve al comienzo
		$('#cancAlta').click(function(evento){
				evento.preventDefault();
				$('#contenido').load('creaCuenta/creaCuenta.php');
		});
		
		//Si se confirma, se comprueba el importe de apertura de nuevo
		$('#confAlta').click(function(evento){
			evento.preventDefault();
			if(!isNaN($('#apertura').val()) && $('#apertura').val()>0 ){				
			
				$('#contenido').load("creaCuenta/resCreaCuenta.php",{
					estado: $('#estado').val(),
					numCu: $('#numCu').val(),
					tit1: $('#tit1').val(),
					nom1: $('#nom1').val(),
					dir1: $('#dir1').val(),
					tel1: $('#tel1').val(),
					email1: $('#email1').val(),
					fechNac1: $('#fechNac1').val(),
					fechAlt1: $('#fechAlt1').val(),
					cuentas1: $('#cuentas1').val(),
					sald1: $('#sald1').val(),				
					tit2: $('#tit2').val(),
					nom2: $('#nom2').val(),
					dir2: $('#dir2').val(),
					tel2: $('#tel2').val(),
					email2: $('#email2').val(),
					fechNac2: $('#fechNac2').val(),
					fechAlt2: $('#fechAlt2').val(),
					cuentas2: $('#cuentas2').val(),
					sald2: $('#sald2').val(),
					apertura: $('#apertura').val()
				});
			}
			
	});
});