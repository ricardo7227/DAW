/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;
import java.sql.Date;

/**
 *
 * @author Gato
 */
public class RangoMensajes {

    private String user;
    @SerializedName("fecha1")
    @Expose
    private Date fecha1;
    @SerializedName("fecha2")
    @Expose
    private Date fecha2;

    public RangoMensajes() {
    }

    public RangoMensajes(String user, Date fecha1, Date fecha2) {
        this.user = user;
        this.fecha1 = fecha1;
        this.fecha2 = fecha2;
    }

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
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
