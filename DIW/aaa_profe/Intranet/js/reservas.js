function cambiarLugar(){
	var cadena=document.getElementById('recursos').options[document.getElementById('recursos').selectedIndex].value;
	var valores=cadena.split(',');
	document.getElementById('lugar_recurso').innerHTML=valores[1];
	document.getElementById('oculto').style.display='none';
	document.getElementById('hora_reserva').style.display='none';
	document.getElementById('horarios_reserva').style.display='none';
	document.getElementById('enviado').style.display='none';
}


function alerta(){
	alert('Reserva realizada');
}

function alerta1(){
	alert('Anulado correctamente');
}


function ocultarfecha(){
	document.getElementById('oculto').style.display='none';
	document.getElementById('hora_reserva').style.display='none';
	document.getElementById('horarios_reserva').style.display='none';
	document.getElementById('enviado').style.display='none';
}

function controlador(){
	var control=verificarFecha();
	if(control==1){
		validarDatos();
	}
	while(control==0){
		break;
	}
}

function verificarFecha(){
	var fecha_actual = new Date();
	var dia = fecha_actual.getDate();
	var mes = fecha_actual.getMonth() + 1;
	var anio = fecha_actual.getFullYear();

	var valor = document.getElementById('datepicker2').value;
	var fecha_introducida=valor.split('/');

	if(document.getElementById('datepicker2').value==''){
		document.getElementById('oculto').style.display='none';
		alert('No has introducido ninguna fecha');
		return(0);
	}else if(anio>fecha_introducida[2]){
		document.getElementById('oculto').style.display='none';
		alert('La fecha introducida es anterior a hoy');
		return(0);
	}else{
		if(mes>fecha_introducida[1]){
			document.getElementById('oculto').style.display='none';
			alert('La fecha introducida es anterior a hoy');
			return(0);
		}else{
			if(dia>fecha_introducida[0]){
				document.getElementById('oculto').style.display='none';
				alert('La fecha introducida es anterior a hoy');
				return(0);
			}else{
				document.getElementById('oculto').style.display='inline';
				document.getElementById('oculto').innerHTML='<br>La fecha introducida es correcta';
				return(1);
			}
		}
	}
}

function getXMLHTTPRequest(){
	try{
		req = new XMLHttpRequest();
	}catch(err1){
		try{
			req = new ActiveXObject('Msxml2.XMLHTTP');
		}catch (err2){
			try{
				req = new ActiveXObject('Microsoft.XMLHTTP');
			}catch (err3){
				req = false;
			}
		}
	}
	return req;
}

function validarDatos(){
	var cadena=document.getElementById('recursos').options[document.getElementById('recursos').selectedIndex].value;
	var valores=cadena.split(',');
	var recurso=valores[0];
	cadena = document.getElementById('datepicker2').value;
	valores=cadena.split('/');
	var fecha = valores[2]+'-'+valores[1]+'-'+valores[0];
	var turno = document.getElementById('turno').options[document.getElementById('turno').selectedIndex].value;
	var total=recurso+','+fecha+','+turno;

	http = getXMLHTTPRequest();
	enviarvariable(total);

	function enviarvariable(variable) { // funcion encargada de inviar la variable al archivo php llamado index.php.
		var url = 'Tic/Reservas/validar_formulario.php?valor='+variable; // creación de la URL.
		http.open('GET', url, true); // fijando los parametros para el envío de datos.
		http.onreadystatechange = respuesta; // Qué función utilizar en caso de que el estado de la petición cambie.
		http.send(null); // enviar petición.
	}

	function respuesta() {
		if (http.readyState == 4) {
			if(http.status == 200) {
				document.getElementById('hora_reserva').style.display='inline';
				document.getElementById('hora_reserva').innerHTML=http.responseText;
				if(http.responseText=='No hay horas disponibles'){
					document.getElementById('horarios_reserva').style.display='none';
					document.getElementById('enviado').style.display='none';
				}else{
					document.getElementById('horarios_reserva').style.display='inline';
					document.getElementById('enviado').style.display='inline';
					verHorario();
				}
				// http.responseText es el texto de respuesta del archivo validar_formulario.php
			}
		}
	}
}

function verHorario(){
	var hora = document.getElementById('hora').options[document.getElementById('hora').selectedIndex].value;
	var turno = document.getElementById('turno').options[document.getElementById('turno').selectedIndex].value;
	var total = hora+','+turno;

	http = getXMLHTTPRequest();
	enviarvariable(total);

	function enviarvariable(variable) { // funcion encargada de inviar la variable al archivo php llamado index.php.
		var url = 'Tic/Reservas/validar_hora.php?valor='+variable; // creación de la URL.
		http.open('GET', url, true); // fijando los parametros para el envío de datos.
		http.onreadystatechange = respuesta; // Qué función utilizar en caso de que el estado de la petición cambie.
		http.send(null); // enviar petición.
	}

	function respuesta() {
		if (http.readyState == 4) {
			if(http.status == 200) {
				document.getElementById('horarios_reserva').innerHTML=http.responseText;
				// http.responseText es el texto de respuesta del archivo validar_hora.php
			}
		}
	}
}
