import {Injectable} from '@angular/core';
@Injectable()
    export class GeoService {
    
        getCoords(){
            if (navigator.geolocation){
                return navigator.geolocation.getCurrentPosition(this.devolverPosition);
            } else{
                return "Error localización";
            }
            
        }
        
     private   devolverPosition(pos: any) {
         return{
             "lat":pos.coords.latitude,
             "lng":pos.coords.longitude
         }
    }
    }