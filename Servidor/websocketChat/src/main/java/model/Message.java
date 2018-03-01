/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;
import java.sql.Timestamp;

/**
 *
 * @author daw
 */
public class Message {

    private long id;
    @SerializedName("contenido")
    @Expose
    private String contenido;
    @SerializedName("fecha")
    @Expose
    private Timestamp fecha;
    @SerializedName("destino")
    @Expose
    private long destino;
    @SerializedName("user")
    @Expose
    private String user;
    @SerializedName("tipo")
    @Expose
    private int tipo;
    @SerializedName("guardar")
    @Expose
    private boolean guardar;
    @SerializedName("key")
    @Expose
    private String key;
    @SerializedName("iv")
    @Expose
    private String iv;
    @SerializedName("salt")
    @Expose
    private String salt;

    public Message() {
    }

    public Message(long id, String mensaje, Timestamp fecha, long id_canal, String nombre_user, int tipo, boolean guardar) {
        this.id = id;
        this.contenido = mensaje;
        this.fecha = fecha;
        this.destino = id_canal;
        this.user = nombre_user;
        this.tipo = tipo;
        this.guardar = guardar;
    }

    public Message(String mensaje, Timestamp fecha, String nombre_user, int tipo) {
        this.contenido = mensaje;
        this.fecha = fecha;
        this.user = nombre_user;
        this.tipo = tipo;
    }

    public Message(String mensaje, String nombre_user, int tipo) {
        this.contenido = mensaje;
        this.user = nombre_user;
        this.tipo = tipo;
        this.fecha = new java.sql.Timestamp(new java.util.Date().getTime());
    }
    public Message(String mensaje, String nombre_user, int tipo,int destino) {
        this.contenido = mensaje;
        this.user = nombre_user;
        this.tipo = tipo;
        this.fecha = new java.sql.Timestamp(new java.util.Date().getTime());
        this.destino = destino;
    }

    public Message(int tipo, String mensaje) {
        this.contenido = mensaje;
        this.tipo = tipo;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getMensaje() {
        return contenido;
    }

    public void setMensaje(String mensaje) {
        this.contenido = mensaje;
    }

    public Timestamp getFecha() {
        return fecha;
    }

    public void setFecha(Timestamp fecha) {
        this.fecha = fecha;
    }

    public long getId_canal() {
        return destino;
    }

    public void setId_canal(long id_canal) {
        this.destino = id_canal;
    }

    public String getNombre_user() {
        return user;
    }

    public void setNombre_user(String nombre_user) {
        this.user = nombre_user;
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

    public String getKey() {
        return key;
    }

    public void setKey(String key) {
        this.key = key;
    }

    public String getIv() {
        return iv;
    }

    public void setIv(String iv) {
        this.iv = iv;
    }

    public String getSalt() {
        return salt;
    }

    public void setSalt(String salt) {
        this.salt = salt;
    }

}//fin clase
