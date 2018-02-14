import { BrowserModule } from '@angular/platform-browser';
import { NgModule,CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';


import { AppComponent } from './app.component';
import {GeolocalizacionService} from './geolocalizacion.service';
import { Component2Component } from './component2/component2.component';
import { MenuComponent } from './menu/menu.component';
import { RouterModule, Routes } from '@angular/router';

const appRoutes: Routes = [
 { path: 'inicio', component: AppComponent },
 { path: 'pagina2', component: Component2Component },
 { path: '',
 redirectTo: '/inicio',
 pathMatch: 'full'
 }
];

@NgModule({
  declarations: [
    AppComponent,
    Component2Component,
    MenuComponent
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(appRoutes)
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
  providers: [GeolocalizacionService],
  bootstrap: [MenuComponent]
})
export class AppModule { }
