
import java.io.*;
import javax .servlet.*;
import javax .servlet .http .* ;
import java .util .Date;

public class SessionServlet extends HttpServlet {
@Override
}
public void doGet(HttpServletRequest request, HttpServletResponse response)
throws IOException, ServletException {
/1 Establece el tipo MIME del mensaje de respuesta
response.setContentType("text/html");
//Crea un flujo de salida para escribir la respuesta a la petición del cliente
PrintWriter out= response.getWriter();
//Recoge la sesión actual si existe, en otro caso crea una nueva
HttpSession session = request.getSession();
Integer contadorAccesos;
synchronized(session) {
}
contadorAccesos = (Integer)session.getAttribute("contadorAccesos");
if (contadorAccesos == null) {
contador Accesos o· ,
} else {
contadorAccesos = new Integer(contadorAccesos + 1);
}
session.setAttribute("contadorAccesos", contadorAccesos)
}

//Escribe el mensaje de respuesta en una página html
try {
out.println("<!DOCTYPE html>");
out.println("<html>");
out.println("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>");
out.println("<title>Servlet de prueba de sesión</title></head><body>");
out.println("<h2>Accesos: "+ contadorAccesos +"en esta sesión.</h2>");
out.println("<p>(Identificador de sesión : " + session.getidO + ")</p>");
out .println("<p>(Fecha de creación de la sesión: " +
new Date (session. getCreationTime O) + ") </p>");
out.println("<p>(Fecha de último acceso a la sesión " +
new Date (session. getLastAccessedTime O) + ") </p>") ;
out.println("<p>(Máximo tiempo inactivo de la sesión: " +
session.getMaxinactiveintervalO + " seconds)</p>");
out . println("<p><a href='" + request. getRequestURIO + "'>Refrescar</a>");
out. println (" <p><a href='" + response. encodeURL (request. getRequestURI O) + " '>
Refrescar con reescritura de URLs</a>");
out.println("</body></html>");
} finally {
}
}
}



<servlet>
<servlet-name>ServletPruebaSesion</servlet-name>
<servlet-class>SessionServlet</servlet-class>
</servlet>

<servlet-rnapping>
<servlet-narne>ServletPruebaSesion</servlet-narne>
<url-pattern>/pruebasesion</url-pattern>
</servlet-mapping>