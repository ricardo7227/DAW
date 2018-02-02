/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import com.google.api.client.util.Key;
import java.util.List;

/**
 *
 * @author daw
 */
public class Alumnos {

    @Key
    public List<Alumno> alumnos;

    public Alumnos(List<Alumno> alumnos) {
        this.alumnos = alumnos;
    }

    public Alumnos() {
    }

    public List<Alumno> getAlumnos() {
        return alumnos;
    }

    public void setAlumnos(List<Alumno> alumnos) {
        this.alumnos = alumnos;
    }

}
