/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.math.BigInteger;
import java.sql.Connection;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

import model.Asignatura;
import org.apache.commons.dbutils.QueryRunner;
import org.apache.commons.dbutils.ResultSetHandler;
import org.apache.commons.dbutils.handlers.BeanListHandler;
import org.apache.commons.dbutils.handlers.ScalarHandler;
import utils.SqlQuery;

/**
 *
 * @author oscar
 */
public class AsignaturasDAO {

    public List<Asignatura> getAllAsignaturasdbUtils() {
        List<Asignatura> lista = null;
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<List<Asignatura>> handler
                    = new BeanListHandler<Asignatura>(Asignatura.class);
            lista = qr.query(con, SqlQuery.SELECT_ALL_ASIGNATURAS, handler);

        } catch (Exception ex) {
            Logger.getLogger(AsignaturasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return lista;
    }

    public boolean insertAsignaturadbUtils(Asignatura asignatura) {
        DBConnection db = new DBConnection();
        Connection con = null;
        boolean insertado = false;
        try {
            con = db.getConnection();

            QueryRunner qr = new QueryRunner();

            BigInteger id = qr.insert(con,
                    SqlQuery.INSERT_ASIGNATURA,
                    new ScalarHandler<BigInteger>(),
                    asignatura.getNombre(), asignatura.getCurso(), asignatura.getCiclo());

            if (id.intValue() > 0) {
                insertado = Boolean.TRUE;
            }

        } catch (Exception ex) {
            Logger.getLogger(AsignaturasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return insertado;

    }

    public int updateAsignaturasdbUtils(Asignatura asignatura) {
        int filas = -1;
        DBConnection db = new DBConnection();
        Connection con = null;

        try {
            con = db.getConnection();

            QueryRunner qr = new QueryRunner();

            filas = qr.update(con,
                    SqlQuery.UPDATE_ASIGNATURA,
                    asignatura.getNombre(),
                    asignatura.getCurso(),
                    asignatura.getCiclo(),
                    asignatura.getId());

        } catch (Exception ex) {
            Logger.getLogger(AsignaturasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }

        return filas;
    }

    public int deleteAsignaturadbUtils(String key) {
        int filas = -1;
        DBConnection db = new DBConnection();
        Connection con = null;

        try {
            con = db.getConnection();

            QueryRunner qr = new QueryRunner();

            filas = qr.update(con,
                    SqlQuery.DELETE_ASIGNATURA,
                    key);

        } catch (Exception ex) {
            Logger.getLogger(AsignaturasDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return filas;
    }

}//Fin clase
