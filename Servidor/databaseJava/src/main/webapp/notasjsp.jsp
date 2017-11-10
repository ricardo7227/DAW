<%-- 
    Document   : notasjsp
    Created on : 10-nov-2017, 11:12:45
    Author     : daw
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/functions" prefix = "fn" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <form action="notas" >
            <select name="id_asignatura">
                <c:forEach var="asignatura" items="${asignaturasList}">
                    <option value="${asignatura.id}">${fn:escapeXml(fn:replace(asignatura.nombre,"'","\\'"))}</option>
                </c:forEach>

            </select> 
            <select name="alumno">
                <c:forEach var="id_alumno" items="${alumnosList}">
                    <option value="${alumno.id}">${fn:escapeXml(fn:replace(alumno.nombre,"'","\\'"))}</option>
                </c:forEach>

            </select> 
            <input type="text" name="nota" value="${nota.nota}">
            <input type="submit" name="action" value="VIEW">
            <input type="submit" name="action" value="UPDATE">
        </form>
        
    </body>
</html>
