/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

/**
 *
 * @author Gato
 */
public class CanalUser {

    private long id_canal;
    private String nombre;
    private String admin;
    private String user;

    public CanalUser(long id_canal, String nombre, String admin, String user) {
        this.id_canal = id_canal;
        this.nombre = nombre;
        this.admin = admin;
        this.user = user;
    }

    public CanalUser() {
    }

    public long getId_canal() {
        return id_canal;
    }

    public void setId_canal(long id_canal) {
        this.id_canal = id_canal;
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

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
    }

}
