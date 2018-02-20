/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.sql.Date;

/**
 *
 * @author daw
 */
public class Message {

    private long id;
    private int tipo;
    private String contenido;
    private long canal;
    private Date fecha;
    private long user;
    private boolean guardar;

    public Message(long id, int tipo, String contenido, long canal, Date fecha, long user, boolean guardar) {
        this.id = id;
        this.tipo = tipo;
        this.contenido = contenido;
        this.canal = canal;
        this.fecha = fecha;
        this.user = user;
        this.guardar = guardar;
    }

    public Message() {
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public int getTipo() {
        return tipo;
    }

    public void setTipo(int tipo) {
        this.tipo = tipo;
    }

    public String getContenido() {
        return contenido;
    }

    public void setContenido(String contenido) {
        this.contenido = contenido;
    }

    public long getCanal() {
        return canal;
    }

    public void setCanal(long canal) {
        this.canal = canal;
    }

    public Date getFecha() {
        return fecha;
    }

    public void setFecha(Date fecha) {
        this.fecha = fecha;
    }

    public long getUser() {
        return user;
    }

    public void setUser(long user) {
        this.user = user;
    }

    public boolean isGuardar() {
        return guardar;
    }

    public void setGuardar(boolean guardar) {
        this.guardar = guardar;
    }

}//fin clase
