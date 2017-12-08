/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package utils;

/**
 *
 * @author daw
 */
public class UrlsPaths {

    public static final String ALUMNOS = "/privado/alumnos";
    public static final String ASIGNATURAS = "/privado/asignaturas";
    public static final String NOTAS = "/privado/notas";
    public static final String REGISTRO = "/registro";
    public static final String PRIVADO = "/privado/*";

    private static String preRelativePath = "..";

    public static String getAlumnos() {
        return ALUMNOS;
    }

    public static String getAsignaturas() {
        return ASIGNATURAS;
    }

    public static String getNotas() {
        return NOTAS;
    }

    public static String getRegistro() {
        return REGISTRO;
    }

    public static String getLOGOUT() {
        return REGISTRO + "?" + Constantes.actionJSP + "=" + Constantes.LOGOUT;
    }

    public static String getAlumnosRelative() {
        return preRelativePath + ALUMNOS;
    }

    public static String getAsignaturasRelative() {
        return preRelativePath + ASIGNATURAS;
    }

    public static String getNotasRelative() {
        return preRelativePath + NOTAS;
    }

    public static String getRegistroRelative() {
        return preRelativePath + REGISTRO;
    }

}
