import {Injectable} from '@angular/core';
import {Router, CanActivate} from '@angular/router';
@Injectable()
export class AuthGuardService implements CanActivate {
    constructor(public router: Router) {}
    canActivate(): boolean {
        return this.isUserLoggedIn();
    }
    isUserLoggedIn() {
        const token = localStorage.getItem('token');
        return token != null && token != "";
    }
}