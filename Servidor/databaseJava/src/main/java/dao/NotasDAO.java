/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;



import java.sql.Connection;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;


import java.util.logging.Level;
import java.util.logging.Logger;




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
    
    public boolean updateNotadbUtils(Nota nota) {
        int filas = -1;
        boolean updated = false;
        DBConnection db = new DBConnection();
        Connection con = null;

        try {
            con = db.getConnection();

            QueryRunner qr = new QueryRunner();

            filas = qr.update(con,
                    SqlQuery.UPDATE_NOTA,
                   nota.getNota(),
                   nota.getId_alumno(),
                   nota.getId_asignatura());
           
            if (filas > 0) {
                updated = true;
            }
        } catch (Exception ex) {
            Logger.getLogger(NotasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }

        return updated;
    }
    @Deprecated
    public boolean insertNotadbUtils(Nota nota) {
        DBConnection db = new DBConnection();
        Connection con = null;
        boolean insertado = false;
        try {
            con = db.getConnection();

            QueryRunner qr = new QueryRunner();

            int id = qr.insert(con,
                    SqlQuery.INSERT_NOTAS,
                    new ScalarHandler<Integer>(),
                   nota.getId_alumno(), nota.getId_asignatura(),nota.getNota());

            if (id > 0) {
                insertado = Boolean.TRUE;
            }

        } catch (Exception ex) {
            Logger.getLogger(NotasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return insertado;
    }
    public boolean insertUserJDBC(Nota nota) {
        DBConnection dBConnection = new DBConnection();
        Connection connection = null;
        boolean insertado = false;
        PreparedStatement stmt = null;
        try {
            connection = dBConnection.getConnection();

            stmt = connection.prepareStatement(SqlQuery.INSERT_NOTAS, Statement.RETURN_GENERATED_KEYS);

            stmt.setInt(1,(int) nota.getId_alumno());
            stmt.setInt(2, (int) nota.getId_asignatura());
            stmt.setInt(3, nota.getNota());

            if (stmt.executeUpdate() > 0) {
                insertado = Boolean.TRUE;
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
        return insertado;

    }//fin insert
    
}//fin clase
