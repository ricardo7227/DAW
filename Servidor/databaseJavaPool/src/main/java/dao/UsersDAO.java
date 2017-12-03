/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.Connection;
import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Timestamp;
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.User;
import org.apache.commons.dbutils.QueryRunner;
import org.apache.commons.dbutils.ResultSetHandler;
import org.apache.commons.dbutils.handlers.BeanHandler;
import org.apache.commons.dbutils.handlers.ScalarHandler;
import org.springframework.dao.DataAccessException;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import org.springframework.jdbc.core.simple.SimpleJdbcInsert;
import utils.Constantes;
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

    
    public User getLoginUserJDBCTemplate(User usuario) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        User user = null;

        String resultadoQuery = jtm.query(SqlQuery.SELECT_USER_BY_NAME, new Object[]{usuario.getNombre()}, new ResultSetExtractor<String>() {
            @Override
            public String extractData(ResultSet rs) throws SQLException, DataAccessException {
                return rs.next() ? rs.getString(Constantes.NOMBRE) : null;
            }
        });

        if (resultadoQuery != null) {
            user = (User) jtm.queryForObject(SqlQuery.SELECT_USER_BY_NAME, new Object[]{usuario.getNombre()},//funciona siempre que exista un dato en la base de datos
                    new BeanPropertyRowMapper(User.class));
        }

        return user;
    }

    public User getDuplicateUserJDBCTemplate(User usuario) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        User user = null;

        String resultadoNombre = jtm.query(SqlQuery.SELECT_USER_BY_NAME, new Object[]{usuario.getNombre()}, new ResultSetExtractor<String>() {
            @Override
            public String extractData(ResultSet rs) throws SQLException, DataAccessException {
                return rs.next() ? rs.getString(Constantes.NOMBRE) : null;
            }
        });
        String resultadoEmail = null;
        if (resultadoNombre == null) {
            resultadoEmail = jtm.query(SqlQuery.SELECT_USER_BY_EMAIL, new Object[]{usuario.getEmail()}, new ResultSetExtractor<String>() {
                @Override
                public String extractData(ResultSet rs) throws SQLException, DataAccessException {
                    return rs.next() ? rs.getString(Constantes.EMAIL) : null;
                }
            });
        }
        if (resultadoNombre != null || resultadoEmail != null) {
            user = new User();
            user.setNombre(resultadoNombre);
            user.setEmail(resultadoEmail);
        }

        return user;
    }

    public User insertUserJDBCTemplate(User usuario) {

        SimpleJdbcInsert jdbcInsert = new SimpleJdbcInsert(
                DBConnection.getInstance().getDataSource()).withTableName(Constantes.USERS).usingGeneratedKeyColumns(Constantes.ID);
        Map<String, Object> parameters = new HashMap<String, Object>();

        parameters.put(Constantes.NOMBRE, usuario.getNombre());
        parameters.put(Constantes.PASSWORD, usuario.getPassword());
        parameters.put(Constantes.ACTIVO, usuario.isActivo());
        parameters.put(Constantes.CODIGO_ACTIVACION, usuario.getCodigo_activacion());
        parameters.put(Constantes.FECHA_ACTIVACION, usuario.getFecha_activacion());
        parameters.put(Constantes.EMAIL, usuario.getEmail());
        usuario.setId(jdbcInsert.executeAndReturnKey(parameters).longValue());
        return usuario;
    }

    public User selectIdValidateUserJDBCTemplate(User usuario) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());

        usuario = jtm.query(SqlQuery.SELECT_USER_BY_NAME_EMAIL_CODIGO_ACTIVACION,
                new Object[]{usuario.getNombre(), usuario.getEmail(), usuario.getCodigo_activacion()}, new ResultSetExtractor<User>() {
            @Override
            public User extractData(ResultSet rs) throws SQLException, DataAccessException {
                User user = null;
                while (rs.next()) {
                    user = new User();
                    user.setId(rs.getLong(Constantes.ID));
                    user.setNombre(rs.getString(Constantes.NOMBRE));
                    user.setActivo(rs.getBoolean(Constantes.ACTIVO));
                    user.setEmail(rs.getString(Constantes.EMAIL));
                    Timestamp timestamp = rs.getTimestamp(Constantes.FECHA_ACTIVACION);
                    user.setFecha_activacion(new Date(timestamp.getTime()));

                }
                return user;
            }
        });

        return usuario;
    }

    public int validateUserByIdJDBCTemplate(User usuario) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());

        int rowsAffected = jtm.update(SqlQuery.UPDATE_USER_ACTIVO_ON, usuario.getId());

        if (rowsAffected == 0) {
            rowsAffected = -1;
        }

        return rowsAffected;
    }

    @Deprecated
    public User getDuplicateUserDBUtils(User usuario) {
        User user = null;

        Connection con = null;
        try {
            con = DBConnection.getInstance().getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<User> handler
                    = new BeanHandler<User>(User.class
                    );
            user = qr.query(con, SqlQuery.SELECT_USER_BY_NAME, handler, usuario.getNombre());
            if (user == null) {
                user = qr.query(con, SqlQuery.SELECT_USER_BY_EMAIL, handler, usuario.getEmail());

            }

        } catch (Exception ex) {
            Logger.getLogger(UsersDAO.class
                    .getName()).log(Level.SEVERE, null, ex);
        } finally {
            DBConnection.getInstance().cerrarConexion(con);
        }
        return user;
    }

    @Deprecated
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
            Logger.getLogger(UsersDAO.class
                    .getName()).log(Level.SEVERE, null, ex);
        } finally {
            DBConnection.getInstance().cerrarConexion(con);
        }
        return insertado;

    }
}//fin clase
