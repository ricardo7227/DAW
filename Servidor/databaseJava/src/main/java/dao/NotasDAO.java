/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;


import java.math.BigInteger;
import java.sql.Connection;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;


import java.util.logging.Level;
import java.util.logging.Logger;
import model.Asignatura;


import model.Nota;
import org.apache.commons.dbutils.QueryRunner;
import org.apache.commons.dbutils.ResultSetHandler;
import org.apache.commons.dbutils.handlers.BeanHandler;
import org.apache.commons.dbutils.handlers.ScalarHandler;

import utils.SqlQuery;

/**
 *
 * @author daw
 */
public class NotasDAO {

    public Nota getNotadbUtils(int idAlumno, int idAsignatura) {
        Nota nota = null;
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();

            Object[] params = new Object[2];
            params[0] = idAlumno;
            params[1] = idAsignatura;
            ResultSetHandler<Nota> handler
                    = new BeanHandler<Nota>(Nota.class);
            nota = qr.query(con, SqlQuery.SELECT_NOTA, handler, idAsignatura);

        } catch (Exception ex) {
            Logger.getLogger(NotasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return nota;
    }

    public Nota getNotaJDBC(int idAlumno, int idAsignatura) {
        Nota nota = null;
        DBConnection dBConnection = new DBConnection();
        Connection connection = null;
        ResultSet rs = null;
        PreparedStatement stmt = null;
        try {
            connection = dBConnection.getConnection();

            stmt = connection.prepareStatement(SqlQuery.SELECT_NOTA);

            stmt.setInt(1, idAsignatura);
            stmt.setInt(2, idAlumno);

            rs = stmt.executeQuery();

            while (rs.next()) {
                //Retrieve by column name
                int idAl = rs.getInt(SqlQuery.ID_ALUMNO);
                int idAs = rs.getInt(SqlQuery.ID_ASIGNATURA);
                int notaRs = rs.getInt(SqlQuery.NOTA);

                nota = new Nota();
                nota.setId_alumno(idAl);
                nota.setId_asignatura(idAs);
                nota.setNota(notaRs);
            }

        } catch (Exception e) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, e);
        } finally {
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            dBConnection.cerrarConexion(connection);
        }
        return nota;
    }
    
    public int updateNotadbUtils(Nota nota) {
        int filas = -1;
        DBConnection db = new DBConnection();
        Connection con = null;

        try {
            con = db.getConnection();

            QueryRunner qr = new QueryRunner();

            filas = qr.update(con,
                    SqlQuery.UPDATE_ASIGNATURA,
                   nota.getNota());

        } catch (Exception ex) {
            Logger.getLogger(AsignaturasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }

        return filas;
    }
    
}//fin clase
