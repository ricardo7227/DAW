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

    public static final String ALUMNOS = "/src/alumnos";
    public static final String ASIGNATURAS = "/asignaturas";
    public static final String NOTAS = "/notas";
    public static final String REGISTRO = "/registro";
    public static final String LOGIN = "/login";

    private static String preRelativePath = "..";

    public static String getAlumnos() {
        return preRelativePath + ALUMNOS;
    }

    public static String getAsignaturas() {
        return preRelativePath + ASIGNATURAS.substring(1);
    }

    public static String getNotas() {
        return preRelativePath + NOTAS.substring(1);
    }

    public static String getRegistro() {
        return preRelativePath + REGISTRO.substring(1);
    }

}
