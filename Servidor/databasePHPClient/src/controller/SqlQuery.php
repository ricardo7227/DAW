<?php
/**
 *
 * @author daw
 */
namespace controller;

class SqlQuery {

    const ALUMNOS = "ALUMNOS";
    //Nombre columnas tabla Alumnos
    const ID = "ID";
    const NOMBRE = "NOMBRE";
    const FECHA_NACIMIENTO = "FECHA_NACIMIENTO";
    const MAYOR_EDAD = "MAYOR_EDAD";

    const ASIGNATURAS = "ASIGNATURAS";
    //columnas tabla Asignaturas
    const CURSO = "CURSO";
    const CICLO = "CICLO";
    
    const NOTAS = "NOTAS";
    //columnas tabla notas
    const ID_ALUMNO = "ID_ALUMNO";
    const ID_ASIGNATURA = "ID_ASIGNATURA";
    const NOTA = "NOTA";

    const SELECT_ALL_ALUMNOS = "SELECT * FROM ALUMNOS";
    const UPDATE_ALUMNO = "UPDATE ALUMNOS SET NOMBRE = ? , FECHA_NACIMIENTO = ?, MAYOR_EDAD = ? WHERE ID = ?";
    const INSERT_ALUMNO = "INSERT INTO ALUMNOS (NOMBRE, FECHA_NACIMIENTO, MAYOR_EDAD)  VALUES ( ?, ?, ?)";
    const DELETE_ALUMNO = "DELETE FROM ALUMNOS WHERE ID = ? ";

    const SELECT_ALL_ASIGNATURAS = "SELECT * FROM ASIGNATURAS";
    const INSERT_ASIGNATURA = "INSERT INTO ASIGNATURAS (NOMBRE, CURSO, CICLO) VALUES(?,?,?)";
    const UPDATE_ASIGNATURA = "UPDATE ASIGNATURAS SET NOMBRE= ? , CURSO = ? , CICLO = ? WHERE ID = ?";
    const DELETE_ASIGNATURA = "DELETE FROM ASIGNATURAS WHERE ID = ? ";
          

    //FORCE-DELETE
    const DELETE_NOTA_ALUMNO = "DELETE FROM NOTAS WHERE ID_ALUMNO = ? ";
    const DELETE_NOTA_ASIGNATURA = "DELETE FROM NOTAS WHERE ID_ASIGNATURA = ? ";
    
    
}
