/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import model.Canal;
import model.CanalesUsers;
import model.Message;
import org.springframework.dao.DataAccessException;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import org.springframework.jdbc.core.simple.SimpleJdbcInsert;
import org.springframework.jdbc.datasource.DataSourceTransactionManager;
import org.springframework.transaction.TransactionStatus;
import org.springframework.transaction.support.TransactionCallback;
import org.springframework.transaction.support.TransactionTemplate;
import utilidades.Constantes;
import utilidades.SqlQuery;
import websocket.ChatWebsocket;

/**
 *
 * @author Gato
 */
public class CanalesDAO {

    public Canal insertCanalJDBCTemplate(final Canal canal, final ChatWebsocket chatWebsocket) {
        TransactionTemplate template = new TransactionTemplate(new DataSourceTransactionManager(DBConnection.getInstance().getDataSource()));

        final SimpleJdbcInsert jdbcInsert = new SimpleJdbcInsert(
                DBConnection.getInstance().getDataSource()).withTableName(Constantes.CANALES).usingGeneratedKeyColumns(Constantes.ID.toLowerCase());
        final SimpleJdbcInsert jdbcInsert2 = new SimpleJdbcInsert(
                DBConnection.getInstance().getDataSource()).withTableName(Constantes.CANALES_USERS);
        template.execute(new TransactionCallback<Integer>() {

            @Override
            public Integer doInTransaction(TransactionStatus ts) {
                try {
                    Map<String, Object> parameters = new HashMap<>();
                    parameters.put(Constantes.NOMBRE.toLowerCase(), canal.getNombre());
                    parameters.put(Constantes.ADMIN, canal.getAdmin());
                    parameters.put(Constantes.CLAVE, canal.getClave());
                    parameters.put(Constantes.SALT, canal.getSalt());
                    parameters.put(Constantes.IV, canal.getIv());
                    Canal canalTemp = canal;
                    canalTemp.setId(jdbcInsert.executeAndReturnKey(parameters).longValue());
                    parameters.clear();

                    parameters.put(Constantes.ID_CANAL, canalTemp.getId());
                    parameters.put(Constantes.USER, canal.getAdmin());
                    jdbcInsert2.execute(parameters);                    
                    chatWebsocket.addNewChannelToChat(canalTemp);

                } catch (DataAccessException e) {
                    ts.setRollbackOnly();
                }
                return 0;

            }
        });
        return canal;
    }

    public CanalesUsers addUserToChannelJDBCTemplate(CanalesUsers canalesUser) {

        SimpleJdbcInsert jdbcInsert = new SimpleJdbcInsert(
                DBConnection.getInstance().getDataSource()).withTableName(Constantes.CANALES_USERS);

        Map<String, Object> parameters = new HashMap<>();
        parameters.put(Constantes.ID_CANAL, canalesUser.getId_canal());
        parameters.put(Constantes.USER, canalesUser.getUser());

        if (jdbcInsert.execute(parameters) == 0) {
            canalesUser = null;
        }

        return canalesUser;
    }

    public List<Canal> getCanalesByUserJDBCTemplate(String usuario) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        List<Canal> canales = null;
        Object[] params = new Object[]{usuario};

        String resultadoQuery = jtm.query(SqlQuery.SELECT_CANALES_BY_NAME_USER, params, new ResultSetExtractor<String>() {
            @Override
            public String extractData(ResultSet rs) throws SQLException, DataAccessException {
                return rs.next() ? rs.getString(Constantes.NOMBRE) : null;
            }
        });

        if (resultadoQuery != null) {

            canales = jtm.query(SqlQuery.SELECT_CANALES_BY_NAME_USER, params,
                    new BeanPropertyRowMapper(Canal.class));
        }

        return canales;
    }

    public Canal getChannelOwnerByIDChannelJDBCTemplate(Message mensaje) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        List<Canal> channels = null;
        Object[] params = new Object[]{mensaje.getId_canal()};

        channels = jtm.query(SqlQuery.SELECT_CHANNEL_OWNER, params,
                new BeanPropertyRowMapper(Canal.class));

        return channels.get(0);
    }

    public List<Canal> getCanalesJDBCTemplate() {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());

        List<Canal> canales = jtm.query(SqlQuery.SELECT_ALL_CANALES,
                new BeanPropertyRowMapper(Canal.class));

        return canales;
    }

    public List<Canal> getNotMyChannelsJDBCTemplate(String username) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] params = new Object[]{username};
        List<Canal> canales = jtm.query(SqlQuery.SELECT_ALL_NOT_MY_CHANNELS, params,
                new BeanPropertyRowMapper(Canal.class));

        return canales;
    }

}//fin clase