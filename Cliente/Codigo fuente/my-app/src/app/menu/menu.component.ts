import {Component, OnInit} from '@angular/core';
import {AuthGuardService} from '../auth.service';
@Component({
    selector: 'app-root',
    templateUrl: './menu.component.html',
    styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {
    public options = {
        position: ["bottom", "left"],
        timeOut: 5000,
        lastOnBottom: true
    }
    constructor(private loggedIn:AuthGuardService) {}

    ngOnInit() {
    }

}
