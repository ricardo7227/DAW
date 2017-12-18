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

    public static final String COCHES = "/privado/coches";
    public static final String ASIGNATURAS = "/privado/asignaturas";
    public static final String NOTAS = "/privado/notas";
    public static final String LOGIN = "/login";
    public static final String PRIVADO = "/privado/*";

    public String logout = LOGIN + "?" + Constantes.actionJSP + "=" + Constantes.LOGOUT;

    private static final String PRERELATIVEPATH = "..";

    public static String getAlumnos() {
        return COCHES;
    }

    public static String getAsignaturas() {
        return ASIGNATURAS;
    }

    public static String getNotas() {
        return NOTAS;
    }

    public static String getRegistro() {
        return LOGIN;
    }

    public static String getAlumnosRelative() {
        return PRERELATIVEPATH + COCHES;
    }

    public static String getAsignaturasRelative() {
        return PRERELATIVEPATH + ASIGNATURAS;
    }

    public static String getNotasRelative() {
        return PRERELATIVEPATH + NOTAS;
    }

    public static String getRegistroRelative() {
        return PRERELATIVEPATH + LOGIN;
    }

    public String getLogout() {
        return logout;
    }

    public void setLogout(String logout) {
        this.logout = logout;
    }

}//fin clase
