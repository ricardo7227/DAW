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
public class Login {
    private long id;
    private String nombre;
    private String password;
    private Date fecha_login;

    public Login() {
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

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public Date getFecha_login() {
        return fecha_login;
    }

    public void setFecha_login(Date fecha_activacion) {
        this.fecha_login = fecha_activacion;
    }
    
}
