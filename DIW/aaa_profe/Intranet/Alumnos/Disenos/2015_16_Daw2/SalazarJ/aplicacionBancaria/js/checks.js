//FUNCION PARA ESCRIBIR MENSAJES DE ERROR
function error(sitio,texto)
{
	$(sitio).html(texto);
}

//FUNCION PARA CHEQUEAR DNI'S
function check_dni(dni)
{
	var Qdni="#"+dni;
	var patron_dni= /^[0-9]{8}[A-Za-z]{1}$/g;
	correcto=$(Qdni).val().match(patron_dni);
	if(correcto!=null)
	{
	
		$(Qdni).removeClass("mal");
		$(Qdni).addClass("bien");
		error("#error_"+dni,"");
		return true;				
	}
	
	else
	{	
		$(Qdni).addClass("mal");
		$(Qdni).removeClass("bien");
		error("#error_"+dni,"DNI no válido");
		return null;		
	}
}

//FUNCION PARA CHEQUEAR LOS NUMEROS DE CUENTA
function check_numcu(cuenta)
{
	var Qcuenta="#"+cuenta;
	var numero= $(Qcuenta).val();
	//Se comprueba la longitud
	if(numero.length!=10)
	{
		$(Qcuenta).removeClass("bien");
		$(Qcuenta).addClass("mal");
		error("#error_"+cuenta,"La cuenta debe tener 10 digitos");
		return null;
	}
	var sum=0;
	var i;
	//Se comprueba que solo tenga numeros
	for( i=0;i<numero.length;i++)
	{
		if(isNaN(numero.charAt(i)))
		{
			$(Qcuenta).removeClass("bien");
			$(Qcuenta).addClass("mal");
			error("#error_"+cuenta,"La cuenta solo puede tener numeros");
			return null;					
		}				
	}
	
	//Comprobacion de que el resto de la suma de los 9 primeros digitos entre 9, es igual al ultimo digito
	for( i=0;i<numero.length-1;i++)
	{			
		sum=sum+parseInt(numero.charAt(i));				
	}
	
	if(numero.charAt(i)== parseInt(sum%i))
	{
		$(Qcuenta).removeClass("mal");
		$(Qcuenta).addClass("bien");
		error("#error_"+cuenta,"");
		return true;
	}
	else
	{
		$(Qcuenta).removeClass("bien");
		$(Qcuenta).addClass("mal");
		error("#error_"+cuenta,"La cuenta no es válida");
		return null;
	}
	
}

//FUNCION PARA COMPROBAR LOS MESES
function check_mes(mes)
{
		var Qmes="#"+mes;
		var mesVal=$(Qmes).val();
		//Se comprueba que no este vacio
		if(mesVal=='')
		{
			$(Qmes).removeClass("bien");
			$(Qmes).addClass("mal");
			error("#error_"+mes,"El mes no puede estar vacio");
			return null;
		}
		//Se comprueba que este entre 1 y 12
		if(mesVal<1 | mesVal>12)
		{
			$(Qmes).removeClass("bien");
			$(Qmes).addClass("mal");
			error("#error_"+mes,"El mes debe estar entre 1 y 12");
			return null;
		}
		//Se comprueba que sea un numero
		if(isNaN(mesVal))
		{
			$(Qmes).removeClass("bien");
			$(Qmes).addClass("mal");
			error("#error_"+mes,"Introduce un mes válido");
			return null;
		}
		$(Qmes).removeClass("mal");
		$(Qmes).addClass("bien");
		error("#error_"+mes,"");
		return true;
		
}
//FUNCION PARA COMPROBAR LOS AÑOS
function check_anio(anio)
{
	var Qanio="#"+anio;
	var anioVal=$(Qanio).val();
	//Se comprueba que no este vacio
	if(anioVal=='')
	{
		$(Qanio).removeClass("bien");
		$(Qanio).addClass("mal");
		error("#error_"+anio,"El año no puede estar vacio");
		return null;
	}
	//Se comprueba que este entre 1900 y 3000
	if(anioVal<1900 | anioVal>3000)
	{
		$(Qanio).removeClass("bien");
		$(Qanio).addClass("mal");
		error("#error_"+anio,"El año debe estar comprendido entre 1900 y 3000");
		return null;
	}
	//Se comprueba que sea un numero
	if(isNaN(anioVal))
	{
		$(Qanio).removeClass("bien");
		$(Qanio).addClass("mal");
		error("#error_"+anio,"El año introducido no es válido");
		return null;
	}
	$(Qanio).removeClass("mal");
	$(Qanio).addClass("bien");
	error("#error_"+anio,"");
	return true;
	
}
//FUNCION PARA COMPROBAR FECHAS VALIDAS
function check_compFech(mesIni,anioIni,mesFin,anioFin,sitio)
{
	var cod_error=0;
	
	//Se comprueban mes y año de inicio , y mes y año de fin.
	if(!check_mes(mesIni)) 
	{
		cod_error=1;
	}
	if(!check_mes(mesFin))
	{
		cod_error=1;
	}
	if(!check_anio(anioIni))
	{
		cod_error=1;
	}
	if(!check_anio(anioFin))
	{
		cod_error=1;
	}
	
	if(cod_error==0)
	{	
		//Se comprueba que la fecha final sea posterior a la inicial
		var QmesIni="#"+mesIni;
		var QmesF="#"+mesFin;	
		var QanioIni="#"+anioIni;
		var QanioF="#"+anioFin;	
		var mesI=$(QmesIni).val();
		var mesF=$(QmesF).val();
		var anioI=$(QanioIni).val();
		var anioF=$(QanioF).val();
		mesI=mesI-1;
		mesF=mesF-1;
		var fechI= new Date(anioI,mesI);
		var fechF= new Date(anioF,mesF);
		
		//Si la fecha final es igual o anterior a la inicial se muestra mensaje de error
		if(fechI>fechF || fechI.getTime()==fechF.getTime())
		{
			$(QmesIni).removeClass("bien");
			$(QmesIni).addClass("mal");
			$(QmesF).removeClass("bien");
			$(QmesF).addClass("mal");
			$(QanioIni).removeClass("bien");
			$(QanioIni).addClass("mal");
			$(QanioF).removeClass("bien");
			$(QanioF).addClass("mal");
			error("#error_"+sitio,"La fecha final debe ser posterior a la inicial");
			return null;
		}
		
		//Sino, se muestran correctas
		$(QmesIni).removeClass("mal");
		$(QmesIni).addClass("bien");
		$(QmesF).removeClass("mal");
		$(QmesF).addClass("bien");
		$(QanioIni).removeClass("mal");
		$(QanioIni).addClass("bien");
		$(QanioF).removeClass("mal");
		$(QanioF).addClass("bien");
		error("#error_"+sitio,"");
		return true;
	}
	else
	{
		error("#error_"+sitio,"Fechas no válidas");
		return null;
	}
}



