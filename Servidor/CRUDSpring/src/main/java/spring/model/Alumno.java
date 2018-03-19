/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package spring.model;

import java.io.Serializable;
import java.sql.Date;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.validation.constraints.Size;
import org.hibernate.validator.constraints.NotEmpty;

/**
 *
 * @author oscar
 */
@Entity
@Table(name = "TBL_ALUMNOS")
public class Alumno implements Serializable {

    @Id
    @GeneratedValue
    @Column(name = "ALUMNO_ID")
    private long id;
    @Column(name = "ALUMNO_NOMBRE")
    @Size(max = 100, min = 3, message = "{user.name.invalid}")
    @NotEmpty(message = "Please Enter your name")
    private String nombre;

    @Column(name = "ALUMNO_FNACIMIENTO")    
    
    private Date fecha_nacimiento;
    @Column(name = "ALUMNO_MAYOREDAD")    
    @Basic(optional = false)    
    private Boolean mayor_edad;

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

    public Date getFecha_nacimiento() {
        return fecha_nacimiento;
    }

    public void setFecha_nacimiento(Date fecha_nacimiento) {
        this.fecha_nacimiento = fecha_nacimiento;
    }

    public Boolean getMayor_edad() {
        return mayor_edad;
    }

    public void setMayor_edad(Boolean mayor_edad) {
        this.mayor_edad = mayor_edad;
    }

    public Alumno() {
    }

}
