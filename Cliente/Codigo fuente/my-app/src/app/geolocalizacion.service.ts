import {Injectable} from "@angular/core";

@Injectable()
export class GeolocalizacionService {
    getCoords()
    {
        if(navigator.geolocation)
        {
            return navigator.geolocation.getCurrentPosition(this.devolverPosicion);
        }
    }
    private devolverPosicion(position:any)
    {
        return {
            "lat": position.coords.latitude,
            "lng": position.coords.longitude
        };
    }
}