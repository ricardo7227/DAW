/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import com.google.api.client.http.GenericUrl;
import com.google.api.client.http.HttpRequest;
import com.google.api.client.http.HttpResponse;
import com.google.api.client.json.GenericJson;
import com.google.api.client.util.GenericData;
import java.io.IOException;
import java.util.concurrent.ExecutionException;
import model.Alumnos;
import utils.Api;

/**
 *
 * @author daw
 */
public class AlumnosREST {

    private static AlumnosREST instancia;

    public static AlumnosREST getInstance() {
        if (instancia == null) {
            instancia = new AlumnosREST();
        }
        return instancia;
    }

    public Alumnos getAlumnos() throws IOException, InterruptedException, ExecutionException {
        GenericUrl url = new GenericUrl(Api.END_POINT_ALUMNOS);

        GenericData data = new GenericData();
      //  data.put(Constantes.ID_CLIENT, Configuration.getInstance().getIdClient());
        //data.put(Constantes.APIKEY_PASS, Configuration.getInstance().getApiKeyPass());


        HttpRequest requestGoogle = RestApi.getInstance().crearServicio().buildGetRequest(url);
        final HttpResponse execute = requestGoogle.execute();
        GenericJson gj = new GenericJson();
        
        return execute.parseAs(Alumnos.class);
        //return null;
    }

}//fin clase
