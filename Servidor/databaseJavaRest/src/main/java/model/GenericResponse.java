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
public class GenericResponse {
    public long code;
    public String description;

    public GenericResponse() {
    }

    public GenericResponse(long codeError, String descripError) {
        this.code = codeError;
        this.description = descripError;
    }

    public long getCodeError() {
        return code;
    }

    public void setCodeError(long codeError) {
        this.code = codeError;
    }

    public String getDescripError() {
        return description;
    }

    public void setDescripError(String descripError) {
        this.description = descripError;
    }
    
    
}
