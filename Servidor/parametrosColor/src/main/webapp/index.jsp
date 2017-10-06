<%-- 
    Document   : index
    Created on : 06-oct-2017, 10:37:45
    Author     : Ricardo Alexis Remache
--%>

<%@page import="java.util.Map"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Parametros por url</title>
       
    </head>
    <body>
        <h1>url:?blue=azul</h1>
        
         <%
            
            Map<String, String[]> parameters = request.getParameterMap();
            
            for (String parameter : parameters.keySet()) {
                    
                String[] values = parameters.get(parameter);
                //out.println(StringEscapeUtils.escapeHtml4(values[0]));
        %>
        <h1 style="color: <% out.print(parameter); %>">
            <%
                out.println("<p >" +values[0]+"</p>");

            %>
        </h1>
        <%  }                      
        %>
    </body>
</html>
