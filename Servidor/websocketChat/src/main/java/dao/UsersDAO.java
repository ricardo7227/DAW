/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Timestamp;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import model.Canal;
import model.CanalUser;
import model.User;
import org.springframework.dao.DataAccessException;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import org.springframework.jdbc.core.simple.SimpleJdbcInsert;
import utilidades.Constantes;
import utilidades.SqlQuery;

/**
 *
 * @author Gato
 */
public class UsersDAO {

    public UsersDAO() {
    }

    /**
     * Busca un registro por nombre, si existe devuelve el objeto User
     *
     * @param usuario
     * @return usuario
     */
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

    /**
     * Busca resgistros existentes en DB por nombre y email
     *
     * @param usuario
     * @return user o null si no existe
     */
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

    /**
     * *
     *
     * @param usuario
     * @return
     */
    public User insertUserJDBCTemplate(User usuario) {

        SimpleJdbcInsert jdbcInsert = new SimpleJdbcInsert(
                DBConnection.getInstance().getDataSource()).withTableName(Constantes.USERS).usingGeneratedKeyColumns(Constantes.ID);
        Map<String, Object> parameters = new HashMap<>();

        parameters.put(Constantes.NOMBRE, usuario.getNombre());
        parameters.put(Constantes.PASSWORD, usuario.getPassword());
        parameters.put(Constantes.ACTIVO, usuario.isActivo());
        parameters.put(Constantes.CODIGO_ACTIVACION, usuario.getCodigo_activacion());
        parameters.put(Constantes.FECHA_ACTIVACION, usuario.getFecha_activacion());
        parameters.put(Constantes.EMAIL, usuario.getEmail());
        usuario.setId(jdbcInsert.executeAndReturnKey(parameters).longValue());
        return usuario;
    }

    /**
     * busca un registro por nombre, email y cod activación
     *
     * @param usuario
     * @return user o null
     */
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

    /**
     * update activo por ID
     *
     * @param usuario
     * @return int - filas afectadas
     */
    public int validateUserByIdJDBCTemplate(User usuario) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());

        int rowsAffected = jtm.update(SqlQuery.UPDATE_USER_ACTIVO_ON, usuario.getId());

        if (rowsAffected == 0) {
            rowsAffected = -1;
        }

        return rowsAffected;
    }

    public List<User> getUsersJDBCTemplate() {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());

        List<User> users = jtm.query(SqlQuery.SELECT_ALL_USERS,
                new BeanPropertyRowMapper(User.class));

        return users;
    }

    public List<CanalUser> getUsersbyChannelsJDBCTemplate(Canal canal) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] params = new Object[]{canal.getNombre()};
        List<CanalUser> users = jtm.query(SqlQuery.SELECT_USERS_BY_CHANNEL, params,
                new BeanPropertyRowMapper(CanalUser.class));

        return users;
    }

}//fin clase
