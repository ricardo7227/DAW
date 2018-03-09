/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package filtros;

import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.ObjectMapper;
import java.io.IOException;
import java.io.PrintStream;
import java.io.PrintWriter;
import java.io.StringWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.Filter;
import javax.servlet.FilterChain;
import javax.servlet.FilterConfig;
import javax.servlet.ServletException;
import javax.servlet.ServletRequest;
import javax.servlet.ServletResponse;
import javax.servlet.annotation.WebFilter;
import javax.servlet.http.HttpServletResponse;
import model.GenericResponse;
import model.Movimiento;
import model.MovimientosFechas;
import org.apache.http.HttpStatus;
import servicios.ValidadorServicios;
import utils.Constantes;
import utils.Mensajes;
import utils.NamesFilters;
import static utils.UrlsPaths.JSON_FILTRO;

/**
 *
 * @author daw
 */
@WebFilter(filterName = NamesFilters.JSON_FILTRO, urlPatterns = {JSON_FILTRO})
public class JsonFiltro implements Filter {

    private static final boolean debug = true;

    // The filter configuration object we are associated with.  If
    // this value is null, this filter instance is not currently
    // configured. 
    private FilterConfig filterConfig = null;

    public JsonFiltro() {
    }

    private void doBeforeProcessing(ServletRequest request, ServletResponse response)
            throws ServletException {
        if (debug) {
            log("JsonFiltro:DoBeforeProcessing");
        }
        ObjectMapper mapper = new ObjectMapper();

        String movimiento = request.getParameter(Constantes.MOVIMIENTO);
        String rango = request.getParameter(Constantes.RANGO);
        String operacion = request.getParameter(Constantes.OPERACION);

        int codeResponse = HttpStatus.SC_ACCEPTED;
        GenericResponse respuestaError = null;

        if (operacion != null) {

            switch (operacion) {
                case Constantes.RECIBO:

                    if (movimiento != null && !movimiento.isEmpty()) {
                        try {
                            Movimiento newMovimiento = mapper.readValue(movimiento, new TypeReference<Movimiento>() {
                            });
                            if (new ValidadorServicios().validateModel(newMovimiento)) {
                                newMovimiento.setMo_des(request.getAttribute(Constantes.CLIENT_NAME) + ": " + newMovimiento.getMo_des());
                                request.setAttribute(Constantes.MOVIMIENTO, newMovimiento);
                            } else {
                                codeResponse = HttpStatus.SC_BAD_REQUEST;

                            }
                        } catch (IOException ex) {
                            codeResponse = HttpStatus.SC_BAD_REQUEST;
                            respuestaError = new GenericResponse(codeResponse, Mensajes.OBJETO_MAL_FORMADO);
                            Logger.getLogger(JsonFiltro.class.getName()).log(Level.SEVERE, null, ex);
                        }

                    } else {
                        codeResponse = HttpStatus.SC_BAD_REQUEST;

                    }

                    break;

                case Constantes.GET_MOVIMIENTOS:
                    if (rango != null && !rango.isEmpty()) {
                        try {
                            MovimientosFechas rangoMovimientos = mapper.readValue(rango, new TypeReference<MovimientosFechas>() {
                            });
                            if (new ValidadorServicios().validateModel(rangoMovimientos)) {
                                request.setAttribute(Constantes.RANGO, rangoMovimientos);
                            } else {
                                codeResponse = HttpStatus.SC_BAD_REQUEST;
                            }
                        } catch (IOException ex) {//error de Formación
                            codeResponse = HttpStatus.SC_BAD_REQUEST;
                            respuestaError = new GenericResponse(codeResponse, Mensajes.OBJETO_MAL_FORMADO);
                            Logger.getLogger(JsonFiltro.class.getName()).log(Level.SEVERE, null, ex);
                        }

                    } else {
                        codeResponse = HttpStatus.SC_BAD_REQUEST;
                    }

                    break;
            }

        } else {
            codeResponse = HttpStatus.SC_BAD_REQUEST;
        }

        if (codeResponse != HttpStatus.SC_ACCEPTED) {
            if (respuestaError != null) {
                request.setAttribute(Constantes.JSON, respuestaError);
            } else {
                request.setAttribute(Constantes.JSON, new GenericResponse(codeResponse, Mensajes.FALTAN_CAMPOS));
            }

        }
        ((HttpServletResponse) response).setStatus(codeResponse);

    }

