/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.Connection;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.Alumno;
import model.Asignatura;
import model.User;
import org.apache.commons.dbutils.QueryRunner;
import org.apache.commons.dbutils.ResultSetHandler;
import org.apache.commons.dbutils.handlers.BeanHandler;
import org.apache.commons.dbutils.handlers.ScalarHandler;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
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

        Connection con = null;
        try {
            con = DBConnection.getInstance().getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<User> handler
                    = new BeanHandler<User>(User.class);
            user = qr.query(con, SqlQuery.SELECT_USER_BY_NAME_EMAIL, handler, usuario.getNombre(), usuario.getEmail());

        } catch (Exception ex) {
            Logger.getLogger(UsersDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            DBConnection.getInstance().cerrarConexion(con);
        }
        return user;
    }

    public User getDuplicateUserJDBCTemplate(User usuario) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        User user = (User) jtm.queryForObject(SqlQuery.SELECT_USER_BY_NAME, new Object[]{usuario.getNombre()},
                new BeanPropertyRowMapper(User.class));
        if (user == null) {
            user = (User) jtm.queryForObject(SqlQuery.SELECT_USER_BY_EMAIL, new Object[]{usuario.getEmail()},
                    new BeanPropertyRowMapper(User.class));
        }

        return user;
    }

    public User getDuplicateUserDBUtils(User usuario) {
        User user = null;

        Connection con = null;
        try {
            con = DBConnection.getInstance().getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<User> handler
                    = new BeanHandler<User>(User.class);
            user = qr.query(con, SqlQuery.SELECT_USER_BY_NAME, handler, usuario.getNombre());
            if (user == null) {
                user = qr.query(con, SqlQuery.SELECT_USER_BY_EMAIL, handler, usuario.getEmail());
            }

        } catch (Exception ex) {
            Logger.getLogger(UsersDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            DBConnection.getInstance().cerrarConexion(con);
        }
        return user;
    }

    public boolean insertUserDbUtils(User usuario) {

        Connection con = null;
        boolean insertado = false;
        try {
            con = DBConnection.getInstance().getConnection();

            QueryRunner qr = new QueryRunner();

            long id = qr.insert(con,
                    SqlQuery.INSERT_USER,//NOMBRE, PASSWORD, CODIGO_ACTIVACION, FECHA_ACTIVACION, EMAIL
                    new ScalarHandler<Long>(),
                    usuario.getNombre(), usuario.getPassword(), usuario.getCodigo_activacion(), usuario.getFecha_activacion(), usuario.getEmail());

            if (id > 0) {
                insertado = Boolean.TRUE;
            }

        } catch (Exception ex) {
            Logger.getLogger(UsersDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            DBConnection.getInstance().cerrarConexion(con);
        }
        return insertado;

    }
}//fin clase
