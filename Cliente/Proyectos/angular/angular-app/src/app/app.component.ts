//import { Component } from '@angular/core';
import {Component, OnInit} from '@angular/core';
import {GeoService} from './geo.service';
@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    //template: '<html> ',
    styleUrls: ['./app.component.css']


})
export class AppComponent implements OnInit {
    public myNumber: number = 1222;
    
    constructor(private geo: GeoService){
        console.log(geo.getCoords());
        
    }
    ngOnInit(): void {
        this.myNumber = 0;
    }
    title = 'Aplicación de Angular 5 Asterisk ';


    public getMyNumber(): number {
        return this.myNumber;
    }
    public setMyNumber() {
        this.myNumber++;
    }

}
