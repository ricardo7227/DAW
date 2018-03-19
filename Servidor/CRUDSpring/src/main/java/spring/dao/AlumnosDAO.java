/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package spring.dao;

import java.util.List;
import javax.persistence.TypedQuery;

import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;
import spring.model.Alumno;


/**
 *
 * @author oscar
 */
@Repository
public class AlumnosDAO {

    @Autowired
    private SessionFactory sessionFactory;

    public List<Alumno> getAllAlumnos() {
        @SuppressWarnings("unchecked")
        TypedQuery<Alumno> query = sessionFactory.getCurrentSession().createQuery("from Alumno");
        return query.getResultList();

    }

    public Long insertAlumno(Alumno alumno) {
        return (Long) sessionFactory.getCurrentSession().save(alumno);
    }

    public void updateAlumno(Alumno alumno) {
        sessionFactory.getCurrentSession().update(alumno);
    }

    public void deleteAlumno(Alumno alumno) {
        sessionFactory.getCurrentSession().delete(alumno);        
    }
    
    

}//fin clase
