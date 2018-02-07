/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

/**
 *
 * @author daw
 */
public class Cuenta {

    private long cu_ncu;
    private String cu_dn1;
    private String cu_dn2;
    private float cu_sal;

    public Cuenta(long cu_ncu, String cu_dn1, String cu_dn2, float cu_sal) {
        this.cu_ncu = cu_ncu;
        this.cu_dn1 = cu_dn1;
        this.cu_dn2 = cu_dn2;
        this.cu_sal = cu_sal;
    }

    public Cuenta(long cu_ncu) {
        this.cu_ncu = cu_ncu;
    }

    public Cuenta() {
    }

    public long getCu_ncu() {
        return cu_ncu;
    }

    public void setCu_ncu(long cu_ncu) {
        this.cu_ncu = cu_ncu;
    }

    public String getCu_dn1() {
        return cu_dn1;
    }

    public void setCu_dn1(String cu_dn1) {
        this.cu_dn1 = cu_dn1;
    }

    public String getCu_dn2() {
        return cu_dn2;
    }

    public void setCu_dn2(String cu_dn2) {
        this.cu_dn2 = cu_dn2;
    }

    public float getCu_sal() {
        return cu_sal;
    }

    public void setCu_sal(float cu_sal) {
        this.cu_sal = cu_sal;
    }

}
