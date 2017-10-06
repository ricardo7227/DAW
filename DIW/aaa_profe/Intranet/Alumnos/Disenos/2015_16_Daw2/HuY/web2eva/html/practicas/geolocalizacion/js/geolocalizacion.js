function getLocation(){
	var opciones = {
		enableHighAccuracy: true,
		timeout: 10000,
		maximumAge: 30000};
		navigator.geolocation.getCurrentPosition(showPosition, showError, opciones);
	}
        
function showPosition(posicion){
    lat = posicion.coords.latitude;
    lon = posicion.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon)
    mapholder = document.getElementById('mapholder')
    mapholder.style.height = '300px';
    mapholder.style.width = '600px';

    var myOptions = {
    center:latlon,zoom:16,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}}
            
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new google.maps.Marker({position:latlon,map:map,title:"¡Aqui estás!"});
            
    document.getElementById('timestamp').innerHTML="Timestamp: "+posicion.timestamp;
	document.getElementById('latitude').innerHTML="Latitude: "+posicion.coords.latitude;
	document.getElementById('longitude').innerHTML="Longitude: "+posicion.coords.longitude;
	document.getElementById('accuracy').innerHTML="Accuracy: "+posicion.coords.accuracy;
	document.getElementById('altitude').innerHTML="Altitude: "+posicion.coords.altitude;
	document.getElementById('altitudeAccuracy').innerHTML="Altitude Accuragy: "+posicion.coords.altitudeAccuracy;
}
			
function showError(error){
	switch(error.code) {
        case error.PERMISSION_DENIED:
			document.getElementById("mapholder").innerHTML = "User denied the request for Geolocation."
			break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("mapholder").innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            document.getElementById("mapholder").innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("mapholder").innerHTML = "An unknown error occurred."
            break;
    }
}