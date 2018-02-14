import {Component, OnInit} from '@angular/core';
import {FormGroup, FormControl, NgForm} from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {NotificationsService} from 'angular2-notifications';

@Component({
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

    formulario: FormGroup = new FormGroup({
        email: new FormControl(),
        password: new FormControl()
    });
    constructor(private http: HttpClient,
        private notificar: NotificationsService,
        private router: Router) {}

    ngOnInit() {
    }
    onSubmit(userLogin: NgForm) {
        this.http.post('https://reqres.in/api/login', userLogin.value).subscribe(resp => {
            this.notificar.success(
                'Conectado satisfactoriamente',
                'Muy bien muy bieeeeeen',
                {
                    timeOut: 5000,
                    showProgressBar: true,
                    pauseOnHover: false,
                    clickToClose: false,
                    maxLength: 10
                }
            );
            localStorage.setItem("token", resp["token"]);
            this.router.navigateByUrl("usuarios");
        },
            err => {
                this.notificar.error(
                    'No se ha podido conectar',
                    'Muy mal muy maaaaaaaaaaaaaaaaaal',
                    {
                        timeOut: 5000,
                        showProgressBar: true,
                        pauseOnHover: false,
                        clickToClose: false,
                        maxLength: 10
                    }
                );
            });
    }
}
