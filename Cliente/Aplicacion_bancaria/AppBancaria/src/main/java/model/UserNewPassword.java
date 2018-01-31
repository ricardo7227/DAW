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
public class UserNewPassword {

    private long id;
    private String nombre;
    private String old_password;
    private String new_password;
    private String new_password_confirm;        
    private String email;

    public UserNewPassword() {
    }

    public UserNewPassword(long id, String nombre, String old_password, String new_password, String new_password_confirm, String email) {
        this.id = id;
        this.nombre = nombre;
        this.old_password = old_password;
        this.new_password = new_password;
        this.new_password_confirm = new_password_confirm;
        this.email = email;
    }

    public UserNewPassword(String old_password, String new_password, String new_password_confirm) {
        this.old_password = old_password;
        this.new_password = new_password;
        this.new_password_confirm = new_password_confirm;
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

    public String getOld_password() {
        return old_password;
    }

    public void setOld_password(String old_password) {
        this.old_password = old_password;
    }

    public String getNew_password() {
        return new_password;
    }

    public void setNew_password(String new_password) {
        this.new_password = new_password;
    }

    public String getNew_password_confirm() {
        return new_password_confirm;
    }

    public void setNew_password_confirm(String new_password_confirm) {
        this.new_password_confirm = new_password_confirm;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }
    
    

}
