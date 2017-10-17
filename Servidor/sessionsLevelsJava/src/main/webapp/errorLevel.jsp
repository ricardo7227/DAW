<%-- 
    Document   : errorLevel
    Created on : 17-oct-2017, 11:55:25
    Author     : daw
--%>

<%@page import="utils.Constante"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Error en <%
            out.print(request.getAttribute(Constante.levelError));             %></title>
    </head>
    <body style="background-color: #f4f8ff">
        <h1><%
            out.println(String.format(Constante.passWrongIn,request.getAttribute(Constante.levelError)));
            out.print(Constante.passWrong);
            %></h1>
    </body>
</html>
