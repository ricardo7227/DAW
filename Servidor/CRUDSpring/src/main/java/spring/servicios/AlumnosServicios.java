/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package spring.servicios;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import spring.dao.AlumnosDAO;
import spring.model.Alumno;

/**
 *
 * @author oscar
 */
@Service
public class AlumnosServicios {

    @Autowired
    private AlumnosDAO dao;

    @Transactional(readOnly = true)
    public List<Alumno> getAllAlumnos() {
        return dao.getAllAlumnos();
    }

    @Transactional
    public void updateAlumno(Alumno alumno) {
        dao.updateAlumno(alumno);
    }

    @Transactional
    public void insertAlumno(Alumno alumno) {

        dao.insertAlumno(alumno);
    }

    @Transactional
    public void deleteAlumno(Alumno alumno) {

        dao.deleteAlumno(alumno);
    }

}//fin clase
