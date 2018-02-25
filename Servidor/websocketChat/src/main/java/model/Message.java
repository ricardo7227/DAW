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
 * @author daw
 */
public class Message {

    private long id;
    @SerializedName("contenido")
    @Expose
    private String mensaje;
    @SerializedName("fecha")
    @Expose
    private Date fecha;    
    @SerializedName("destino")
    @Expose
    private long id_canal;
    @SerializedName("user")
    @Expose
    private String nombre_user;
    @SerializedName("tipo")
    @Expose
    private int tipo;
    @SerializedName("guardar")
    @Expose
    private boolean guardar;

    public Message() {
    }

    public Message(long id, String mensaje, Date fecha, long id_canal, String nombre_user, int tipo, boolean guardar) {
        this.id = id;
        this.mensaje = mensaje;
        this.fecha = fecha;
        this.id_canal = id_canal;
        this.nombre_user = nombre_user;
        this.tipo = tipo;
        this.guardar = guardar;
    }

    public Message(String mensaje, Date fecha, String nombre_user, int tipo) {
        this.mensaje = mensaje;
        this.fecha = fecha;
        this.nombre_user = nombre_user;
        this.tipo = tipo;
    }

    public Message(String mensaje, String nombre_user, int tipo) {
        this.mensaje = mensaje;
        this.nombre_user = nombre_user;
        this.tipo = tipo;
        this.fecha = new java.sql.Date(new java.util.Date().getTime());
    }

    public Message( int tipo,String mensaje) {
        this.mensaje = mensaje;
        this.tipo = tipo;
    }
    

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getMensaje() {
        return mensaje;
    }

    public void setMensaje(String mensaje) {
        this.mensaje = mensaje;
    }

    public Date getFecha() {
        return fecha;
    }

    public void setFecha(Date fecha) {
        this.fecha = fecha;
    }

    public long getId_canal() {
        return id_canal;
    }

    public void setId_canal(long id_canal) {
        this.id_canal = id_canal;
    }

    public String getNombre_user() {
        return nombre_user;
    }

    public void setNombre_user(String nombre_user) {
        this.nombre_user = nombre_user;
    }

    public int getTipo() {
        return tipo;
    }

    public void setTipo(int tipo) {
        this.tipo = tipo;
    }

    public boolean isGuardar() {
        return guardar;
    }

    public void setGuardar(boolean guardar) {
        this.guardar = guardar;
    }

}//fin clase
