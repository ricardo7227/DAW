/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.sql.Date;

/**
 *
 * @author Gato
 */
public class RangoMensajes {

    private long id_canal;
    private Date fecha1;
    private Date fecha2;

    public RangoMensajes(long id_canal, Date fecha1, Date fecha2) {
        this.id_canal = id_canal;
        this.fecha1 = fecha1;
        this.fecha2 = fecha2;
    }

    public RangoMensajes() {
    }

    public long getId_canal() {
        return id_canal;
    }

    public void setId_canal(long id_canal) {
        this.id_canal = id_canal;
    }

    public Date getFecha1() {
        return fecha1;
    }

    public void setFecha1(Date fecha1) {
        this.fecha1 = fecha1;
    }

    public Date getFecha2() {
        return fecha2;
    }

    public void setFecha2(Date fecha2) {
        this.fecha2 = fecha2;
    }

}
