/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.Connection;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.Asignatura;
import model.User;
import org.apache.commons.dbutils.QueryRunner;
import org.apache.commons.dbutils.ResultSetHandler;
import org.apache.commons.dbutils.handlers.BeanHandler;
import org.apache.commons.dbutils.handlers.ScalarHandler;
import utils.SqlQuery;

/**
 *
 * @author Gato
 */
public class UsersDAO {

    public UsersDAO() {
    }

    /**
     * *
     *
     * @param usuario
     * @return user - puede ser null cuando no existe el usuario
     */
    public User getUserByNombreAndEmailDBUtils(User usuario) {
        User user = null;
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<User> handler
                    = new BeanHandler<User>(User.class);
            user = qr.query(con, SqlQuery.SELECT_USER_BY_NAME_EMAIL, handler, usuario.getNombre(), usuario.getEmail());

        } catch (Exception ex) {
            Logger.getLogger(UsersDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return user;
    }

    public User getDuplicateUserDBUtils(User usuario) {
        User user = null;
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<User> handler
                    = new BeanHandler<User>(User.class);
            user = qr.query(con, SqlQuery.SELECT_USER_BY_NAME, handler, usuario.getNombre());
            if (user != null) {
                user = qr.query(con, SqlQuery.SELECT_USER_BY_EMAIL, handler, usuario.getEmail());
            }

        } catch (Exception ex) {
            Logger.getLogger(UsersDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return user;
    }
    public boolean insertUserDbUtils(User usuario) {
        DBConnection db = new DBConnection();
        Connection con = null;
        boolean insertado = false;
        try {
            con = db.getConnection();

            QueryRunner qr = new QueryRunner();

            long id = qr.insert(con,
                    SqlQuery.INSERT_USER,//NOMBRE, PASSWORD, CODIGO_ACTIVACION, FECHA_ACTIVACION, EMAIL
                    new ScalarHandler<Long>(),
                    usuario.getNombre(), usuario.getPassword(), usuario.getCodigo_activacion(),usuario.getFecha_activacion(),usuario.getEmail());

            if (id > 0) {
                insertado = Boolean.TRUE;
            }

        } catch (Exception ex) {
            Logger.getLogger(UsersDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return insertado;

    }
}//fin clase
