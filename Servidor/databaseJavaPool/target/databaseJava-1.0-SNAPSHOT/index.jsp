<%-- 
    Document   : index
    Created on : 05-dic-2017, 8:50:47
    Author     : daw
--%>

<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<jsp:useBean id="cons" class="utils.UrlsPaths" scope="session"/>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Index</title>
        <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css">
        <style>
            .container {
                margin: 0 auto;
                text-align: center;
                width: 100%;
            }
            .container a {
                padding-left: 20px;
                font-size: 1.5em;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <a href="<c:out value="${cons.getAlumnos()}"/>">alumnos</a>
            <a href="<c:out value="${cons.getAsignaturas()}"/>">asignaturas</a>
            <a href="<c:out value="${cons.getNotas()}"/>">notas</a>
            <a href="<c:out value="${cons.getRegistro()}"/>">registro</a>
            
            
         
        </div>
    </body>
</html>