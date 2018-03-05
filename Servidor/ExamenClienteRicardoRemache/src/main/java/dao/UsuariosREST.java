/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.api.client.http.EmptyContent;
import com.google.api.client.http.GenericUrl;
import com.google.api.client.http.HttpRequest;
import com.google.api.client.http.HttpResponse;
import com.google.api.client.http.HttpResponseException;
import com.google.api.client.http.UrlEncodedContent;
import com.google.api.client.util.GenericData;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.User;
import model.GenericResponse;
import utils.Api;
import utils.Constantes;

/**
 *
 * @author daw
 */
public class UsuariosREST {

    private static UsuariosREST instancia;

    public static UsuariosREST getInstance() {
        if (instancia == null) {
            instancia = new UsuariosREST();
        }
        return instancia;
    }

    public User[] getUsuarios() {
        User[] users = null;
        try {
            GenericUrl url = new GenericUrl(Api.END_POINT_USER);
            RestApi instanceRest = RestApi.getInstance();

            HttpRequest requestGoogle = instanceRest.crearServicio().buildGetRequest(url).setHeaders(instanceRest.getHeaderApikey());
            HttpResponse response = requestGoogle.execute();
            ObjectMapper mapper = new ObjectMapper();
            users = mapper.readValue(response.getContent(), User[].class);

        } catch (HttpResponseException ex) {
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        }
        return users;
    }

    public User updateUser(User user) {
        User userResponse = null;
        try {
            GenericUrl url = new GenericUrl(Api.END_POINT_USER);
            ObjectMapper mapper = new ObjectMapper();
            GenericData data = new GenericData();
            data.put(Constantes.USER, mapper.writeValueAsString(user));

            RestApi instanceRest = RestApi.getInstance();

            HttpRequest requestGoogle = instanceRest.crearServicio().buildPostRequest(url, new UrlEncodedContent(data))
                    .setHeaders(instanceRest.getHeaderApikey());
            HttpResponse response = requestGoogle.execute();

            userResponse = mapper.readValue(response.getContent(), User.class);

        } catch (HttpResponseException ex) {
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        }
        return userResponse;
    }

    public User addUser(User user) {
        User userResponse = null;
        try {
            GenericUrl url = new GenericUrl(Api.END_POINT_USER);
            ObjectMapper mapper = new ObjectMapper();

            Gson gson = new GsonBuilder()
                    .create();
            String json = gson.toJson(user);

            RestApi instanceRest = RestApi.getInstance();

            HttpRequest requestGoogle = instanceRest.crearServicio().buildPutRequest(url.set(Constantes.USER, json),
                    new EmptyContent()).setHeaders(instanceRest.getHeaderApikey());
            HttpResponse response = requestGoogle.execute();

            userResponse = mapper.readValue(response.getContent(), User.class);

        } catch (HttpResponseException ex) {
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        }
        return userResponse;
    }

    public GenericResponse deleteUser(User user, boolean force) {
        GenericResponse userResponse = null;
        Gson gson = new GsonBuilder()
                .create();
        try {
            GenericUrl url = new GenericUrl(Api.END_POINT_USER);

            url.set(Constantes.DELETE_FORCE, force);

            String json = gson.toJson(user);

            RestApi instanceRest = RestApi.getInstance();

            HttpRequest requestGoogle = instanceRest.crearServicio().buildDeleteRequest(url.set(Constantes.USER, json)).setHeaders(instanceRest.getHeaderApikey());
            HttpResponse response = requestGoogle.execute();

            ObjectMapper mapper = new ObjectMapper();
            userResponse = mapper.readValue(response.getContent(), GenericResponse.class);

        } catch (HttpResponseException ex) {
            userResponse = gson.fromJson(ex.getContent(), GenericResponse.class);
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(UsuariosREST.class.getName()).log(Level.SEVERE, null, ex);
        }
        return userResponse;
    }
//leer response
//            Scanner s = new Scanner(response.getContent()).useDelimiter("\\A");
//            String result = s.hasNext() ? s.next() : "";
}//fin clase
