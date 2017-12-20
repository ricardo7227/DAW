var resultado = document.getElementById("resultado");
var latitud;
var longitud;
if (navigator.geolocation) {
	var tiempo_de_espera = 3000;
	navigator.geolocation.getCurrentPosition(mostrarCoordenadas, mostrarError, { enableHighAccuracy: true, timeout: tiempo_de_espera, maximumAge: 0 } );
}
else {
	resultado.innerHTML ="La Geolocalización no es soportada por este navegador";
}

function mostrarCoordenadas(position) {
	latitud = parseFloat(position.coords.latitude);
	longitud = parseFloat(position.coords.longitude);
	initMap();
	resultado.innerHTML = "Latitud: " + latitud + ", Longitud: " + longitud;
}

function mostrarError(error) {
	var errores = {1: 'Permiso denegado', 2: 'Posición no disponible', 3: 'Expiró el tiempo de respuesta'};
	resultado.innerHTML ="Error: " + errores[error.code];
}

function initMap() {
	var uluru = {lat: latitud, lng: longitud};	
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 18,
		center: uluru
	});
	var marker = new google.maps.Marker({
		position: uluru,
		map: map
	});	


}