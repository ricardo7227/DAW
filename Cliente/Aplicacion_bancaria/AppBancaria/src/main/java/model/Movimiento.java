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
public class Movimiento {

    @Required
    private long mo_ncu;
    private Date mo_fec;
    private String mo_hor;
    @Required
    private String mo_des;
    @Required
    private long mo_imp;

    public Movimiento(long mo_ncu, Date mo_fec, String mo_hor, String mo_des, long mo_imp) {
        this.mo_ncu = mo_ncu;
        this.mo_fec = mo_fec;
        this.mo_hor = mo_hor;
        this.mo_des = mo_des;
        this.mo_imp = mo_imp;
    }

    public Movimiento(long mo_ncu, String mo_des, long mo_imp) {
        this.mo_ncu = mo_ncu;
        this.mo_des = mo_des;
        this.mo_imp = mo_imp;
    }

    public Movimiento(long mo_ncu) {
        this.mo_ncu = mo_ncu;
    }

    public Movimiento() {
    }

    public long getMo_ncu() {
        return mo_ncu;
    }

    public void setMo_ncu(long mo_ncu) {
        this.mo_ncu = mo_ncu;
    }

    public Date getMo_fec() {
        return mo_fec;
    }

    public void setMo_fec(Date mo_fec) {
        this.mo_fec = mo_fec;
    }

    public String getMo_hor() {
        return mo_hor;
    }

    public void setMo_hor(String mo_hor) {
        this.mo_hor = mo_hor;
    }

    public String getMo_des() {
        return mo_des;
    }

    public void setMo_des(String mo_des) {
        this.mo_des = mo_des;
    }

    public long getMo_imp() {
        return mo_imp;
    }

    public void setMo_imp(long mo_imp) {
        this.mo_imp = mo_imp;
    }

}
