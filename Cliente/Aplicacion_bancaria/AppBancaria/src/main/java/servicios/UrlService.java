/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import config.Configuration;
import freemarker.template.Template;
import freemarker.template.TemplateException;
import java.io.IOException;
import java.lang.reflect.Field;
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletResponse;
import javax.servlet.http.HttpServletRequest;
import utils.Constantes;
import utils.UrlsPaths;

/**
 *
 * @author Gato
 */
public class UrlService {

    public UrlService() {
    }

    private String getBaseUrlServer(HttpServletRequest request) {
        String equal = "=";
        String and = "&";

        String uri = request.getScheme() + "://"
                + // "http" + "://
                request.getServerName()
                + // "myhost"
                ":"
                + // ":"
                request.getServerPort()
                + // "8080"
                request.getContextPath();

        return uri;
    }

    public Map addConstantsEndPoints(HttpServletRequest request) {
        HashMap paramentros = new HashMap();
        try {
            //Ejemplo final Endpoint: endpoint_alumnos
            String PreEndPoint = "endpoint_";
            paramentros.put(Constantes.BASE_URL_SERVER, getBaseUrlServer(request));

            Field[] constantesEndpoints = UrlsPaths.class.getDeclaredFields();

            for (Field endpoint : constantesEndpoints) {
                endpoint.setAccessible(true);

                paramentros.put(PreEndPoint.concat(endpoint.getName().toLowerCase()), endpoint.get(UrlsPaths.class.newInstance()));

            }

        } catch (SecurityException ex) {
            Logger.getLogger(UrlService.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            Logger.getLogger(UrlService.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            Logger.getLogger(UrlService.class.getName()).log(Level.SEVERE, null, ex);
        }
        return paramentros;
    }

    public int getOffset(Map<String, String[]> parametros) {
        int offset = 0;
        if (parametros != null && !parametros.isEmpty()) {
            if (parametros.get(Constantes.OFFSET) != null && !parametros.get(Constantes.OFFSET)[0].isEmpty()) {
                offset = Integer.valueOf(parametros.get(Constantes.OFFSET)[0]);
            }
        }
        return offset;
    }
    public void outOfRangeTemplate(ServletResponse response){
        try {
            HashMap paramentrosPlantilla = new HashMap();
            paramentrosPlantilla.put(Constantes.MESSAGE_TO_USER, Constantes.MESSAGE_TO_USER_OUT_OF_RANGE);
            Template plantilla = Configuration.getInstance().getFreeMarker().getTemplate(Constantes.INDEX_TEMPLATE);
            plantilla.process(paramentrosPlantilla, response.getWriter());
        } catch (IOException ex) {
            Logger.getLogger(UrlService.class.getName()).log(Level.SEVERE, null, ex);
        } catch (TemplateException ex) {
            Logger.getLogger(UrlService.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

}//fin clase
