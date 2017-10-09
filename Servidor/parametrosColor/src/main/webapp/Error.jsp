<%-- 
    Document   : Error
    Created on : 09-oct-2017, 12:22:50
    Author     : daw
--%>

<%@page import="utils.Constantes"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>
            <%
                out.println(request.getAttribute(Constantes.MensajeAtributos));
            %>
        </h1>
    </body>
</html>
