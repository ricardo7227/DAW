/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

/**
 *
 * @author Gato
 */
public class Canal {

    private long id;
    @SerializedName("canal")
    @Expose
    private String nombre;
    private String admin;
    @SerializedName("password")
    @Expose
    private String clave;

    public Canal() {
    }

    public Canal(long id, String nombre, String admin, String clave) {
        this.id = id;
        this.nombre = nombre;
        this.admin = admin;
        this.clave = clave;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getAdmin() {
        return admin;
    }

    public void setAdmin(String admin) {
        this.admin = admin;
    }

    public String getClave() {
        return clave;
    }

    public void setClave(String clave) {
        this.clave = clave;
    }

}//fin clase
