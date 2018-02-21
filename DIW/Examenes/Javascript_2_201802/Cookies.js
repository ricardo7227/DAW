var lati = 0;
var long = 0;
var opc = {
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 30000
};

var texto = "";

document.addEventListener("readystatechange", cargar_eventos, false );

function cargar_eventos(evento) {
  if (document.readyState == "interactive") {
     leerDatos();
     control_imagen();
     document.formulario.regalo[0].addEventListener("change", control_imagen);
     document.formulario.regalo[1].addEventListener("change", control_imagen);
     document.formulario.regalo[2].addEventListener("change", control_imagen);
     document.images[0].addEventListener("click", enviar);
//     window.addEventListener("unload", guardarDatos);
  }
}
function control_imagen() {
//alert("Control imagen");
     if (contar() > 0) {
        document.images[0].style.display = "block";
     } else {
        document.images[0].style.display = "none";
     }
}
function contar() {
//alert("Contar");
	var opcion = 0;
        for (var i = 0; i < document.formulario.regalo.length; i++) {
                 if (document.formulario.regalo[i].checked) {
                    opcion += 1;
                 }
        }
	return opcion;
}
function enviar() {
  if (contar() == 2) {
    guardarDatos();
//alert("Enviando los datos al servidor");
    document.getElementById("cargando").style.display = "block";
    $("#datos").load("server.php", {}, function() {document.getElementById("cargando").style.display = "none"})
  } else {
    document.getElementById("error").style.display = "block";
    setTimeout("ocultar()", 5000);
  }
}
function ocultar() {
    document.getElementById("error").style.display = "none";
}
function leerDatos() {
//alert("Leer datos");
	if (document.cookie.length > 0) {
           var sep1 = new RegExp("; ", "g");
	   var sep2 = new RegExp("=", "g");
	   // Crea listaCookies con las cookies existentes
           var listaCookies = document.cookie.split(sep1);
	   // Recorre la lista de cookies
           for (var i = 0; i < listaCookies.length ; i++) {
	        var cookie = listaCookies[i].split(sep2);
		if (cookie[0] == "visita") {
			texto = cookie[1];
                }
		if (cookie[0] == "latitud") {
			texto = texto + "<br>" + "Desde la posición: Latitud.- " + cookie[1];
                }
		if (cookie[0] == "longitud") {
			texto = texto + " Longitud.- " + cookie[1];
                }
	   }
	   document.getElementById("ultima_visita").innerHTML = texto;
           var opciones = 0;
           if (typeof(Storage) !== "undefined") {
              if (localStorage.getItem("opciones") !== null) {
                 var opciones = Number(localStorage.getItem("opciones"));
              }
           } else {
              alert("Sintiendolo mucho tu navegador no soporta Web Storage");
           }
           for (var j = document.formulario.regalo.length - 1; j >= 0; j--){
               if (opciones >= Math.pow(2, j)) {
                  opciones -= Math.pow(2, j);
                  document.formulario.regalo[j].checked = true;
               } else {
                  document.formulario.regalo[j].checked = false;
               }
           }

        }
}
function guardarDatos() {
	var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                              "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	var fecha = new Date();
	var cadena = "Fecha última visita: " + fecha.getDate() + " de " + meses[fecha.getMonth()] + " de " + fecha.getFullYear();
	fecha.setTime(fecha.getTime() + 1000*60*5);
	navigator.geolocation.getCurrentPosition(localizado, no_localizado, opc);
	var opcion = 0;
        for (var i = 0; i < document.formulario.regalo.length; i++) {
                 if (document.formulario.regalo[i].checked) {
                    opcion += Math.pow(2, i);
                 }
        }
        document.cookie = "visita=" + cadena +";expires=" + fecha.toUTCString();
        document.cookie = "latitud=" + lati +";expires=" + fecha.toUTCString();
        document.cookie = "longitud=" + long +";expires=" + fecha.toUTCString();
        if (typeof(Storage) !== "undefined") {
           localStorage.setItem("opciones", opcion);
        } else {
           alert("Sintiendolo mucho tu navegador no soporta Web Storage");
        }
}
function localizado (objeto) {
alert("Localizado");
	lati = objeto.coords.latitude;
        long = objeto.coords.longitude;
}
function no_localizado () {
alert("No localizado");
	lati = 0;
        long = 0;
}
