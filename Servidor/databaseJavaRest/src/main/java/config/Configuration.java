/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package config;

import java.io.InputStream;
import javax.servlet.ServletContext;
import org.yaml.snakeyaml.Yaml;

/**
 *
 * @author daw
 */
public class Configuration {

    private static Configuration config;
    private String urlDB;
    private String driverDB;
    private String userDB;
    private String passDB;
    private String mailFrom;
    private String smtpServer;
    private String smtpPort;
    private String mailPass;
    private int timeToValidate;
    private int numMaxPeticiones;

    private Configuration() {

    }

    public static Configuration getInstance() {

        return config;
    }

    public static Configuration getInstance(InputStream file, ServletContext sc) {
        if (config == null) {
            Yaml yaml = new Yaml();
            config = (Configuration) yaml.loadAs(file, Configuration.class);
        }
        return config;
    }

    public String getUrlDB() {
        return urlDB;
    }

    public void setUrlDB(String urlDB) {
        this.urlDB = urlDB;
    }

    public String getDriverDB() {
        return driverDB;
    }

    public void setDriverDB(String driverDB) {
        this.driverDB = driverDB;
    }

    public String getUserDB() {
        return userDB;
    }

    public void setUserDB(String userDB) {
        this.userDB = userDB;
    }

    public String getPassDB() {
        return passDB;
    }

    public void setPassDB(String passDB) {
        this.passDB = passDB;
    }

    public static Configuration getConfig() {
        return config;
    }

    public static void setConfig(Configuration config) {
        Configuration.config = config;
    }

    public String getMailFrom() {
        return mailFrom;
    }

    public void setMailFrom(String mailFrom) {
        this.mailFrom = mailFrom;
    }

    public String getSmtpServer() {
        return smtpServer;
    }

    public void setSmtpServer(String smtpServer) {
        this.smtpServer = smtpServer;
    }

    public String getSmtpPort() {
        return smtpPort;
    }

    public void setSmtpPort(String smtpPort) {
        this.smtpPort = smtpPort;
    }

    public String getMailPass() {
        return mailPass;
    }

    public void setMailPass(String mailPass) {
        this.mailPass = mailPass;
    }

    public int getTimeToValidate() {
        return timeToValidate;
    }

    public void setTimeToValidate(int timeToValidate) {
        this.timeToValidate = timeToValidate;
    }

    public int getNumMaxPeticiones() {
        return numMaxPeticiones;
    }

    public void setNumMaxPeticiones(int numMaxPeticiones) {
        this.numMaxPeticiones = numMaxPeticiones;
    }

}//fin clase
