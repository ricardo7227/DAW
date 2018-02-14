import {Component, OnInit} from '@angular/core';
import {HttpClient} from '@angular/common/http';

@Component({
    selector: 'app-usuarios',
    templateUrl: './usuarios.component.html',
    styleUrls: ['./usuarios.component.css']
})
export class UsuariosComponent implements OnInit {

    rows: any = [];
    columns = [{name: 'ID', prop: 'id'}, {name: 'Nombre', prop: 'first_name'}, {name: 'Apellidos', prop: 'last_name'}];
    constructor(private http: HttpClient) {}

    ngOnInit() {
        this.http.get('https://reqres.in/api/users?page=2').subscribe(resp => {
            this.rows = resp["data"];
        });
    }
}
