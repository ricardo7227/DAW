<?php

namespace controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author daw
 */
class Constantes {

    const ACTION = "ACTION";
    const INSERT = "INSERT";
    const UPDATE = "UPDATE";
    const DELETE = "DELETE";
    const VIEW = "VIEW";
    const DELETE_FORCE = "DELETE_FORCE";

        
   
                
    const messageQueryAlumnoInserted = "El alumno fue insertado en la lista";
    const messageQueryAlumnoInsertedFail = "Alumno no agregado en la lista, vuelve a intentarlo";
    const messageQueryAlumnoUpdated = "El alumno fue actualizado en la lista";
    const messageQueryAlumnoUpdatedFail = "Problemas actualizando el alumno, inténtalo otra vez";
    const messageQueryAlumnoDeleted = "El alumno fue eliminado correctamente de la lista";
    const messageQueryAlumnoDeletedFail = "Cuidado! el alumno tiene notas, Quieres borrarlo?";
    const messageQueryAlumnoDeletedFailedAgain = "Seguimos sin poder borrar el alumno";
    
    const messageQueryAsignaturaInserted = "Asignatura fue insertado en la lista";
    const messageQueryAsignaturaInsertFailed = "Asignatura no agregada a la base de datos";
    const messageQueryAsignaturaUpdated = "Asignatura actualizada correctamente";
    const messageQueryAsignaturaUpdateFailed = "Error en la actualización de Asignatura";
    const messageQueryAsignaturaDeleted = "Asignatura eliminada correctamente";
    const messageQueryAsignaturaDeletedFail = "Cuidado! Tienes alumnos que estan cursando esta asignatura. Estás Seguro?";
    const messageQueryAsignaturaDeletedFailedAgain = "Problemas graves, no pudimos borrar la Asignatura";
    
    const messageQueryNotaMissing = "No tiene nota";
    const messageQueryNotaUpdated = "Hemos actualizado la nota correctamente";
    const messageQueryNotaUpdatedFail = "Falló en la actualización de Nota";
    
    const CodeErrorClaveForanea = 5000;
    
    const errorForeingkey = "foreign key";
    
    
    

}
