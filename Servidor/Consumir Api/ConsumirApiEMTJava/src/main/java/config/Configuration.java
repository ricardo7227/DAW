/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package config;

import freemarker.template.TemplateExceptionHandler;
import java.io.InputStream;
import javax.servlet.ServletContext;
import org.yaml.snakeyaml.Yaml;

/**
 *
 * @author daw
 */
public class Configuration {

    private static Configuration config;
    private String idClient;
    private String passKey;

    private freemarker.template.Configuration freeMarker;

    private Configuration() {

    }

    public static Configuration getInstance() {

        return config;
    }

    public static Configuration getInstance(InputStream file, ServletContext sc) {
        if (config == null) {
            Yaml yaml = new Yaml();
            config = (Configuration) yaml.loadAs(file, Configuration.class);

            // Create your Configuration instance, and specify if up to what FreeMarker
// version (here 2.3.25) do you want to apply the fixes that are not 100%
// backward-compatible. See the Configuration JavaDoc for details.
            config.setFreeMarker(new freemarker.template.Configuration(freemarker.template.Configuration.VERSION_2_3_27));

// Specify the source where the template files come from. Here I set a
// plain directory for it, but non-file-system sources are possible too:
            config.getFreeMarker().setServletContextForTemplateLoading(sc, "WEB-INF/templates");

// Set the preferred charset template files are stored in. UTF-8 is
// a good choice in most applications:
            config.getFreeMarker().setDefaultEncoding("UTF-8");

// Sets how errors will appear.
// During web page *development* TemplateExceptionHandler.HTML_DEBUG_HANDLER is better.
            config.getFreeMarker().setTemplateExceptionHandler(TemplateExceptionHandler.HTML_DEBUG_HANDLER);

// Don't log exceptions inside FreeMarker that it will thrown at you anyway:
            config.getFreeMarker().setLogTemplateExceptions(false);
        }
        return config;
    }

    public freemarker.template.Configuration getFreeMarker() {
        return freeMarker;
    }

    public void setFreeMarker(freemarker.template.Configuration freeMarker) {
        this.freeMarker = freeMarker;
    }

    public static Configuration getConfig() {
        return config;
    }

    public static void setConfig(Configuration config) {
        Configuration.config = config;
    }

    public String getIdClient() {
        return idClient;
    }

    public void setIdClient(String idClient) {
        this.idClient = idClient;
    }

    public String getPassKey() {
        return passKey;
    }

    public void setPassKey(String passKey) {
        this.passKey = passKey;
    }
    

}//fin clase