    private void doAfterProcessing(ServletRequest request, ServletResponse response)
            throws IOException, ServletException {
        if (debug) {
            log("JsonFiltro:DoAfterProcessing");
        }
        ObjectMapper mapper = new ObjectMapper();
        Object json = request.getAttribute(Constantes.JSON);
        if (json != null) {
            mapper.writeValue(response.getOutputStream(), json);
        }
    }

    /**
     *
     * @param request The servlet request we are processing
     * @param response The servlet response we are creating
     * @param chain The filter chain we are processing
     *
     * @exception IOException if an input/output error occurs
     * @exception ServletException if a servlet error occurs
     */
    public void doFilter(ServletRequest request, ServletResponse response,
            FilterChain chain)
            throws IOException, ServletException {

        if (debug) {
            log("JsonFiltro:doFilter()");
        }

        doBeforeProcessing(request, response);

        Throwable problem = null;
        try {
            chain.doFilter(request, response);
        } catch (Throwable t) {
            // If an exception is thrown somewhere down the filter chain,
            // we still want to execute our after processing, and then
            // rethrow the problem after that.
            problem = t;
            t.printStackTrace();
        }

        doAfterProcessing(request, response);

        // If there was a problem, we want to rethrow it if it is
        // a known type, otherwise log it.
        if (problem != null) {
            if (problem instanceof ServletException) {
                throw (ServletException) problem;
            }
            if (problem instanceof IOException) {
                throw (IOException) problem;
            }
            sendProcessingError(problem, response);
        }
    }

    /**
     * Return the filter configuration object for this filter.
     */
    public FilterConfig getFilterConfig() {
        return (this.filterConfig);
    }

    /**
     * Set the filter configuration object for this filter.
     *
     * @param filterConfig The filter configuration object
     */
    public void setFilterConfig(FilterConfig filterConfig) {
        this.filterConfig = filterConfig;
    }

    /**
     * Destroy method for this filter
     */
    public void destroy() {
    }

    /**
     * Init method for this filter
     */
    public void init(FilterConfig filterConfig) {
        this.filterConfig = filterConfig;
        if (filterConfig != null) {
            if (debug) {
                log("JsonFiltro:Initializing filter");
            }
        }
    }

    /**
     * Return a String representation of this object.
     */
    @Override
    public String toString() {
        if (filterConfig == null) {
            return ("JsonFiltro()");
        }
        StringBuffer sb = new StringBuffer("JsonFiltro(");
        sb.append(filterConfig);
        sb.append(")");
        return (sb.toString());
    }

    private void sendProcessingError(Throwable t, ServletResponse response) {
        String stackTrace = getStackTrace(t);

        if (stackTrace != null && !stackTrace.equals("")) {
            try {
                response.setContentType("text/html");
                PrintStream ps = new PrintStream(response.getOutputStream());
                PrintWriter pw = new PrintWriter(ps);
                pw.print("<html>\n<head>\n<title>Error</title>\n</head>\n<body>\n"); //NOI18N

                // PENDING! Localize this for next official release
                pw.print("<h1>The resource did not process correctly</h1>\n<pre>\n");
                pw.print(stackTrace);
                pw.print("</pre></body>\n</html>"); //NOI18N
                pw.close();
                ps.close();
                response.getOutputStream().close();
            } catch (Exception ex) {
            }
        } else {
            try {
                PrintStream ps = new PrintStream(response.getOutputStream());
                t.printStackTrace(ps);
                ps.close();
                response.getOutputStream().close();
            } catch (Exception ex) {
            }
        }
    }

    public static String getStackTrace(Throwable t) {
        String stackTrace = null;
        try {
            StringWriter sw = new StringWriter();
            PrintWriter pw = new PrintWriter(sw);
            t.printStackTrace(pw);
            pw.close();
            sw.close();
            stackTrace = sw.getBuffer().toString();
        } catch (Exception ex) {
        }
        return stackTrace;
    }

    public void log(String msg) {
        filterConfig.getServletContext().log(msg);
    }

}
