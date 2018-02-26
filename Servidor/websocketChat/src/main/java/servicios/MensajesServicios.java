/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.MensajesDAO;
import java.util.List;
import model.Message;
import model.RangoMensajes;

/**
 *
 * @author Gato
 */
public class MensajesServicios {

    public MensajesServicios() {
    }

    public Message saveMessageToDatabase(Message message) {
        MensajesDAO dao = new MensajesDAO();
        return dao.insertMessageJDBCTemplate(message);
    }

    public List<Message> getMessagesByDates(RangoMensajes rango) {
        MensajesDAO dao = new MensajesDAO();
        return dao.getMessagesByDatesJDBCTemplate(rango);
    }

}//fin clase
