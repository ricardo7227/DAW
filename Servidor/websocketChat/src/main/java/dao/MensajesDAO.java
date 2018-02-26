/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
import model.Message;
import model.RangoMensajes;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.simple.SimpleJdbcInsert;
import utilidades.Constantes;
import utilidades.SqlQuery;

/**
 *
 * @author Gato
 */
public class MensajesDAO {

    public Message insertMessageJDBCTemplate(Message message) {

        SimpleJdbcInsert jdbcInsert = new SimpleJdbcInsert(
                DBConnection.getInstance().getDataSource()).withTableName(Constantes.MENSAJES).usingGeneratedKeyColumns(Constantes.ID.toLowerCase());

        Map<String, Object> parameters = new HashMap<>();

        parameters.put(Constantes.MENSAJE, message.getMensaje());
        parameters.put(Constantes.FECHA, message.getFecha());
        parameters.put(Constantes.ID_CANAL, message.getId_canal());
        parameters.put(Constantes.NOMBRE_USER, message.getNombre_user());

        message.setId(jdbcInsert.executeAndReturnKey(parameters).longValue());

        return message;
    }

    public List<Message> getMessagesByDatesJDBCTemplate(RangoMensajes rango) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        List<Message> channels = null;
        Object[] params = new Object[]{rango.getFecha1(), rango.getFecha2()};

        channels = jtm.query(SqlQuery.SELECT_MENSAJES_BY_DATES, params,
                new BeanPropertyRowMapper(Message.class));

        return channels;
    }

}//fin clase
