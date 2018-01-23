/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package RestApi;

import com.google.api.client.http.GenericUrl;
import com.google.api.client.http.HttpRequest;
import com.google.api.client.http.HttpRequestFactory;
import com.google.api.client.http.HttpRequestInitializer;
import com.google.api.client.http.HttpTransport;
import com.google.api.client.http.UrlEncodedContent;
import com.google.api.client.http.javanet.NetHttpTransport;
import com.google.api.client.json.GenericJson;
import com.google.api.client.json.JsonFactory;
import com.google.api.client.json.JsonObjectParser;
import com.google.api.client.json.jackson2.JacksonFactory;
import com.google.api.client.util.GenericData;
import config.Configuration;
import java.io.IOException;
import java.util.concurrent.ExecutionException;
import utilidades.Api;
import utilidades.Constantes;

/**
 *
 * @author Gato
 */
public class RestApi {

    private static RestApi instance;
    private static HttpRequestFactory requestFactory;

    public static RestApi getInstance() {
        if (instance == null) {
            instance = new RestApi();
        }
        return instance;
    }

    private HttpRequestFactory crearServicio() {
        HttpTransport HTTP_TRANSPORT = new NetHttpTransport();
        final JsonFactory JSON_FACTORY = new JacksonFactory();
        if (requestFactory == null) {

            requestFactory
                    = HTTP_TRANSPORT.createRequestFactory(new HttpRequestInitializer() {
                        @Override
                        public void initialize(HttpRequest request) {
                            request.setParser(new JsonObjectParser(JSON_FACTORY));
                            request.setConnectTimeout(100000);
                        }
                    });
        }
        return requestFactory;
    }

    public GenericJson getArriveStop(String idStop) throws IOException, InterruptedException, ExecutionException {
        GenericUrl url = new GenericUrl(Api.END_POINT_GET_ARRIVE_STOP);

        GenericData data = new GenericData();
        data.put(Constantes.ID_CLIENT, Configuration.getInstance().getIdClient());
        data.put(Constantes.PASS_KEY, Configuration.getInstance().getPassKey());
        data.put(Constantes.ID_STOP, idStop);

        HttpRequest requestGoogle = crearServicio().buildPostRequest(url, new UrlEncodedContent(data));

        return requestGoogle.executeAsync().get().parseAs(GenericJson.class);
    }

    public GenericJson getListLines(String fecha) throws IOException, InterruptedException, ExecutionException {
        GenericUrl url = new GenericUrl(Api.END_POINT_GET_LIST_LINES);

        GenericData data = new GenericData();
        Configuration instancia = Configuration.getInstance();
        data.put(Constantes.ID_CLIENT, instancia.getIdClient());
        data.put(Constantes.PASS_KEY, instancia.getPassKey());
        data.put(Constantes.SELECT_DATE, fecha);

        HttpRequest requestGoogle = crearServicio().buildPostRequest(url, new UrlEncodedContent(data));
        return requestGoogle.executeAsync().get().parseAs(GenericJson.class);
    }

    public GenericJson getRoutetLine(String fecha, String linea) throws IOException, InterruptedException, ExecutionException {
        GenericUrl url = new GenericUrl(Api.END_POINT_GET_ROUTE_LINE);

        GenericData data = new GenericData();
        Configuration instancia = Configuration.getInstance();
        data.put(Constantes.ID_CLIENT, instancia.getIdClient());
        data.put(Constantes.PASS_KEY, instancia.getPassKey());
        data.put(Constantes.SELECT_DATE, fecha);
        data.put(Constantes.LINES, linea);

        HttpRequest requestGoogle = crearServicio().buildPostRequest(url, new UrlEncodedContent(data));
        return requestGoogle.executeAsync().get().parseAs(GenericJson.class);
    }
    @Deprecated
    public GenericJson getNodeLine() throws IOException, InterruptedException, ExecutionException {
        GenericUrl url = new GenericUrl(Api.END_POINT_GetNodesLines);

        GenericData data = new GenericData();
        Configuration instancia = Configuration.getInstance();
        data.put(Constantes.ID_CLIENT, instancia.getIdClient());
        data.put(Constantes.PASS_KEY, instancia.getPassKey());
        data.put("Nodes", "3727");
        //data.put(Constantes.LINES, linea);

        HttpRequest requestGoogle = crearServicio().buildPostRequest(url, new UrlEncodedContent(data));
        return requestGoogle.executeAsync().get().parseAs(GenericJson.class);
    }

}//fin clase
