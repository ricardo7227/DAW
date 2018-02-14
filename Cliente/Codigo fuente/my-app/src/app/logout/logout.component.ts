import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {NotificationsService} from 'angular2-notifications';

@Component({
    template: ''
})
export class LogoutComponent implements OnInit {

    constructor(private notificar: NotificationsService,
        private router: Router) {}

    ngOnInit() {
        localStorage.clear();
        this.notificar.info(
            'Te has desconectado',
            '¡Se han quitado las opciones del menú en tiempo real! :o',
            {
                timeOut: 5000,
                showProgressBar: true,
                pauseOnHover: false,
                clickToClose: false,
                maxLength: 10
            }
        );
        this.router.navigateByUrl("login");
    }
}
