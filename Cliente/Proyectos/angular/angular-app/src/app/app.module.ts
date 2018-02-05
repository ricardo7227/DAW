import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';


import {AppComponent} from './app.component';
import {GeoService} from './geo.service';
import {Componente2Component} from './componente2/componente2.component';
import {MenuComponent} from './menu/menu.component';


const appRoutes: Routes = [
    {path: 'inicio', component: AppComponent},
    {path: 'pagina2', component: Componente2Component},
    {
        path: '',
        redirectTo: '/inicio',
        pathMatch: 'full'
    }];

@NgModule({

    declarations: [
        AppComponent,
        Componente2Component,
        MenuComponent
    ],
    imports: [
        BrowserModule,
        RouterModule.forRoot(
            appRoutes,
            {enableTracing: true} // <-- debugging purposes only
        )
    ],
    providers: [GeoService],
    bootstrap: [MenuComponent]//por defecto
})
export class AppModule {}
