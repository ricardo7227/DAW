/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.sql.Date;
import utilidades.validacion.InterfaceValidator.Required;

/**
 *
 * @author daw
 */
public class MovimientosFechas {
    @Required
    private long id_cuenta;
    @Required
    private Date fecha_inicio;
    @Required
    private Date fecha_fin;

    public MovimientosFechas(long id_cuenta, Date fecha_inicio, Date fecha_fin) {
        this.id_cuenta = id_cuenta;
        this.fecha_inicio = fecha_inicio;
        this.fecha_fin = fecha_fin;
    }

    public MovimientosFechas() {
    }

    public long getId_cuenta() {
        return id_cuenta;
    }

    public void setId_cuenta(long id_cuenta) {
        this.id_cuenta = id_cuenta;
    }

    public Date getFecha_inicio() {
        return fecha_inicio;
    }

    public void setFecha_inicio(Date fecha_inicio) {
        this.fecha_inicio = fecha_inicio;
    }

    public Date getFecha_fin() {
        return fecha_fin;
    }

    public void setFecha_fin(Date fecha_fin) {
        this.fecha_fin = fecha_fin;
    }
    
    
}
