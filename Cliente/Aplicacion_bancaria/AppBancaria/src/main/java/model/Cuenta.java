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
    private String cu_dni1;
    private String cu_dni2;
    private float cu_sal;

    public Cuenta(long cu_ncu, String cu_dni1, String cu_dni2, float cu_sal) {
        this.cu_ncu = cu_ncu;
        this.cu_dni1 = cu_dni1;
        this.cu_dni2 = cu_dni2;
        this.cu_sal = cu_sal;
    }

    public Cuenta() {
    }

    public long getCu_ncu() {
        return cu_ncu;
    }

    public void setCu_ncu(long cu_ncu) {
        this.cu_ncu = cu_ncu;
    }

    public String getCu_dni1() {
        return cu_dni1;
    }

    public void setCu_dni1(String cu_dni1) {
        this.cu_dni1 = cu_dni1;
    }

    public String getCu_dni2() {
        return cu_dni2;
    }

    public void setCu_dni2(String cu_dni2) {
        this.cu_dni2 = cu_dni2;
    }

    public float getCu_sal() {
        return cu_sal;
    }

    public void setCu_sal(float cu_sal) {
        this.cu_sal = cu_sal;
    }
       
}
