var mapa;

		function iniciar() {
			var opciones = {
			  zoom: 9,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			mapa = new google.maps.Map(document.getElementById('divmapa'), opciones);
			if (navigator.geolocation)
			{
				navigator.geolocation.getCurrentPosition(Localizar,ControladordeErrores);
			}
		}

	    function Localizar(posicion)
	     {
            var pos = new google.maps.LatLng(posicion.coords.latitude,posicion.coords.longitude);
            //Muestro un tooltip con un mensaje sobre el mapa
            var infowindow = new google.maps.InfoWindow({
              map: mapa,
              position: pos,
              content: 'Te encuentras aquí'
            });

            mapa.setCenter(pos);
	      }

	    function ControladordeErrores(error) {

		   switch(error.code)
            {
                case error.PERMISSION_DENIED: alert("El usuario no permite compartir datos de geolocalizacion");
                break;

                case error.POSITION_UNAVAILABLE: alert("Imposible detectar la posicio actual");
                break;

                case error.TIMEOUT: alert("La posicion debe recuperar el tiempo de espera");
                break;

                default: alert("Error desconocido");
                break;
            }
			var opciones = {
			  map: mapa,
			  position: new google.maps.LatLng(60, 105),
			  content: content
			};
			var infowindow = new google.maps.InfoWindow(opciones);
			mapa.setCenter(opciones.position);
      }


      //Listener para que cargue la funcion iniciar al acabar de cargar la pagina
      google.maps.event.addDomListener(window, 'load', iniciar);