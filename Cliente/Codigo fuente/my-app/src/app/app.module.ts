import {BrowserModule} from '@angular/platform-browser';
import {NgModule, CUSTOM_ELEMENTS_SCHEMA} from '@angular/core';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import {AppComponent} from './app.component';
import {GeolocalizacionService} from './geolocalizacion.service';
import {Component2Component} from './component2/component2.component';
import {MenuComponent} from './menu/menu.component';
import {RouterModule, Routes} from '@angular/router';
import {SimpleNotificationsModule} from 'angular2-notifications';
import { LoadingBarRouterModule } from '@ngx-loading-bar/router';
 import { HttpClientModule } from '@angular/common/http';
import { UsuariosComponent } from './usuarios/usuarios.component';
import { AuthGuardService } from './auth.service';
import { NotAuthGuardService } from './notauth.service';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { LoginComponent } from './login/login.component';
import { FormsModule }   from '@angular/forms';
import { LogoutComponent } from './logout/logout.component';

const appRoutes: Routes = [
    {path: 'inicio', component: AppComponent},
    {path: 'pagina2', component: Component2Component},
    {
        path: 'usuarios',
        component: UsuariosComponent,
        canActivate: [AuthGuardService]
    },
    {
        path: 'login',
        component: LoginComponent,
        canActivate: [NotAuthGuardService]
    },
    {
        path: 'logout',
        component: LogoutComponent,
        canActivate: [AuthGuardService]
    },
    {
        path: '**',
        redirectTo: '/inicio',
        pathMatch: 'full'
    }
];

@NgModule({
    declarations: [
        AppComponent,
        Component2Component,
        MenuComponent,
        UsuariosComponent,
        LoginComponent,
        LogoutComponent,
    ],
    imports: [
        BrowserModule,
        RouterModule.forRoot(appRoutes),
        BrowserAnimationsModule,
        SimpleNotificationsModule.forRoot(),
        LoadingBarRouterModule,
        HttpClientModule,
        NgxDatatableModule,
        FormsModule
    ],
    schemas: [CUSTOM_ELEMENTS_SCHEMA],
    providers: [GeolocalizacionService,AuthGuardService,NotAuthGuardService],
    bootstrap: [MenuComponent]
})
export class AppModule {}
