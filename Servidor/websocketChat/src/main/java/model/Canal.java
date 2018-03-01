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

    @SerializedName("id")
    @Expose
    private long id;
    @SerializedName("canal")
    @Expose
    private String nombre;
    private String admin;
    @SerializedName("password")
    @Expose
    private String clave;
    @SerializedName("salt")
    @Expose
    private String salt;
    @SerializedName("iv")
    @Expose
    private String iv;

    public Canal() {
    }

    public Canal(String admin) {
        this.admin = admin;
    }

    public Canal(long id) {
        this.id = id;
    }

    public Canal(long id, String nombre) {
        this.id = id;
        this.nombre = nombre;
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

    public String getSalt() {
        return salt;
    }

    public void setSalt(String salt) {
        this.salt = salt;
    }

    public String getIv() {
        return iv;
    }

    public void setIv(String iv) {
        this.iv = iv;
    }

    @Override
    public int hashCode() {
        int hash = 7;
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        Canal c = (Canal) obj;
        if (this.getId() == c.getId()) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Canal other = (Canal) obj;
        if (this.id != other.id) {
            return false;
        }
        return true;
    }
    
    

}//fin clase
