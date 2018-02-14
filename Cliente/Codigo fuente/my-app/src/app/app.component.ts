import {Component, OnInit} from '@angular/core';
import {GeolocalizacionService} from './geolocalizacion.service';
import {NotificationsService} from 'angular2-notifications';


@Component({
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
    title = 'hOLA';
    public miNumero: number = 5;
    constructor(geo: GeolocalizacionService, private notificar: NotificationsService) {
        console.log(geo.getCoords());
    }
    ngOnInit() {
        this.notificar.success(
            'Mi primera notificación',
            'WOLAAAAAAAAAAA',
            {
                timeOut: 5000,
                showProgressBar: true,
                pauseOnHover: false,
                clickToClose: false,
                maxLength: 10
            }
        )
        this.miNumero = 0;
    }
    public getMiNumero(): number {
        return this.miNumero;
    }
    public setMiNumero() {
        this.miNumero++;
    }
}
