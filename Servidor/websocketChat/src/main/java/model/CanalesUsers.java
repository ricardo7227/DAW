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
public class CanalesUsers {

    private long id_canal;
    private String user;

    public CanalesUsers() {
    }

    public CanalesUsers(long id_canal, String user) {
        this.id_canal = id_canal;
        this.user = user;
    }

    public long getId_canal() {
        return id_canal;
    }

    public void setId_canal(long id_canal) {
        this.id_canal = id_canal;
    }

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
    }

}
