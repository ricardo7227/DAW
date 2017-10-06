function obtenerPosicion(){
                 var opciones = {
                     enableHighAccuracy: true,
                     timeout: 10000,
                     maximumAge: 30000};
                 navigator.geolocation.getCurrentPosition(imprimir,avisoerror,opciones);
        }
        function imprimir(posicion){
                 document.getElementById('elemento1').innerHTML=posicion.timestamp;
                 document.getElementById('elemento2').innerHTML =posicion.coords.latitude;
                 document.getElementById('elemento3').innerHTML=posicion.coords.longitude;
                 document.getElementById('elemento4').innerHTML =posicion.coords.accuracy;
                 document.getElementById('elemento5').innerHTML =posicion.coords.altitude;
                 document.getElementById('elemento6').innerHTML=posicion.coords.altitudeAccuracy;
                 document.getElementById('elemento7').innerHTML  =posicion.coords.heading;
                 document.getElementById('elemento8').innerHTML    =posicion.coords.speed;
        }
        function avisoerror(error){
                 alert('Se ha producido el siguiente error\n' + error.message);
        }
    
window.addEventListener( 'load', obtenerPosicion, true);